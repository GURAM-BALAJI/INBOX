<?php
include 'includes/session.php';
include './includes/req_start.php';
if ($req_per == 1) {
    $cart_items_id = test_input($_POST['id']);
    $return_id = test_input($_POST['return_id']);
    $cart_user_id = $_SESSION['vm_id'];
    //Sanitizing inputs.
    if ($cart_items_id > 0 && $cart_user_id > 0) {
        $conn = $pdo->open();
        $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM cart WHERE cart_items_id=:cart_items_id && cart_user_id=:cart_user_id");
        $stmt->execute(['cart_items_id' => $cart_items_id, 'cart_user_id' => $cart_user_id]);
        $row = $stmt->fetch();
        if ($row['numrows'] > 0) {
            $_SESSION['error'] = 'Already item is in cart.';
        } else {
            try {
                date_default_timezone_set('Asia/Kolkata');
                $today = date('Y-m-d h:i:s a');
                $stmt = $conn->prepare("INSERT INTO cart (cart_items_id, cart_qty, cart_user_id,cart_added_date) VALUES (:cart_items_id, :cart_qty, :cart_user_id, :cart_added_date)");
                $stmt->execute(['cart_items_id' => $cart_items_id, 'cart_qty' => 1, 'cart_user_id' => $cart_user_id, 'cart_added_date' => $today]);
                if (!isset($_POST['buy_now']))
                    $_SESSION['success'] = "Added To Cart.";
            } catch (PDOException $e) {
                $pdo->close();
                $_SESSION['error'] = "Something Went Wrong.";
                header('location: MyHome?meal_type='.$return_id);
            }
        }
        $pdo->close();
    } else {
        $_SESSION['error'] = 'Wrong Inputs.';
    }
}
header('location: MyHome?meal_type='.$return_id);
