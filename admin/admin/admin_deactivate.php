<?php
include '../includes/session.php';

if (isset($_POST['deactivate'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			date_default_timezone_set('Asia/Kolkata');
			$today = date('Y-m-d h:i:s a');
			$stmt = $conn->prepare("UPDATE admin SET admin_status=:status,admin_updated_date=:admin_updated_date WHERE admin_id=:id");
			$stmt->execute(['status' => 0, 'admin_updated_date' => $today, 'id' => $id]);
			$_SESSION['success'] = 'admin deactivated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}

		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select admin to deactivate first';
}

header('location: admin.php');
