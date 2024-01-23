<?php
	session_start();
	$_SESSION['vm_user'] = 'Hello';
	$_SESSION['vm_id'] = "Friend";
	setcookie('keep_id', "log_it", time() + 60 );
	setcookie('keep_id', "log_it",  7);
	session_destroy();
	header('location: MyHome');
