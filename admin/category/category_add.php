<?php
include '../includes/session.php';

if (isset($_POST['add'])) {
	$category_name = test_input($_POST['category_name']);
	$commission = test_input($_POST['commission']);
	$filename = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : null;

	// File Upload Handling
	if (!empty($filename)) {
		$file_type = $_FILES['photo']['type']; // returns the mimetype
		$allowed = array("image/jpeg", "image/gif", "image/png");

		if (!in_array($file_type, $allowed)) {
			$_SESSION['error'] = 'Only jpg, gif, and png files are allowed.';
		} else {
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$filename = date('Y-m-d') . '_' . time() . '.' . $ext;
			move_uploaded_file($_FILES['photo']['tmp_name'], '../../category_images/' . $filename);
		}
	}
	$conn = $pdo->open();

	try {
		$stmt = $conn->prepare("INSERT INTO category (category_name,category_image,category_commission) VALUES (:category_name,:category_image,:category_commission)");
		$stmt->execute(['category_name' => $category_name, 'category_image' => $filename, 'category_commission'=>$commission]);
		$_SESSION['success'] = 'category added successfully';
	} catch (PDOException $e) {
		$_SESSION['error'] = "Something Went Wrong.";
	}

	$pdo->close();
} else {
	$_SESSION['error'] = 'Fill up category form first';
}

header('location: category.php');

?>