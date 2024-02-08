<?php
include '../includes/session.php';

if (isset($_POST['addoffer'])) {
	$id = test_input($_POST['id']);
	$offer = test_input($_POST['offer']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE items SET item_commission_cost=:item_commission_cost, items_ack=:items_ack WHERE items_id=:id");
			$stmt->execute(['item_commission_cost' => $offer, 'items_ack' => 1, 'id' => $id]);
			$_SESSION['success'] = 'Item Approved successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select item to offer first';
}

header('location: unverified_items.php');
