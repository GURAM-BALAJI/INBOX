<?php
include 'includes/session.php';
include './includes/req_start.php';
$redirect = 0;
if ($req_per == 1) {
    $id = $_SESSION['vm_id'];
    if ($id > 0) {
        $conn = $pdo->open();
        $total = 0;
        date_default_timezone_set('Asia/Kolkata');
        $today = date('Y-m-d h:i:s a');
        $stmt_check = $conn->prepare("SELECT * FROM cart left join items on items_id=cart_items_id WHERE cart_user_id=:cart_user_id");
        $stmt_check->execute(['cart_user_id' => $id]);
        $stmt_check11 = $conn->prepare("SELECT address_id FROM address_details WHERE user_id = :user_id ORDER BY `address_id` DESC LIMIT 1");
        $stmt_check11->execute(['user_id' => $id]);
        foreach ($stmt_check11 as $row)
               $address_id=$row['address_id'];
        foreach ($stmt_check as $row_check) {
            $stmt = $conn->prepare("INSERT INTO orders (orders_qty,orders_cost,orders_items,orders_user_id,orders_date, orders_address_id) VALUES (:orders_qty,:orders_cost,:orders_items,:orders_user_id,:orders_date, :orders_address_id)");
            $stmt->execute(['orders_qty' => $row_check['cart_qty'], 'orders_cost' => $row_check['items_cost'], 'orders_items' => $row_check['cart_items_id'], 'orders_user_id' => $id, 'orders_date' => $today, 'orders_address_id'=>$address_id]);
            $redirect = 1;
            $total += $row_check['cart_qty'] * $row_check['items_cost'];
        }
        if ($redirect == 1) {
            $stmt = $conn->prepare("DELETE FROM cart WHERE cart_user_id=:id");
            $stmt->execute(['id' => $id]);
            $_SESSION['success'] = "Order Placed Successfuly.";
        }
    } else {
        $_SESSION['error'] = 'Wrong Inputs.';
    }
}
$pdo->close();

if ($redirect == 1)
    header('location: MyHome');
else
    header('location: MyCart');
