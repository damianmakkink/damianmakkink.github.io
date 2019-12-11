<?php
	include('db.php');
	session_start();
	
	$user_check = $_SESSION['user'];
	
	$ses_sql = mysqli_query($db,"SELECT username FROM admin_users WHERE username = '$user_check' ");
	$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
	
	$user = $row['username'];
	
	if(!isset($_SESSION['user'])){
		header("location: login.php");
		die();
	}
?>