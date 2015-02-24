<?php	
	include('rights.php');
	
	$userid = $_POST["user_id"];
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$level = $_POST["level"];
	$driver = $_POST["driver"];

	include 'MySQLCredentials.php';
		
	$query = $connection->query("SELECT * FROM $users where user_id='$userid'");
	$rows = $query->num_rows;
		if ($rows == 1) {
			echo "User ID already in use.";
			exit;
		} else {
			$query = "INSERT INTO $users (user_id, firstname, lastname, level, driver, available, score) VALUES ('$userid', '$firstname', '$lastname', '$level', '$driver', '0', '0')";
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