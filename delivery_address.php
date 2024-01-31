<?php
include 'includes/session.php';
// Assuming you've retrieved user ID as $id
$id = $_COOKIE['inbox_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = $pdo->open();
    $phone = test_input($_POST["phone"]);
    $landmark = test_input($_POST["address-line-1"]);
    $address = test_input($_POST["address-line-2"]);
    $name = test_input($_POST["username"]);
    $stmt1 = $conn->prepare("SELECT `message` FROM `message` WHERE `message_id`=:id");
    $stmt1->execute(['id' => 3]);
    foreach ($stmt1 as $row1)
        $address_delivery_charges = $row1['message'];
    try {
        $stmt = $conn->prepare("INSERT INTO address_details (address_delivery_charges, phone, Landmark, address,user_id,user_name) VALUES (:address_delivery_charges, :phone, :landmark, :address, :user_id , :user_name)");
        $stmt->execute(['address_delivery_charges' => $address_delivery_charges, 'phone' => $phone, 'landmark' => $landmark, 'address' => $address, 'user_id' => $id, 'user_name' => $name]);
        $pdo->close();
        header('location: Payment\payment.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $pdo->close();
    }
}
?>