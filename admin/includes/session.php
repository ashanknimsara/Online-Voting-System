<?php
ob_start(); 
session_set_cookie_params([
    'lifetime' => 0,   // 0 means until the browser is closed
    'path'     => '/',
    'domain'   => '',
    'secure'   => false, // If you use HTTPS, set this to true
    'httponly' => true   // Enable HTTP Only flag
]);
	session_start();
	include 'includes/conn.php';

	if(!isset($_SESSION['admin']) || trim($_SESSION['admin']) == ''){
		header('location: index.php');
	}

	$sql = "SELECT * FROM admin WHERE id = '".$_SESSION['admin']."'";
	$query = $conn->query($sql);
	$user = $query->fetch_assoc();

	ob_end_flush(); 
	
?>