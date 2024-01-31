<?php
include '../includes/session.php';

if (isset($_POST['edit'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$conn = $pdo->open();
		$category_name = test_input($_POST['category_name']);
		$commission = test_input($_POST['commission']);
		try {
			$stmt = $conn->prepare("UPDATE category SET category_name=:category_name,category_commission =:commission  WHERE category_id=:id");
			$stmt->execute(['category_name' => $category_name, 'id' => $id,'commission'=>$commission]);
			$_SESSION['success'] = 'Category updated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Fill up edit category form first';
}

header('location: category.php');
