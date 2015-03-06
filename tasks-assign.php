<?php	
	include('rights.php');
	
	// Make sure input is correct
	if (isset($_POST['trainee'])) {
		$trainee = $_POST['trainee'];
	}
	
	// Check Task
	if (isset($_POST['task'])) {
		$task = $_POST['task'];		
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No task selected';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No task selected';
		}
	}
	
	// Check Date
	if (isset($_POST['date'])) {
		// date_parse returns associative array
		// Using date_parse so the input string can be in different formats
		$dateArray = date_parse($_POST['date']);
		
		$date = $dateArray['year'] . '-' . $dateArray['month'] . '-' . $dateArray['day'];
		
		if ($dateArray['error_count'] > 0) {
			// If the session cookie already exists Im just appending it in the next line
			// the error log for the user is far more detailed this way
			if (!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Error: Wrong date format.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: Wrong date format';
			}
		}
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No date given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No date given';
		}
	}

	// Check Time
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
	} else {
		if (!isset($_SESSION['error'])) {
			$_SESSION['error'] = 'Error: No time given';
		} else {
			$_SESSION['error'] .= '<br>' . PHP_EOL . 'Error: No time given';
		}
	}
	
	// Concatenating strings so its a valid SQL timestamp
	if (isset($_POST['date']) && isset($_POST['time'])) {
		$date = $date . ' ' . $time;	
	}
	
	// No error so far? Go on.
	// Note: SQL Errors = Severe
	// So if an SQL error occurs the script will stop immediately
	if (!isset($_SESSION['error'])) {
		// Connect to SQL
		include 'MySQLCredentials.php';
		
		$query = $connection->query("SELECT score, special FROM $tasks WHERE task_id='$task'");
		$row = $query->fetch_array(MYSQLI_ASSOC);

		if ($query) {
			$task_score = $row['score'];
			$task_special = $row['special'];
		} else {
			$_SESSION['error'] = $connection->errno . ": " . $connection->error;
			$connection->close(); // Closing Connection 
			exit(header('Location: index.php'));
		}
			
		// If no trainee given
		if ($trainee == 'default') {
			// Select all trainees (rights=0) that are available (available=1) and order by score
			$query = $connection->query("SELECT * FROM $users a INNER JOIN $login b ON a.user_id = b.user_id WHERE b.rights='0' AND available='1' ORDER BY score");
			
			// $connection->query returns true if the query was successful
			// if not error handling
			if (!$query) { 
				if (!isset($_SESSION['error'])) {
					$_SESSION['error'] = 'Error: ' . $connection->error;
					$connection->close(); // Closing Connection 
					exit(header('Location: index.php'));
				}
			}
			
			// If theres no trainee available at the moment (0 rows)
			if($query->num_rows == 0){
				if (!isset($_SESSION['error'])) {
					$_SESSION['error'] = 'No trainee eligible for selection.';
				} else {
					$_SESSION['error'] .= '<br>' . PHP_EOL . 'No trainee eligible for selection.';
				}
			} else {
				$row = $query->fetch_array(MYSQLI_ASSOC);		
				$trainee = $row['user_id'];
			}
		}
		
		// Output/Response for user
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
		
		// Get log ID to use (Latest aka highest ID + 1)
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