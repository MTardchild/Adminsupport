<?php	
	include('rights.php');
	
	$taskid = $_POST["task_id"];
	$taskname = $_POST["taskname"];
	$score = $_POST["score"];
	$special = $_POST["special"];
	
	include 'MySQLCredentials.php';

	$query = $connection->query("select * from $tasks where task_id='$taskid'");
	$rows = $query->num_rows;
		if ($rows == 1) {
			$_SESSION['error'] = 'Task ID already in use.';
			exit(header('Location: tasks-manage.php'));
		} else {
			$query = "INSERT INTO $tasks (task_id, name, score, special) VALUES ('$taskid', '$taskname', '$score', '$special')";
			if ($taskid == "" || $taskname == "" || $score == "" || $special == "") {
				$_SESSION['error'] = 'Error: One or more fields empty';
				exit(header('Location: tasks-manage.php'));
			}
			if ($connection->query($query)) {
				$_SESSION['success'] = 'New record created successfully';
			} else {
				$_SESSION['error'] = 'Error';
			}
		}
	$connection->close(); // Closing Connection
	exit(header('Location: tasks-manage.php'));
?>