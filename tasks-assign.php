<?php
	include 'MySQLCredentials.php';
	
	$trainee = $_POST['trainee'];
	$task = $_POST['task'];
	
	if ($task == 'default') {
		echo 'Error: No task selected';
		exit;
	}
	
	// Connect to SQL
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}
	
	$query = $connection->query("SELECT score, special FROM tasks WHERE task_id='$task'");
	$row = $query->num_rows;

	if ($query) {
		$task_score = $row['score'];
		$task_special = $row['special'];
	} else {
		echo $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
		
	if ($trainee == 'default') {
		$query = $connection->query('SELECT user_id, score, available FROM users WHERE available=\'1\' ORDER BY score');
		
		if($query->num_rows == 0){
		   echo "No trainee available.";
		   $connection->close();
		   exit;
		}
		
		$row = $query->fetch_array(MYSQL_ASSOC);
		
		echo 'Lowballer/Trainee selected: ' . $row['user_id'] . '<br>';
	
		$recipient = 'testerino.subject@te.st';
		$subject = 'Addminsupport - New Task Assigned';
		$message = 'Staff Number: ' . $row['user_id'];
		
		$header = 'To: Testerino <testerino.subject@te.st>' . "\r\n";
		$header .= 'From: Adminsupporttool <geburtstag@example.com>' . "\r\n";
		$header .= 'Cc: ausbildung@example.com' . "\r\n";

		if(mail($recipient, $subject, $message, $header)) {
			echo 'Mail: Success <br>';
		} else {
			echo 'Mail: Failure <br>';
		}
	}
	
	$connection->close(); // Closing Connection 
?>