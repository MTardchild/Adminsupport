<?php
	include 'MySQLCredentials.php';
	$id = $_GET['id'];
	
	// Connect to SQL
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);	
	
	// Selecting Database
	$db = mysql_select_db("phptest", $connection);
	
	if(mysql_query("DELETE from users WHERE id='$id'")) {
		echo "Record deleted.";
	} else {
		echo mysql_errno($connection) . ": " . mysql_error($connection) . "\n";
		mysql_close($connection);
		exit;
	}
	mysql_close($connection); // Closing Connection
?>