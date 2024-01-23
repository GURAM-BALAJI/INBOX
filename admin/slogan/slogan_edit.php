<?php
include '../includes/session.php';

if (isset($_POST['edit'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		$slogan_sentance = test_input($_POST['slogan_sentance']);
		try {
			$stmt = $conn->prepare("UPDATE slogan SET slogan_sentance=:slogan_sentance WHERE slogan_id=:id");
			$stmt->execute(['slogan_sentance' => $slogan_sentance, 'id' => $id]);
			$_SESSION['success'] = 'slogan updated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Fill up edit slogan form first';
}

header('location: slogan.php');
