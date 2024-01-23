<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE users set user_delete=:user_delete WHERE user_id=:id");
			$stmt->execute(['user_delete' => 1, 'id' => $id]);
			$_SESSION['success'] = 'User deleted successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select user to delete first';
}

header('location: users.php');
