<?php
include 'includes/session.php';
include './includes/req_start.php';

if ($req_per == 1) {
    $redirect = 0;
    $id = $_SESSION['vm_id'];
    if ($id > 0) {
        $conn = $pdo->open();
        $flag = 0;
        $total = 0;
        $stmt_check = $conn->prepare("SELECT * FROM cart left join items on items_id=cart_items_id WHERE cart_user_id=:cart_user_id");
        $stmt_check->execute(['cart_user_id' => $id]);
        foreach ($stmt_check as $row_check) {
            $flag++;
            if ($flag == 1) {
                $qty_array = $row_check['cart_qty'];
                $item_array = $row_check['items_id'];
                $cost_array = $row_check['items_cost'];
                $orders_chef_id = $row_check['item_chef_id'];
            } else {
                $qty_array .= ',' . $row_check['cart_qty'];
                $item_array .= ',' . $row_check['items_id'];
                $cost_array .= ',' . $row_check['items_cost'];
                $orders_chef_id .= ',' . $row_check['item_chef_id'];
            }
            $total += $row_check['cart_qty'] * $row_check['items_cost'];
        }
        if ($flag == 0)
            $_SESSION['error'] = 'Cart Is Empty.';
        else {
            date_default_timezone_set('Asia/Kolkata');
            $today = date('Y-m-d h:i:s a');
            $stmt = $conn->prepare("DELETE FROM cart WHERE cart_user_id=:id");
            $stmt->execute(['id' => $id]);
            $stmt = $conn->prepare("INSERT INTO orders (orders_qty,orders_cost,orders_items,orders_user_id,orders_date, orders_chef_id) VALUES (:orders_qty,:orders_cost,:orders_items,:orders_user_id,:orders_date, :orders_chef_id)");
            $stmt->execute(['orders_qty' => $qty_array, 'orders_cost' => $cost_array, 'orders_items' => $item_array, 'orders_user_id' => $id, 'orders_date' => $today, 'orders_chef_id' => $orders_chef_id]);
            $redirect = 1;
            $_SESSION['success'] = "Order Placed Successfuly.";
        }
    } else {
        $_SESSION['error'] = 'Wrong Inputs.';
    }
}
$pdo->close();

if ($redirect == 1 && isset($redirect))
    header('location: MyHome');
else
    header('location: MyCart');
