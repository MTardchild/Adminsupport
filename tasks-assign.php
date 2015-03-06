<?php	
	include('rights.php');
	
	if (isset($_POST['trainee'])) {
		$trainee = $_POST['trainee'];
	}
	if (isset($_POST['task'])) {
		$task = $_POST['task'];		
	}
	if (isset($_POST['date'])) {
		$dateArray = date_parse($_POST['date']);
		
		$date = $dateArray['year'] . '-' . $dateArray['month'] . '-' . $dateArray['day'];
		
		if ($dateArray['error_count'] > 0) {
			if (!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Error: Wrong date format.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: Wrong date format';
			}
		}
	}
	if (isset($_POST['time'])) {
		$timeArray = date_parse($_POST['time']);
		
		$time = $dateArray['hour'] . ':' . $dateArray['minute'] . ':' . $dateArray['second'];

		if ($timeArray['error_count'] > 0) {
			if (!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Error: Wrong time format.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: Wrong time format';
			}
		}
	}
	if (isset($_POST['date']) && isset($_POST['time'])) {
		$date = $date . ' ' . $time;	
	}
	
	if (!isset($task)) {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No task selected';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No task selected';
		}
	}
	if (!isset($date) || $date == null || $date == ' ') {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No date given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No date given';
		}
	}
	if (!isset($time) || $time == null || $time == ' ') {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No time given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No time given';
		}
	}
	
	if (!isset($_SESSION['error'])) {
		// Connect to SQL
		include 'MySQLCredentials.php';
		
		$query = $connection->query("SELECT score, special FROM $tasks WHERE task_id='$task'");
		$row = $query->fetch_array(MYSQLI_ASSOC);

		if ($query) {
			$task_score = $row['score'];
			$task_special = $row['special'];
		} else {
			if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = $connection->errno . ": " . $connection->error;
			} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . $connection->errno . ": " . $connection->error;
			}
		}
			
		if ($trainee == 'default') {
			$query = $connection->query("SELECT * FROM $users a INNER JOIN $login b ON a.user_id = b.user_id WHERE b.rights='0' AND available='1' ORDER BY score");
			if (!$query) { 
				if (!isset($_SESSION['error'])) {
					$_SESSION['error'] = 'Error: ' . $connection->error;
				} else {
					$_SESSION['error'] .= '<br>' . PHP_EOL . $connection->error;
				}
			}
			
			if($query->num_rows == 0){
				if (!isset($_SESSION['error'])) {
					$_SESSION['error'] = 'No trainee eligible for selection.';
				} else {
					$_SESSION['error'] .= '<br>' . PHP_EOL . 'No trainee eligible for selection.';
				}
			}
			$row = $query->fetch_array(MYSQLI_ASSOC);		
			$trainee = $row['user_id'];
		}

		if (!isset($_SESSION['success'])) {
			$_SESSION['success'] = 'Trainee selected: ' . $trainee;
		} else {
			$_SESSION['success'] .= '<br>' . PHP_EOL . 'Trainee selected: ' . $trainee;
		}
		
		// Mail credentials
		$recipient = 'testerino.subject@te.st';
		$subject = 'Addminsupport - New Task Assigned';
		$message = 'Staff Number: ' . $row['user_id'];
		
		$header = 'To: Testerino <testerino.subject@te.st>' . "\r\n";
		$header .= 'From: Adminsupporttool <geburtstag@example.com>' . "\r\n";
		$header .= 'Cc: ausbildung@example.com' . "\r\n";

		// mail returns true if mailing was successful.
		// Note that this does not mean the mail really has been send out!
		if(mail($recipient, $subject, $message, $header)) {
			if (!isset($_SESSION['success'])) {
				$_SESSION['success'] = 'Mail: Success';
			} else {
				$_SESSION['success'] .= '<br>' . PHP_EOL . 'Mail: Success';
			}
		} else {
			if (!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Mail: Failure';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Mail: Failure';
			}			
		}
		
		$query = $connection->query("SELECT MAX(log_id) FROM $log");
		$row = $query->fetch_array(MYSQLI_BOTH);
		$log_id = $row[0] + 1;
		
		if($query = $connection->query("INSERT INTO log (log_id, task_id, user_id, date, done) VALUES ('$log_id', '$task', '$trainee', '$date', '0')")) {
			if (!isset($_SESSION['success'])) {
				$_SESSION['success'] = 'Task successfully assigned.';
			} else {
				$_SESSION['success'] .= '<br>' . PHP_EOL . 'Task successfully assigned.';
			}
		} else {
			$_SESSION['error'] = $connection->errno . ': ' . $connection->error . '<br>' . PHP_EOL;
		}
		$connection->close(); // Closing Connection 
		exit(header('Location: index.php'));		
	} else {
		exit(header('Location: index.php'));
	}
?>