<?php
	// MySQL
	include 'MySQLCredentials.php';
	
	// Storing Session
	$user_check=$_SESSION['user_id'];
	
	// SQL Query To Fetch Complete Information Of User
	$query = $connection->query("SELECT user_id FROM $login WHERE user_id='$user_check'");
	$row = $query->fetch_array(MYSQLI_ASSOC);
	
	if(!isset($row['user_id'])) {
		$connection->close(); // Closing Connection
		header('Location: index.php'); // Redirecting To Home Page
	}
?> 