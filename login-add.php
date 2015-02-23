<?php
	include 'MySQLCredentials.php';
	
	$userid = $_POST["userid"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	// sha512 for encryption
	$password = hash("sha512", $password);

	// Connect to SQL
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}
		
	// SQL query to fetch information of registered users and finds user match.
	$query = $connection->query("select * from login where id='$userid'");
	$rows = $query->num_rows;
		if ($rows == 1) {
			echo "User ID already in use.";
		} else {
			$query = "INSERT INTO login (id, username, password) VALUES ('$userid', '$username', '$password')";
			if ($userid == "" || $username == "" || $password == "") {
				echo "Error: One or more fields empty";
				exit;
			}
			if ($query) {
				echo "New record created successfully";
			} else {
				echo $connection->errno . ": " . $connection->error . "\n";	
			}
		}
	$connection->close(); // Closing Connection
	exit;
?>