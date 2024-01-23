<?php
include 'includes/session.php';
include './includes/req_start.php';
if ($req_per == 1) {
	if (isset($_POST['edit'])) {
		$conn = $pdo->open();
		$curr_password = test_input($_POST['curr_password']);
		$password = test_input($_POST['password']);
		$name = test_input($_POST['name']);
		$phone = test_input($_POST['contact']);
		date_default_timezone_set('Asia/Kolkata');
		//Sanitizing inputs.
		if (!validateMobileNumber($phone))
			$_SESSION['error'] = 'Invalid phone number format.';
		if (strlen($name) > 20)
			$_SESSION['error'] = 'Name should be less then 20 characters.';
		if (strlen($name) < 5)
			$_SESSION['error'] = 'Name should be more then 5 characters.';
		if (!isset($_SESSION['error'])) {
			if (password_verify($curr_password, $user['user_password'])) {
				$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE user_phone=:phone AND user_id!=:id");
				$stmt->execute(['phone' => $phone, 'id' => $user['user_id']]);
				$row = $stmt->fetch();

				if ($row['numrows'] > 0) {
					$_SESSION['error'] = 'Phone number already taken.';
				} else {
					
					if (!isset($_SESSION['error'])) {
						if ($password == $user['user_password']) {
							$password = $user['user_password'];
						} else {
							$password = password_hash($password, PASSWORD_DEFAULT);
						}

						try {
							
							$today = date('Y-m-d h:i:s a');
							$stmt = $conn->prepare("UPDATE users SET user_password=:password, name=:name,  user_phone=:phone, user_updated_date=:user_updated_date WHERE user_id=:id");
							$stmt->execute([ 'password' => $password, 'name' => $name,  'phone' => $phone, 'user_updated_date' => $today, 'id' => $user['user_id']]);

							$_SESSION['success'] = 'Account updated successfully';
						} catch (PDOException $e) {
							$_SESSION['error'] = "Something Went Wrong.";
						}
					}
				}
			} else {
				$_SESSION['error'] = 'Incorrect password';
			}
			$pdo->close();
		}
	} else {
		$_SESSION['error'] = 'Fill up required details first';
	}
}
header('location:MyProfile');

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
