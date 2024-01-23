<?php

use PHPMailer\PHPMailer\PHPMailer;

include 'includes/session.php';

if (isset($_POST['email'])) {
	$_SESSION['name'] = $name = test_input($_POST['name']);
	$_SESSION['email'] = $email = test_input($_POST['email']);
	$_SESSION['contact'] = $contact = test_input($_POST['contact']);
	$_SESSION['password'] = $password = test_input($_POST['password']);
	$cpassword = test_input($_POST['cpassword']);
	//Sanitizing inputs.
	if (!filter_var($email, FILTER_VALIDATE_EMAIL))
		$_SESSION['error'] = "Invalid email format.";
	if (!validateMobileNumber($contact))
		$_SESSION['error'] = 'Invalid phone number format.';
	if (strlen($name) > 20)
		$_SESSION['error'] = 'Name should be less then 20 characters.';
	if (strlen($name) < 5)
		$_SESSION['error'] = 'Name should be more then 5 characters.';
	if (strlen($password) < 5)
		$_SESSION['error'] = 'Password should be more then 5 length.';
	if (!isset($_SESSION['error'])) {
		date_default_timezone_set('Asia/Kolkata');
		$today = date('Y-m-d h:i:s a');
		$conn = $pdo->open();

		$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM users WHERE user_email=:email || user_phone=:phone");
		$stmt->execute(['email' => $email, 'phone' => $contact]);
		$row = $stmt->fetch();
		if ($row['numrows'] > 0) {
			$_SESSION['error'] = 'Choose Other Email And Phone Number.';
		} else {
			if ($password == $cpassword) {
				$password = password_hash($password, PASSWORD_DEFAULT);
				$token = bin2hex(random_bytes(15));
				try {
					$stmt = $conn->prepare("INSERT INTO users (user_email, user_password, name, user_phone,  user_token, user_added_date, user_updated_date) VALUES (:email, :password, :name, :contact, :user_token, :user_added_date, :user_updated_date)");
					$stmt->execute(['email' => $email, 'password' => $password, 'name' => $name, 'contact' => $contact,  'user_token' => $token, 'user_added_date' => $today, 'user_updated_date' => $today]);
					$message =  "<center><h1> Click the  below link or Button to activate account </h1><a href='http://immunityspot.com/VM/VerifyMail?token=$token'>
				<button style='background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;' >Active Now</button></a>
				<br><br><br><hr>If you has not sent please ignore this mail.<h2>7softsolution.com</h2></center>";
					require_once "PHPMailer/PHPMailer.php";
					require_once "PHPMailer/SMTP.php";
					require_once "PHPMailer/Exception.php";
					$mail = new PHPMailer();
					//Server settings
					$mail->isSMTP();
					$mail->Host = "smtp.hostinger.com";
					$mail->SMTPAuth = true;
					$mail->Username = "vm@immunityspot.com"; //enter you email address
					$mail->Password = 'SI@7softsolution'; //enter you email password
					$mail->Port = 587;
					$mail->SMTPOptions = array(
						'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
						)
					);

					$mail->setFrom('vm@immunityspot.com', 'Vending Machine');

					//Recipients
					$mail->addAddress($email);

					//Content
					$mail->isHTML(true);
					$mail->Subject = 'Verification Code:';
					$mail->Body = $message;

					if ($mail->send()) {
						$_SESSION['success'] = "We've sent a verification link to your email
                         - $email";
					} else {
						$_SESSION['error'] = "Mail can`t be sent please cheak your mail.";
					}
					unset($_SESSION['name']);
					unset($_SESSION['email']);
					unset($_SESSION['contact']);
					unset($_SESSION['password']);
					$_SESSION['mailAuth'] = 'true';
					$pdo->close();
					header('location: mailAuth.php');
					exit();
				} catch (PDOException $e) {
					$pdo->close();
					$_SESSION['error'] = "Something Went Wrong.";
					header('location: JoinUs');
				}
			} else {
				$_SESSION['error'] = "Confirm password not matched!";
			}
		}
		$pdo->close();
	}
} else {
	$_SESSION['error'] = 'Fill up user form first';
}

header('location: JoinUs');

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
