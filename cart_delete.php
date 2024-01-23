<?php
	include 'includes/session.php';

	$conn = $pdo->open();

	$output = array('error'=>false);
	$id = test_input($_POST['id']);

	if(isset($_SESSION['vm_user'])){
		try{
			$stmt = $conn->prepare("DELETE FROM cart WHERE id=:id");
			$stmt->execute(['id'=>$id]);
			$output['message'] = 'Deleted';
			
		}
		catch(PDOException $e){
			$output['message'] = "Something Went Wrong.";
		}
	}
	else{
		foreach($_SESSION['cart'] as $key => $row){
			if($row['productid'] == $id){
				unset($_SESSION['cart'][$key]);
				$output['message'] = 'Deleted';
			}
		}
	}

	$pdo->close();
	echo json_encode($output);

?>