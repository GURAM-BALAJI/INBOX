<?php
include 'includes/session.php';
include './includes/req_start.php';
if ($req_per == 1) {
    if (!isset($_POST['remove'])) {
        if (isset($_POST['id'])) {
            $id = test_input($_POST['id']);
            $qty = test_input($_POST['qty']);
            if ($id > 0) {
                $conn = $pdo->open();
                if (isset($_POST['add'])){
                    $qty = $qty + 1;
                }else{
                    $qty = $qty - 1;
                }
                $stmt = $conn->prepare("UPDATE cart SET cart_qty=:qty WHERE cart_id=:id");
                $stmt->execute(['qty' => $qty, 'id' => $id]);

            }
            $pdo->close();
        } else {
            $_SESSION['error'] = 'Wrong Inputs.';
        }
    } else {
        $id = test_input($_POST['id']);
        //Sanitizing inputs.
        if ($id > 0) {
            $conn = $pdo->open();
            $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id=:id");
            $stmt->execute(['id' => $id]);
            $_SESSION['error'] = "Item deleted.";
            $pdo->close();
        } else {
            $_SESSION['error'] = 'Wrong Inputs.';
        }
    }
}
header('location: MyCart');
