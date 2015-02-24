<?php
	$id = $_GET['id'];
	
	include 'MySQLCredentials.php';
	
	if($connection->query("UPDATE $log SET done='1' WHERE log_id='$id'")) {
		echo "<b>Task marked as done.</b><br>";
		
		if($query = $connection->query("SELECT log_id, b.user_id, c.score, b.score AS scoreUser FROM $log a INNER JOIN $users b ON a.user_id = b.user_id INNER JOIN $tasks c ON a.task_id = c.task_id WHERE log_id='$id'")){
			$row = $query->fetch_array(MYSQLI_ASSOC);
			$score = $row['score'] + $row['scoreUser'];
			$user = $row['user_id'];
			
			if($connection->query("UPDATE $users SET score='$score' WHERE user_id='$user'")) {
				echo "<b>Successfully added score</b><br>";
			}
		} else {
			echo $connection->errorno . ": " . $connection->error . "\n";
			$connection->close();
			exit;
		}
	} else {
		echo $connection->errorno . ": " . $connection->error . "\n";
		$connection->close();
		exit;
	}
	$connection->close(); // Closing Connection
?>