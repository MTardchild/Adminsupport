<?php	
	include('rights.php');
	
	$trainee = $_POST['trainee'];
	$task = $_POST['task'];
	$date = $_POST['date'] . ' ';
	$time = $_POST['time'];
	
	$date = $date . $time;
	
	if ($task == 'default') {
		echo 'Error: No task selected';
		exit;
	}
	
	// Connect to SQL
	include 'MySQLCredentials.php';
	
	$query = $connection->query("SELECT score, special FROM $tasks WHERE task_id='$task'");
	$row = $query->fetch_array(MYSQLI_ASSOC);

	if ($query) {
		$task_score = $row['score'];
		$task_special = $row['special'];
	} else {
		echo $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
		
	if ($trainee == 'default') {
		$query = $connection->query("SELECT user_id, score, available FROM $users WHERE available='1' ORDER BY score");
		if (!$query) { echo 'Error: ' . $connection->error; }
		
		if($query->num_rows == 0){
		   echo 'No trainee available.';
		   $connection->close();
		   exit;
		}
		$row = $query->fetch_array(MYSQLI_ASSOC);		
		$trainee = $row['user_id'];
	}

		
	echo 'Trainee selected: ' . $trainee . '<br>';

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
	
	
	$query = $connection->query("SELECT MAX(log_id) FROM $log");
	$row = $query->fetch_array(MYSQLI_BOTH);
	$log_id = $row[0] + 1;
	
	echo "INSERT INTO log (log_id, task_id, user_id, date, done) VALUES ('$log_id', '$task', '$trainee', '$date', '0')";
	
	if($query = $connection->query("INSERT INTO log (log_id, task_id, user_id, date, done) VALUES ('$log_id', '$task', '$trainee', '$date', '0')")) {
		echo 'Task successfully assigned';
	} else {
		echo $connection->errno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection 
?>