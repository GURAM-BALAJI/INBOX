<?php
include '../includes/session.php';

if (isset($_POST['delete'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		try {
			$stmt = $conn->prepare("UPDATE category set category_delete=:category_delete WHERE category_id=:id");
			$stmt->execute(['category_delete' => 1, 'id' => $id]);
			$_SESSION['success'] = 'Category deleted successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select category to delete first';
}

header('location: category.php');

?>