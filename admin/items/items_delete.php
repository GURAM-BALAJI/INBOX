<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = test_input($_POST['id']);
	
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("DELETE FROM items WHERE items_id=:id");
			$stmt->execute(['id' => $id]);
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
