<?php	
	include('rights.php');
	
	// Check userid
	if (isset($_POST['userid'])) {
		$userid = $_POST['userid'];
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No valid userid given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No valid userid given';
		}
	}
	
	// Check rights
	if (isset($_POST['rights'])) {
		$rights = $_POST['rights'];
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No valid rights given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No valid rights given';
		}
	}
	
	// Check username
	if (!empty($_POST['username'])) {
		$username = $_POST['username'];
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No user name given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No user name given';
		}
	}
	
	// Check password
	if (!empty($_POST['password'])) {
		$password = $_POST['password'];
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No password given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No password given';
		}
	}
	// sha512 for encryption
	$password = hash("sha512", $password);

	// Connect to SQL
	include 'MySQLCredentials.php';
		
	// SQL query to fetch information of registered users and finds user match.
	$query = $connection->query("SELECT * FROM $login WHERE user_id='$userid'");
	$rows = $query->num_rows;
	
	if ($rows > 0) {
		if(!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'User ID already in use';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'User ID already in use';
		}
	}

	// SQL query to fetch information of registered users and finds user match.
	$query = $connection->query("SELECT * FROM $login WHERE username='$username'");
	$rows = $query->num_rows;
	
	if ($rows > 0) {
		if(!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'User name already in use';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'User name already in use';
		}
	}	
	
	if (!isset($_SESSION['error'])) {
		$query = "INSERT INTO $login (user_id, username, password, rights) VALUES ('$userid', '$username', '$password', '$rights')";
		if ($connection->query($query)) {
			$_SESSION['success'] = "New record created successfully";
		} else {
			$_SESSION['error'] = 'SQL Error ' . $connection->errno . ": " . $connection->error;
		}
	}
	$connection->close(); // Closing Connection
	exit(header('Location: login-manage.php'));
?>