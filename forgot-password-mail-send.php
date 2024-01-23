<?php

use PHPMailer\PHPMailer\PHPMailer;

include 'includes/session.php';

if (isset($_POST['email'])) {
	$_SESSION['email'] = $email = test_input($_POST['email']);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM users WHERE user_email=:email");
		$stmt->execute(['email' => $email]);
		$row = $stmt->fetch();
		if ($row['numrows'] > 0) {
			try {
				$token = bin2hex(random_bytes(15));
				$stmt = $conn->prepare("UPDATE users SET user_token=:token WHERE user_email=:email");
				$stmt->execute(['token' => $token, 'email' => $email]);
				$message = "<center><h1>To reset your password click bellow link/button to change </h1><a href='http://immunityspot.com/VM/NewPassword?token=$token'>
			<button style='background-color: #4CAF50;border: none;color: white;padding: 15px 32px;text-align: center;text-decoration: none;display: inline-block;font-size: 16px;' >Change Now</button></a>
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
				$mail->Password = "SI@7softsolution"; //enter you email password
				$mail->Port = 587;
				$mail->SMTPOptions = array(
					'ssl' => array(
						'verify_peer' => false,
						'verify_peer_name' => false,
						'allow_self_signed' => true
					)
				);

				$mail->setFrom('vm@immunityspot.com', 'Reset Password mail');

				//Recipients
				$mail->addAddress($email);

				//Content
				$mail->isHTML(true);
				$mail->Subject = 'Password Reset mail';
				$mail->Body = $message;

				if ($mail->send())
					$_SESSION['success'] = "We've sent a reset link to your email - $email";
				else
					$_SESSION['error'] = "Mail can`t be sent please cheak your email.";

				$_SESSION['email'] = $email;
				header('location: MailStatus');
				exit();
			} catch (PDOException $e) {
				$_SESSION['error'] = "Something Went Wrong.";
				header('location: ForgotMe');
			}
		} else {
			$_SESSION['success'] = "We've sent a reset link to your email - $email";
			header('location: MailStatus');
			exit();
		}
		$pdo->close();
	} else {
		$_SESSION['error'] = "Invalid email format.";
	}
} else {
	$_SESSION['error'] = 'Fill up user form first';
}

header('location: ForgotMe');
