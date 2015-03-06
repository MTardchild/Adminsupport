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
			$_SESSION['error'] = "User ID already in use.";
			exit(header('Location: users-manage.php'));
		} else {
			$query = "INSERT INTO $users (user_id, firstname, lastname, level, driver, available, score) VALUES ('$userid', '$firstname', '$lastname', '$level', '$driver', '0', '0')";
			if ($userid == "" || $firstname == "" || $lastname == "" || $level == "" || $driver == "") {
				$_SESSION['error'] = "Error: One or more fields empty";
				exit(header('Location: users-manage.php'));
			}
			if ($connection->query($query)) {
				$_SESSION['success'] = "User successfully created.";
				exit(header('Location: users-manage.php'));
			} else {
				$_SESSION['error'] = $connection->errorno . ": " . $connection->error . "\n";
				$connection->close();
				exit(header('Location: users-manage.php'));
			}
		}
	$connection->close(); // Closing Connection
?>