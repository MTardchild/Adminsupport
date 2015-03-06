<?php
	include('rights.php');
	
	if($_GET['id'] == "") {
		$_SESSION['error'] = 'No ID';
		exit(header('Location: tasks-manage.php'));
	}
	$id = $_GET['id'];
	
	include 'MySQLCredentials.php';
	
	if($connection->query("DELETE from $tasks WHERE task_id='$id'")) {
		$_SESSION['success'] = 'Record deleted.';
	} else {
		$_SESSION['error'] = $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit(header('Location: tasks-manage.php'));
	}
	$connection->close(); // Closing Connection 
	exit(header('Location: tasks-manage.php'));
?>