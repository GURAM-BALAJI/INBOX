<?php

include 'conn.php';
session_start();
if (!isset($_SESSION['vm_id'])) {
	$_SESSION['vm_id'] = bin2hex(random_bytes(10));
}

function test_input($data)
{
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
