<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			date_default_timezone_set('Asia/Kolkata');
			$today = date('Y-m-d h:i:s a');
			$stmt = $conn->prepare("UPDATE admin set admin_delete=:admin_delete,admin_updated_date=:admin_updated_date WHERE admin_id=:id");
			$stmt->execute(['admin_delete' => 1, 'admin_updated_date' => $today, 'id' => $id]);

			$_SESSION['success'] = 'admin deleted successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select admin to delete first';
}

header('location: admin.php');
