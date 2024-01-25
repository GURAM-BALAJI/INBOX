<?php
	session_start();
	$_SESSION['vm_admin'] = 'New';
	$_SESSION['vm_id_admin'] = "Data";
	session_destroy();
	header('location: index.php');
?>