<?php
include '../includes/session.php';
$conn = $pdo->open();

if (isset($_POST['login'])) {
	$contact = test_input($_POST['phone']);
	$password = test_input($_POST['password']);
		try {
			$stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM admin WHERE admin_phone = :contact");
			$stmt->execute(['contact' => $contact]);
			$row = $stmt->fetch();
			if ($row['numrows'] > 0) {
				if ($row['admin_status']) {
					if (password_verify($password, $row['admin_password'])) {
						$_SESSION['vm_admin'] = 'True';
						$_SESSION['vm_id_admin'] = $row['admin_id'];
					} else {
						$_SESSION['error'] = 'Invalid.';
					}
				} else {
					$_SESSION['error'] = 'Invalid.';
				}
			} else {
				$_SESSION['error'] = 'Invalid.';
			}
		} catch (PDOException $e) {
			echo "There is some problem in connection: " . "Something Went Wrong.";
		}
} else {
	$_SESSION['error'] = 'Input login credentails first';
}

$pdo->close();

header('location: index.php');

