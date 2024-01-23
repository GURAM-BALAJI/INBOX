<?php
	include '../../includes/conn.php';
	session_start();

if(isset($_SESSION['vm_admin'])){
    $id=$_SESSION['vm_id_admin'];
	$conn = $pdo->open();
	$stmt = $conn->prepare("SELECT * FROM admin WHERE admin_id=:id");
	$stmt->execute(['id'=>$id]);
	$admin = $stmt->fetch();
	$pdo->close();
	if(!$admin['admin_status'])
        header('location: ../logout.php');
}else{
    header('location: ../index.php');
		exit();
}
function test_input($data)
{
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>