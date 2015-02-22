<?php
	include 'MySQLCredentials.php';
	
	$userid = $_POST["userid"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$password = md5($password);

	// Connect to SQL
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);	
	
	// Selecting Database
	$db = mysql_select_db("phptest", $connection);
		
	// SQL query to fetch information of registered users and finds user match.
	$query = mysql_query("select * from login where id='$userid'", $connection);
	$rows = mysql_num_rows($query);
		if ($rows == 1) {
			echo "User ID already in use.";
		} else {
			$query = "INSERT INTO login (id, username, password) VALUES ('$userid', '$username', '$password')";
			if ($userid == "" || $username == "" || $password == "") {
				echo "Error: One or more fields empty";
				exit;
			}
			if (mysql_query($query)) {
				echo "New record created successfully";
			} else {
				echo mysql_errno($connection) . ": " . mysql_error($connection) . "\n";	
			}
		}
	mysql_close($connection); // Closing Connection
	exit;
?>