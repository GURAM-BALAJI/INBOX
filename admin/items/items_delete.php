<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = test_input($_POST['id']);
	
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE items set items_delete=:delete WHERE items_id=:id");
			$stmt->execute(['delete' => 1, 'id' => $id]);
			$_SESSION['success'] = 'Display items deleted successfully';
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

header('location: items.php');
