<?php
include '../includes/session.php';

if (isset($_POST['activate'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE admin SET admin_status=:status WHERE admin_id=:id");
			$stmt->execute(['status' => 1, 'id' => $id]);
			$_SESSION['success'] = 'admin activated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select admin to activate first';
}

header('location: admin.php');
