<?php
include '../includes/session.php';

if (isset($_GET['submit'])) {
	$id = test_input($_GET['id']);
	if ($id > 0) {
		try {
			$stmt = $conn->prepare("UPDATE contact SET contact_view=:cview WHERE contact_id=:id");
			$stmt->execute(['cview' => 1, 'id' => $id]);
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}		
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
	$pdo->close();
}
header('location: ../contact/contact.php');
