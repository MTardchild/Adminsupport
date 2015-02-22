<?php
	include 'MySQLCredentials.php';
	
	$userid = $_POST["user_id"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$level = $_POST["level"];
	$driver = $_POST["driver"];

	// Connect to SQL
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);	
	
	// Selecting Database
	$db = mysql_select_db("phptest", $connection);
		
	// SQL query to fetch information of registered users and finds user match.
	$query = mysql_query("select * from users where id='$userid'", $connection);
	$rows = mysql_num_rows($query);
		if ($rows == 1) {
			echo "User ID already in use.";
			exit;
		} else {
			$query = "INSERT INTO users (id, firstname, lastname, level, driver, available, score) VALUES ('$userid', '$firstname', '$lastname', '$level', '$driver', '0', '0')";
			if ($userid == "" || $firstname == "" || $lastname == "" || $level == "" || $driver == "") {
				echo "Error: One or more fields empty";
				exit;
			}
			if (mysql_query($query)) {
				echo "New record created successfully";
			} else {
				echo mysql_errno($connection) . ": " . mysql_error($connection) . "\n";
				exit;
			}
		}
	mysql_close($connection); // Closing Connection
?>