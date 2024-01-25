<?php 
	include '../includes/session.php';

	if(isset($_POST['id'])){
		$id = test_input($_POST['id']);
		$conn = $pdo->open();
		$stmt = $conn->prepare("SELECT orders_id FROM orders WHERE orders_id=:id");
		$stmt->execute(['id'=>$id]);
		$row = $stmt->fetch();
		$pdo->close();
		echo json_encode($row);
	}
?>