<?php
	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {

		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		// Connect to SQL
		include 'MySQLCredentials.php';
		
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
			$query = $connection->query("SELECT * FROM login WHERE username='$username'");
			$row = $query->fetch_array(MYSQLI_ASSOC);
			
			$_SESSION['user_id'] = $row['user_id']; // Initializing Session
			$_SESSION['user_name'] = $row['username']; // Initializing Session			
			$_SESSION['rights'] = $row['rights']; // Variable to store the users rights
			// Variable to store creation time and last activity time of the
			// session so it times out and regenerates
			$_SESSION['created'] = time();
			$_SESSION['last_activity'] = time();
			$_SESSION['error'] = ''; // Variable to store error message
			$_SESSION['success'] = ''; // Variable to store success message
			
			header("Location: index.php"); // Redirecting To Other Page
		} else {
		$error = "Username or Password is invalid";
		}
		$connection->close(); // Closing Connection
	}
?>