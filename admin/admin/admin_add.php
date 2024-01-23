<?php
include '../includes/session.php';

if (isset($_POST['add'])) {
	$name = test_input($_POST['name']);
	$password = test_input($_POST['password']);
	$type = test_input($_POST['type']);
	$address = test_input($_POST['address']);
	$contact = test_input($_POST['contact']);
	//Sanitizing inputs.
	if (!validateMobileNumber($contact))
		$_SESSION['error'] = 'Invalid phone number format.';
	if (strlen($name) > 20)
		$_SESSION['error'] = 'Name should be less then 20 characters.';
	if (strlen($name) < 5)
		$_SESSION['error'] = 'Name should be more then 5 characters.';
	if (!isset($_SESSION['error'])) {
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM admin WHERE admin_phone=:contact");
		$stmt->execute(['contact' => $contact]);
		$row = $stmt->fetch();
		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'Contact already taken';
		} else {
			date_default_timezone_set('Asia/Kolkata');
			$today = date('Y-m-d h:i:s a');
			$password = password_hash($password, PASSWORD_DEFAULT);
		
			if (!isset($_SESSION['error'])) {
				try {
					$stmt = $conn->prepare("INSERT INTO admin ( admin_type, admin_address, admin_password, admin_name, admin_phone,  admin_status,admin_updated_date,admin_added_date) VALUES (:type, :admin_address, :password, :name, :contact, :status, :admin_updated_date,:admin_added_date)");
					$stmt->execute(['type' => $type, 'admin_address'=>$address, 'password' => $password, 'name' => $name, 'contact' => $contact, 'status' => 1, 'admin_updated_date' => $today, 'admin_added_date' => $today]);
					$_SESSION['success'] = 'Admin added successfully';
				} catch (PDOException $e) {
					$_SESSION['error'] = "Something Went Wrong.";
				}
			}
		}
		$pdo->close();
	}
} else {
	$_SESSION['error'] = 'Fill up admin form first';
}

header('location: admin.php');

function validateMobileNumber($mobile)
{
	if (!empty($mobile)) {
		$isMobileNmberValid = true;
		$mobileDigitsLength = strlen($mobile);
		if ($mobileDigitsLength < 10 || $mobileDigitsLength > 11) {
			$isMobileNmberValid = false;
		} else {
			if (!preg_match("/^[+]?[1-9][0-9]{9}$/", $mobile)) {
				$isMobileNmberValid = false;
			}
		}
		return $isMobileNmberValid;
	} else {
		return false;
	}
}
