<?php
	$id = $_GET['id'];
	
	include 'MySQLCredentials.php';
	
	if($connection->query("DELETE from $users WHERE user_id='$id'")) {
		echo "Record deleted.";
	} else {
		echo $connection->errorno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection
?>