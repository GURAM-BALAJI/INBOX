<?php
include '../includes/session.php';

if (isset($_POST['add'])) {
	$Category = test_input($_POST['Category']);
	$meal_type = test_input($_POST['meal_type']);
	$item_name = test_input($_POST['item_name']);
	$given_id =  $_SESSION['vm_id_admin'];
	$item_price = test_input($_POST['amount']);
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
			move_uploaded_file($_FILES['photo']['tmp_name'], '../../items_images/' . $filename);
		}
	}

	date_default_timezone_set('Asia/Kolkata');
	$today = date('Y-m-d h:i:s a');
	$conn = $pdo->open();

	try {
		$stmt = $conn->prepare("INSERT INTO items (item_category, item_meal_type, items_name, items_cost, items_add_date, items_image, item_status,item_chef_id) VALUES (:item_category, :item_meal_type, :items_name, :items_cost, :items_add_date, :items_image, :item_status,:item_chef_id)");
			
		$stmt->bindParam(':item_category', $Category, PDO::PARAM_STR);
		$stmt->bindParam(':item_meal_type', $meal_type, PDO::PARAM_STR);
		$stmt->bindParam(':items_name', $item_name, PDO::PARAM_STR);
		$stmt->bindParam(':items_cost', $item_price, PDO::PARAM_STR);
		$stmt->bindParam(':items_add_date', $today);
		$stmt->bindParam(':items_image', $filename, PDO::PARAM_STR);
		$status = 1; // Assign a value to a variable and then bind
		$stmt->bindParam(':item_status', $status, PDO::PARAM_INT);
		$stmt->bindParam(':item_chef_id', $given_id, PDO::PARAM_INT);
		// Execute the statement
		$stmt->execute();

		$_SESSION['success'] = ' items added successfully';
	} catch (PDOException $e) {

		error_log("PDOException: " . $e->getMessage(), 0);
		$_SESSION['error'] = "Something Went Wrong. Check the server logs for more details.";
	}

	// Close the connection properly
	$conn = null;
} else {
	$_SESSION['error'] = 'Wrong Inputs';
}

header('location: items.php');
