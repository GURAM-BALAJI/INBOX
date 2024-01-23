<?php
include '../includes/session.php';

if (isset($_POST['add'])) {
	$name = test_input($_POST['name']);
	$password = test_input($_POST['password']);
	$contact = test_input($_POST['contact']);
	$by = test_input($admin['admin_id']);
	if ($by > 0) {
		//Sanitizing inputs.
		if (!validateMobileNumber($contact))
			$_SESSION['error'] = 'Invalid phone number format.';
		if (strlen($name) > 20)
			$_SESSION['error'] = 'Name should be less then 20 characters.';
		if (strlen($name) < 5)
			$_SESSION['error'] = 'Name should be more then 5 characters.';
		if (!isset($_SESSION['error'])) {
			date_default_timezone_set('Asia/Kolkata');
			$today = date('Y-m-d h:i:s a');
			$date = date('Y-m-d');
			$conn = $pdo->open();

			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE user_phone=:phone");
			$stmt->execute(['phone' => $contact]);
			$row = $stmt->fetch();

			if ($row['numrows'] > 0) {
				$_SESSION['error'] = 'Phone number already taken.';
			} else {
				$password = password_hash($password, PASSWORD_DEFAULT);
				
				if (!isset($_SESSION['error'])) {
					try {
						$stmt = $conn->prepare("INSERT INTO users ( user_password, name,  user_phone,  user_status,  user_added_date, user_updated_date) VALUES ( :password, :name, :contact, :status, :user_added_date, :user_updated_date)");
						$stmt->execute([ 'password' => $password, 'name' => $name, 'contact' => $contact, 'status' => 1, 'user_added_date' => $today, 'user_updated_date' => $today]);

						$stmt_user2 = $conn->prepare("SELECT user_id FROM users WHERE user_phone=:contact");
						$stmt_user2->execute(['contact' => $contact]);
						foreach ($stmt_user2 as $row1) {
							$user_id = $row1['user_id'];
						};
						$_SESSION['success'] = 'User added successfully';
					} catch (PDOException $e) {
						$_SESSION['error'] = "Something Went Wrong.";
					}
				}
			}

			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Fill up user form first';
}

header('location: users.php');


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
