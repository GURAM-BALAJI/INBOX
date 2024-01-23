<?php
include 'includes/session.php';
$conn = $pdo->open();
if (isset($_POST['login'])) {
	$_SESSION['email'] = $email = test_input($_POST['email']);
	$_SESSION['password'] = $password = test_input($_POST['password']);
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		try {
			date_default_timezone_set('Asia/Kolkata');
			$stmt = $conn->prepare("SELECT user_attempts,user_login_time,user_email,user_status,user_password,user_id,COUNT(*) AS numrows FROM users WHERE user_email = :email");
			$stmt->execute(['email' => $email]);
			$row = $stmt->fetch();
			if ($row['numrows'] > 0) {
				if ($row['user_status']) {
					if ($row['user_login_time'] <= time()) {
						if (password_verify($password, $row['user_password'])) {
							$_SESSION['vm_user'] = 'True';
							$_SESSION['vm_id'] = $row['user_id'];
							$today = date('Y-m-d h:i:s a');
							$sessionss_cookies_id =  bin2hex(random_bytes(8)) . $row['user_id'] . time();
							$stmt = $conn->prepare("UPDATE users SET user_attempts=:user_attempts WHERE user_id=:id");
							$stmt->execute(['user_attempts' => 0, 'id' => $row['user_id']]);
							if ($_POST['keep_me']) {
								$stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM sessionss WHERE sessionss_user_id = :sessionss_user_id");
								$stmt->execute(['sessionss_user_id' => $row['user_id']]);
								$row1 = $stmt->fetch();
								if ($row1['numrows'] > 0) {
									$stmt_sessions = $conn->prepare("UPDATE sessionss SET sessionss_cookies_id=:sessionss_cookies_id,sessionss_created_date=:sessionss_created_date WHERE sessionss_user_id = :user_id");
									$stmt_sessions->execute(['sessionss_cookies_id' => $sessionss_cookies_id, 'sessionss_created_date' => $today, 'user_id' => $row['user_id']]);
								} else {
									$stmt_sessions = $conn->prepare("INSERT INTO sessionss (sessionss_cookies_id, sessionss_created_date, sessionss_user_id) VALUES (:sessionss_cookies_id, :sessionss_created_date, :sessionss_user_id)");
									$stmt_sessions->execute(['sessionss_cookies_id' => $sessionss_cookies_id, 'sessionss_created_date' => $today, 'sessionss_user_id' => $row['user_id']]);
								}
								setcookie('keep_id', $sessionss_cookies_id, time() + 60 * 60 * 24 * 30);
							}
							unset($_SESSION['email']);
							unset($_SESSION['password']);
						} else {
							if ($row['user_attempts'] >= 3) {
								$after = time() + (60 * pow(2, ($row['user_attempts'] - 3)));
								$stmt = $conn->prepare("UPDATE users SET user_attempts=:user_attempts,user_login_time=:user_login_time WHERE user_id=:id");
								$stmt->execute(['user_attempts' => $row['user_attempts'] + 1, 'user_login_time' => $after, 'id' => $row['user_id']]);
								$_SESSION['error'] = 'Oops! Locked, Try Again After ' . date('h:i:s a', $after);
							} else {
								$stmt = $conn->prepare("UPDATE users SET user_attempts=:user_attempts WHERE user_id=:id");
								$stmt->execute(['user_attempts' => $row['user_attempts'] + 1, 'id' => $row['user_id']]);
								$_SESSION['error'] = 'Incorrect Email Or Password.';
							}
						}
					} else {
						$_SESSION['error'] = 'Oops! Locked, Try Again After ' . date('h:i:s a', $row['user_login_time']);
					}
				} else {
					$_SESSION['error'] = 'Account not activated.';
				}
			} else {
				$_SESSION['error'] = 'Incorrect Email Or Password.';
			}
		} catch (PDOException $e) {
			$_SESSION['error'] = "Something went wrong. ";
		}
	} else {
		$_SESSION['error'] = "Invalid email format.";
	}
} else {
	$_SESSION['error'] = 'Input login credentails first';
}

$pdo->close();
header('location: LogMe');
