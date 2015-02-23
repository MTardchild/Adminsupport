<?php
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	include 'MySQLCredentials.php';
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}
	
	// Storing Session
	$user_check=$_SESSION['login_user'];
	
	// SQL Query To Fetch Complete Information Of User
	$query = $connection->query("select username from login where username='$user_check'");
	$row = $query->fetch_array(MYSQL_ASSOC);
	$login_session =$row['username'];
	
	if(!isset($login_session)){
		$connection->close(); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?> 