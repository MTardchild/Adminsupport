<?php
	include('rights.php');
	
	if($_GET['id'] == "") {
		$_SESSION['error'] = 'No ID given.';
		exit(header('Location: log-manage.php'));
	}
	$id = $_GET['id'];
	
	include 'MySQLCredentials.php';
	
	if($connection->query("DELETE FROM $log WHERE log_id='$id'")) {
		$_SESSION['success'] = 'Record deleted.';
	} else {
		$_SESSION['error'] = $connection->errno . ": " . $connection->error . "\n";
	}
	$connection->close(); // Closing Connection
	exit(header('Location: log-manage.php'));
?>