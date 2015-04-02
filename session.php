<?php
	include 'MySQLCredentials.php';
	
	$user_check = $_SESSION['user_id'];
	
	$query = $connection->query("SELECT user_id FROM $login WHERE user_id='$user_check'");
	$row = $query->fetch_array(MYSQLI_ASSOC);
	
	if(!isset($row['user_id'])) {
		$connection->close();
		header('Location: index.php');
	}
?> 