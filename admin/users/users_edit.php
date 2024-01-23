<?php
include '../includes/session.php';

if (isset($_POST['edit'])) {
	$id = test_input($_POST['id']);
	if ($id > 0) {
		$name = test_input($_POST['name']);
		$password = test_input($_POST['password']);
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
			$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
			$stmt->execute(['id' => $id]);
			$row = $stmt->fetch();
			date_default_timezone_set('Asia/Kolkata');
			$today = date('Y-m-d h:i:s a');
			$date = date('Y-m-d');
			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE user_phone=:phone AND user_id!=:id");
			$stmt->execute(['phone' => $contact, 'id' => $id]);
			$row = $stmt->fetch();
			if ($row['numrows'] > 0) {
				$_SESSION['error'] = 'Phone number already taken.';
			} else {
				if ($password == $row['password']) {
					$password = $row['password'];
				} else {
					$password = password_hash($password, PASSWORD_DEFAULT);
				}

				try {
					$stmt = $conn->prepare("UPDATE users SET user_password=:password, name=:name, user_phone=:contact,user_added_date=:user_added_date,user_updated_date=:user_updated_date WHERE user_id=:id");
					$stmt->execute(['password' => $password, 'name' => $name, 'contact' => $contact, 'user_added_date' => $today, 'user_updated_date' => $today, 'id' => $id]);
					$_SESSION['success'] = 'User updated successfully';
				} catch (PDOException $e) {
					$_SESSION['error'] = "Something Went Wrong.";
				}
			}

			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Wrong Inputs.';
	}
} else {
	$_SESSION['error'] = 'Fill up edit user form first';
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
