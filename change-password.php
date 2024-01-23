<?php
include 'includes/session.php';
if (isset($_POST['change-password'])) {
    if (isset($_SESSION['email'])) {
        $password = test_input($_POST['password']);
        $cpassword = test_input($_POST['cpassword']);
        if ($password !== $cpassword) {
            $_SESSION['error'] = "Confirm password not matched!";
            header('location: NewPassword');
        } else {
            $email = test_input($_SESSION['email']);
            $conn = $pdo->open();
            date_default_timezone_set('Asia/Kolkata');
            $today = date('Y-m-d h:i:s a');
            $password = password_hash($password, PASSWORD_BCRYPT);;
            $stmt = $conn->prepare("UPDATE users SET user_status=:status, user_password=:password, user_updated_date=:user_updated_date WHERE user_email=:email");
            $stmt->execute(['status' => 1, 'password' => $password, 'user_updated_date' => $today, 'email' => $email]);
            unset($_SESSION['password']);
            $_SESSION['success'] = "Your password changed. Now you can login with your new password.";
            header('location: LogMe');
            exit();
            $pdo->close();
        }
    } else {
        header('location: MyHome');
    }
} else {
    header('location: MyHome');
}
