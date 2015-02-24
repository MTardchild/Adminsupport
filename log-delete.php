 <?php
	if (!isset($_SESSION['rights']) || $_SESSION['rights'] == 0) {
		die('You have no permission to access this page.');
	}
	
	include 'MySQLCredentials.php';
	
	if($_GET['id'] == "") {
		echo 'No ID';
		exit;
	}
	$id = $_GET['id'];
	
	if($connection->query("DELETE FROM $log WHERE log_id='$id'")) {
		echo 'Record deleted.';
	} else {
		echo $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection
?>