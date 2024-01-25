<?php
include '../includes/session.php';

if (isset($_POST['upload'])) {
	$id = test_input($_POST['id']);
	$filename = $_FILES['photo']['name'];
	if ($id > 0) {
		if (!empty($filename)) {
			$file_type = $_FILES['photo']['type']; //returns the mimetype
			$allowed = array("image/jpeg", "image/gif", "image/png");
			if (!in_array($file_type, $allowed)) {
				$_SESSION['error'] = 'Only jpg, gif, and png files are allowed.';
			} else {
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$filename = date('Y-m-d') . '_' . time() . '.' . $ext;
				move_uploaded_file($_FILES['photo']['tmp_name'], '../../category_images/' . $filename);
			}
		}
		if (!isset($_SESSION['error'])) {
			$conn = $pdo->open();
			try {
				$stmt = $conn->prepare("SELECT category_image from category WHERE category_id=:id");
				$stmt->execute(['id' => $id]);
				foreach ($stmt as $row) {
					unlink('../../category_images/' . $row['category_image']);
				}
				$stmt = $conn->prepare("UPDATE category SET category_image=:photo WHERE category_id=:id");
				$stmt->execute(['photo' => $filename, 'id' => $id]);
				$_SESSION['success'] = 'Category photo updated successfully';
			} catch (PDOException $e) {
				$_SESSION['error'] = "Something Went Wrong.";
			}
			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Select Category to update photo first';
}

header('location: category.php');
