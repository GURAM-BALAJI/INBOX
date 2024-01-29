<?php

include 'conn.php';
session_start();
if (!isset($_COOKIE['inbox_id'])) {
	setcookie("inbox_id", bin2hex(random_bytes(10)), time() + 3600 * 24 * 30 * 5);
}
function test_input($data)
{
	$data = strip_tags($data);
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
