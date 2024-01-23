<?php
	include '../includes/session.php';

	if(isset($_POST['delete'])){
		$id = test_input($_POST['id']);
		if ($id > 0) {
		$conn = $pdo->open();
		try{
			$stmt = $conn->prepare("DELETE FROM slogan WHERE slogan_id=:id");
			$stmt->execute(['id'=>$id]);
			$_SESSION['success'] = 'slogan deleted successfully';
		}
		catch(PDOException $e){
			$_SESSION['error'] = "Something Went Wrong.";
		}
		$pdo->close();
		} else {
			$_SESSION['error'] = 'Wrong Inputs.';
		}
	}
	else{
		$_SESSION['error'] = 'Select slogan to delete first';
	}

	header('location: slogan.php');
	
?>