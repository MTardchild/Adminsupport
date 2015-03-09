<?php
	include 'MySQLCredentials.php';
	$userid = $_SESSION['user_id'];
	
	$query = $connection->query("SELECT * FROM $log a INNER JOIN $tasks c ON a.task_id = c.task_id WHERE a.done='0' AND a.user_id='$userid'");
	
	if (!$query) {
		echo 'SQL Error' . $connection->error;
	}
	
	echo '<table>
	  <thead>
		<tr><th colspan=\'7\'>Assigned Tasks</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Score</th>
		  <th>Special</th>
		  <th colspan=\'2\'></th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['log_id'] . '</td>
			<td>' . $row['name'] . '</td>
			<td>' . $row['score'] . '</td>
			<td>';
			if($row['special'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>
		  <td>';
            echo '<a href=\'tasks-decline.php?user=' . $userid . '\' class=\'button\'>Decline</a>';
		 echo '</td>
         <td>';
            echo '<a href=\'tasks-done.php?id=' . $row['log_id'] . '\' class=\'button\'>Done</a>';
          echo '</td>
		</tr>';
	  }
		echo '</tbody></table>';
	$connection->close();
?>