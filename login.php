<?php
	include 'MySQLCredentials.php';

	session_start(); // Starting Session
	$error=''; // Variable To Store Error Message
	if (isset($_POST['submit'])) {

		// Define $username and $password
		$username=$_POST['username'];
		$password=$_POST['password'];
		
		// Establishing Connection with Server by passing server_name, user_id and password as a parameter
		$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
		
		// To protect MySQL injection for Security purpose
		$username = stripslashes($username);
		$password = stripslashes($password);
		$username = mysql_real_escape_string($username);
		$password = mysql_real_escape_string($password);
		
		// md5 for encryption
		$password = md5($password);
		
		// Selecting Database
		$db = mysql_select_db("phptest", $connection);
		
		// SQL query to fetch information of registered users and finds user match.
		$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
		$rows = mysql_num_rows($query);
			if ($rows == 1) {
				$_SESSION['login_user']=$username; // Initializing Session
				header("location: index.php"); // Redirecting To Other Page
			} else {
			$error = "Username or Password is invalid";
			}
		mysql_close($connection); // Closing Connection
	}
?>