<?php
	// MySQL
	include 'MySQLCredentials.php';
	
	// Storing Session
	$user_check=$_SESSION['login_user'];
	
	// SQL Query To Fetch Complete Information Of User
	$query = $connection->query("SELECT username FROM $login WHERE username='$user_check'");
	$row = $query->fetch_array(MYSQLI_ASSOC);
	$login_session =$row['username'];
	
	if(!isset($login_session)){
		$connection->close(); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?> 