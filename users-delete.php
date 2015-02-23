<?php
	include 'MySQLCredentials.php';
	$id = $_GET['id'];
	
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}
	
	if($connection->query("DELETE from users WHERE id='$id'")) {
		echo "Record deleted.";
	} else {
		echo $connection->errorno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection
?>