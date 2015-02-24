<?php
	include('rights.php');
	
	if($_GET['id'] == "") {
		echo 'No ID';
		exit;
	}
	$id = $_GET['id'];
	
	include 'MySQLCredentials.php';
	
	if($connection->query("DELETE from $tasks WHERE task_id='$id'")) {
		echo 'Record deleted.';
	} else {
		echo $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection 
?>