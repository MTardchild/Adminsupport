<?php
	include 'MySQLCredentials.php';
	
	$userid = $_POST["user_id"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$level = $_POST["level"];
	$driver = $_POST["driver"];

	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}
		
	// SQL query to fetch information of registered users and finds user match.
	$query = $connection->query("select * from users where id='$userid'");
	$rows = $query->num_rows;
		if ($rows == 1) {
			echo "User ID already in use.";
			exit;
		} else {
			$query = "INSERT INTO users (id, firstname, lastname, level, driver, available, score) VALUES ('$userid', '$firstname', '$lastname', '$level', '$driver', '0', '0')";
			if ($userid == "" || $firstname == "" || $lastname == "" || $level == "" || $driver == "") {
				echo "Error: One or more fields empty";
				exit;
			}
			if ($connection->query($query)) {
				echo "New record created successfully";
			} else {
				echo $connection->errorno . ": " . $connection->error . "\n";
				exit;
			}
		}
	$connection->close(); // Closing Connection
?>