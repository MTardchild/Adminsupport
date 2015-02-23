<?php
	include 'MySQLCredentials.php';

	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {

		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		// Connect to SQL
		$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
		if ($connection->connect_error) {
			die('Connect Error (' . $connection->connect_errno . ') '
			. $connection->connect_error);
		}
		
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = $connection->real_escape_string($username);
		$password = $connection->real_escape_string($password);
		
		// sha512 for encryption
		$password = hash("sha512", $password);
		
		// SQL query to fetch information of registered users and finds user match.
		$query = $connection->query("select * from login where password='$password' AND username='$username'");
		$rows = $query->num_rows;
			if ($rows == 1) {
				$_SESSION['login_user']=$username; // Initializing Session
				
				$query = $connection->query("SELECT rights FROM login WHERE username='$username'");
				$row = $query->fetch_array(MYSQLI_ASSOC);
				
				$_SESSION['rights'] = $row['rights'];
				
				header("location: index.php"); // Redirecting To Other Page
			} else {
			$error = "Username or Password is invalid";
			}
		$connection->close(); // Closing Connection
	}
?>