<?php
	include('rights.php');
	
	if($_GET['id'] == "") {
		$_SESSION['error'] = 'No ID given.';
		exit(header('Location: login-manage.php'));
	}
	$id = $_GET['id'];
	
	include 'MySQLCredentials.php';
	
	if($connection->query("DELETE from $login WHERE user_id='$id'")) {
		$_SESSION['success'] = 'Record deleted.';
	} else {
		$_SESSION['error'] = $connection->errno . ": " . $connection->error . "\n";
	}
	$connection->close(); // Closing Connection 
	exit(header('Location: login-manage.php'));
?>