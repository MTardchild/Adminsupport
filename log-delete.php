 <?php
	include 'MySQLCredentials.php';
	
	if($_GET['id'] == "") {
		echo 'No ID';
		exit;
	}
	$id = $_GET['id'];
	
	// Connect to SQL
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}
	
	if($connection->query("DELETE from log WHERE log_id='$id'")) {
		echo 'Record deleted.';
	} else {
		echo $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection
?>