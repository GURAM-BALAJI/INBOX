<?php
require 'vendor/autoload.php';
use Razorpay\Api\Api;

$api_key = 'rzp_test_orBgvTJ5F1VDkd';
$api_secret = 'bEpXQom3YoEOnvoGWgy2nJ5Z';

$api = new Api($api_key, $api_secret);

// Get the amount from the POST request
$amount = $_POST['amount'];

// Create an order
$order = $api->order->create(array(
    'amount' => $amount * 100,
    'currency' => 'INR',
    'payment_capture' => 1
));

// Return the order ID and other details to the frontend
echo json_encode([
    'order_id' => $order->id,
    'amount' => $amount,
]);
