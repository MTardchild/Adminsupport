<?php
	include 'MySQLCredentials.php';
	
	$taskid = $_POST["task_id"];
	$taskname = $_POST["taskname"];
	$score = $_POST["score"];
	$special = $_POST["special"];

	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}

	$query = $connection->query("select * from tasks where id='$taskid'");
	$rows = $query->num_rows;
		if ($rows == 1) {
			echo 'Task ID already in use.';
			exit;
		} else {
			$query = "INSERT INTO tasks (id, name, score, special) VALUES ('$taskid', '$taskname', '$score', '$special')";
			if ($taskid == "" || $taskname == "" || $score == "" || $special == "") {
				echo 'Error: One or more fields empty';
				exit;
			}
			if ($query) {
				echo 'New record created successfully';
			} else {
				echo 'Error';
			}
		}
	$connection->close(); // Closing Connection
?>