<?php
include '../includes/session.php';

if (isset($_POST['deactivate'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE items SET item_status=:status WHERE items_id=:id");
			$stmt->execute(['status' => 0, 'id' => $id]);
			$_SESSION['success'] = 'Item deactivated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select item to deactivate first';
}

header('location: items.php');
