<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = test_input($_POST['id']);
	
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE items set items_delete=:delete, items_ack=:items_ack  WHERE items_id=:id");
			$stmt->execute(['delete' => 1, 'id' => $id, 'items_ack' => 2 ]);
			$_SESSION['success'] = 'Items Not Approved & Deleted Successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
	
		$_SESSION['error'] = 'Wrong Inputs ' .$id ;	
	}
} else {
	$_SESSION['error'] = 'Select display items to delete first';
}

header('location: unverified_items.php');
