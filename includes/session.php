<?php

include 'conn.php';
session_start();
if (!isset($_SESSION['inbox_id'])) {
	$_SESSION['inbox_id'] = bin2hex(random_bytes(10));
}

function test_input($data)
{
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
