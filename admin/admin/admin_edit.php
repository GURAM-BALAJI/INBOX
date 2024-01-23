<?php
include '../includes/session.php';

if (isset($_POST['edit'])) {
	$id = test_input($_POST['id']);
	$name = test_input($_POST['name']);
	$address = test_input($_POST['address']);
	$password = test_input($_POST['password']);
	$contact = test_input($_POST['contact']);
	//Sanitizing inputs.
	if (!validateMobileNumber($contact))
		$_SESSION['error'] = 'Invalid phone number format.';
	if (strlen($name) > 20)
		$_SESSION['error'] = 'Name should be less then 20 characters.';
	if (strlen($name) < 5)
		$_SESSION['error'] = 'Name should be more then 5 characters.';
	if (!isset($_SESSION['error']) && $id > 0) {
		date_default_timezone_set('Asia/Kolkata');
		$today = date('Y-m-d h:i:s a');
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=:id");
		$stmt->execute(['id' => $id]);
		$row = $stmt->fetch();

		if ($password == $row['password']) {
			$password = $row['password'];
		} else {
			$password = password_hash($password, PASSWORD_DEFAULT);
		}

		try {
			$stmt = $conn->prepare("UPDATE admin SET admin_address=:admin_address, admin_password=:password, admin_name=:name, admin_phone=:contact,admin_updated_date=:admin_updated_date WHERE admin_id=:id");
			$stmt->execute(['admin_address'=>$address,'password' => $password, 'name' => $name, 'contact' => $contact, 'admin_updated_date' => $today, 'id' => $id]);
			$_SESSION['success'] = 'admin updated successfully';
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something Went Wrong.";
		}


		$pdo->close();
	}
} else {
	$_SESSION['error'] = 'Fill up edit admin form first';
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