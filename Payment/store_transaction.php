<?php
require 'vendor/autoload.php';
include '../includes/session.php';
use Razorpay\Api\Api;

$api_key = 'rzp_test_orBgvTJ5F1VDkd';
$api_secret = 'bEpXQom3YoEOnvoGWgy2nJ5Z';

$api = new Api($api_key, $api_secret);

// Get the transaction details from the POST request
$order_id = isset($_POST['order_id']) ? $_POST['order_id'] : '';
$payment_id = isset($_POST['payment_id']) ? $_POST['payment_id'] : '';
$amount = isset($_POST['amount']) ? $_POST['amount'] : '';
$action = isset($_POST['action']) ? $_POST['action'] : ''; // New action parameter

date_default_timezone_set('Asia/Kolkata');
$today = date('Y-m-d h:i:s a');
$id = $_SESSION['inbox_id'];
// Store the transaction in the database
$conn = $pdo->open();

// Fetch address_id
$stmt_check11 = $conn->prepare("SELECT address_id FROM address_details WHERE user_id = :user_id ORDER BY address_id DESC LIMIT 1");
$stmt_check11->execute(['user_id' => $id]);

$address_id = null; // Initialize $address_id
foreach ($stmt_check11 as $row) {
    $address_id = $row['address_id'];
}
if ($action === 'store') {
    // Insert into orders table
    $stmt_orders = $conn->prepare("INSERT INTO orders (orders_qty,orders_cost,orders_items,orders_user_id,orders_date, orders_address_id) VALUES (:orders_qty,:orders_cost,:orders_items,:orders_user_id,:orders_date, :orders_address_id)");
 
    // Delete cart entries
    $stmt_delete_cart = $conn->prepare("DELETE FROM cart WHERE cart_user_id=:id");

    // Insert into transaction table


    // Process the data for storing the transaction
    if ($stmt_check = $conn->prepare("SELECT * FROM cart left join items on items_id=cart_items_id WHERE cart_user_id=:cart_user_id")) {
        $stmt_check->execute(['cart_user_id' => $id]);

        foreach ($stmt_check as $row_check) {
            $stmt_orders->execute(['orders_qty' => $row_check['cart_qty'], 'orders_cost' => $row_check['items_cost'], 'orders_items' => $row_check['cart_items_id'], 'orders_user_id' => $id, 'orders_date' => $today, 'orders_address_id' => $address_id]);
        }

        $stmt_delete_cart->execute(['id' => $id]);
        $stmt_transaction = $conn->prepare("INSERT INTO transaction (transaction_id, transaction_user_id, transaction_amount, transaction_date, transaction_status, transaction_address_id) VALUES (:transaction_id, :transaction_user_id,  :transaction_amount, :transaction_date, :transaction_status, :address_id)");
        $stmt_transaction->execute(['transaction_id' => $payment_id, 'transaction_user_id' => $id, 'transaction_amount' => $amount,  'transaction_date' => $today, 'transaction_status' => 'TXN_Success', 'address_id' => $address_id]);
        $pdo->close();

    } else {
        // Log the error or display an error message
        error_log("Error in preparing SQL statement.");
        // Redirect the user to fail.php in case of an error
        header('location: fail.php');
        exit();
    }
} elseif ($action === 'cancel') {
    // Process the data for canceling the payment
    $stmt_transaction = $conn->prepare("INSERT INTO transaction (transaction_id, transaction_user_id, transaction_amount, transaction_date, transaction_status, transaction_address_id) VALUES (:transaction_id, :transaction_user_id,  :transaction_amount, :transaction_date, :transaction_status, :address_id)");

    $stmt_transaction->execute(['transaction_id' => $payment_id, 'transaction_user_id' => $id, 'transaction_amount' => $amount,  'transaction_date' => $today, 'transaction_status' => 'TXN_Cancelled', 'address_id' => $address_id]);

    $pdo->close();
    // No need to redirect here, as it's handled in payment.php
} else {
    // Invalid action parameter
    header('location: fail.php');
    exit();
}
?>
