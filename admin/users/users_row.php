<?php 
	include '../includes/session.php';

	if(isset($_POST['id'])){
		$id = test_input($_POST['id']);
		if ($id > 0) {
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		$pdo->close();
		echo json_encode($row);
		} else {
			$_SESSION['error'] = 'Wrong Inputs.';
		}
	}
?>