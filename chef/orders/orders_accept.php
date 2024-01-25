<?php
include '../includes/session.php';

if (isset($_POST['yes'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE orders SET orders_accept=:status WHERE orders_id=:id");
			$stmt->execute(['status' => 1, 'id' => $id]);
			$_SESSION['success'] = 'Order Accept Successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
}

if (isset($_POST['no'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE orders SET orders_accept=:status WHERE orders_id=:id");
			$stmt->execute(['status' => 2, 'id' => $id]);
			$_SESSION['error'] = 'Order Not Accepted.';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
}

header('location: present_orders.php');