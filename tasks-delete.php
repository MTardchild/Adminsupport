<?php
		include 'MySQLCredentials.php';
		if($_GET['id'] == "") {
			echo 'No ID';
			exit;
		}
		$id = $_GET['id'];
		
		$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
		if ($connection->connect_error) {
			die('Connect Error (' . $connection->connect_errno . ') '
			. $connection->connect_error);
		}
		
		if($connection->query("DELETE from tasks WHERE task_id='$id'")) {
			echo 'Record deleted.';
		} else {
			echo $connection->errno . ": " . $connection->error . "\n";
			$connection->close();
			exit;
		}
		$connection->close(); // Closing Connection 
?>