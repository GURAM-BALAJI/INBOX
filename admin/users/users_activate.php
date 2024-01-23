<?php
include '../includes/session.php';

if (isset($_POST['activate'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();

		try {
			$stmt = $conn->prepare("UPDATE users SET user_status=:status WHERE user_id=:id");
			$stmt->execute(['status' => 1, 'id' => $id]);
			$_SESSION['success'] = 'User activated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}

		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select user to activate first';
}

header('location: users.php');
