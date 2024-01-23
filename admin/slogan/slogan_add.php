
<?php
	include '../includes/session.php';

	if(isset($_POST['add'])){
		$slogan_sentance = test_input($_POST['slogan_sentance']);
		$conn = $pdo->open();
		
			try{
				$stmt = $conn->prepare("INSERT INTO slogan (slogan_sentance) VALUES (:slogan_sentance)");
				$stmt->execute(['slogan_sentance'=>$slogan_sentance]);
				$_SESSION['success'] = 'slogan added successfully';
			}
			catch(PDOException $e){
				$_SESSION['error'] = "Something Went Wrong.";
			}

		$pdo->close();
	}
	else{
		$_SESSION['error'] = 'Fill up slogan form first';
	}

	header('location: slogan.php');

?>