<?php
		include 'MySQLCredentials.php';
		
		$taskid = $_POST["task_id"];
		$taskname = $_POST["taskname"];
		$score = $_POST["score"];
		$special = $_POST["special"];

		// Connect to SQL
		$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);	
		
		// Selecting Database
		$db = mysql_select_db("phptest", $connection);
			

		$query = mysql_query("select * from tasks where id='$taskid'", $connection);
		$rows = mysql_num_rows($query);
			if ($rows == 1) {
				echo "Task ID already in use.";
				exit;
			} else {
				$query = "INSERT INTO tasks (id, name, score, special) VALUES ('$taskid', '$taskname', '$score', '$special')";
				if ($taskid == "" || $taskname == "" || $score == "" || $special == "") {
					echo "Error: One or more fields empty";
					exit;
				}
				if (mysql_query($query)) {
					echo "New record created successfully";
				} else {
					echo "Error";
				}
			}
		mysql_close($connection); // Closing Connection
?>