<?php
	// Connect to SQL
	include 'MySQLCredentials.php';

	$query = $connection->query("SELECT * FROM $log a INNER JOIN $users b ON a.user_id = b.user_id INNER JOIN $tasks c ON a.task_id = c.task_id ORDER BY date DESC");

	echo '<div class=\'log\'><table>
	  <thead>
		<tr><th colspan=\'6\'>Log</th></tr>
		<tr>
		  <th>#</th>
		  <th>Task</th>
		  <th>User</th>
		  <th colspan=\'2\'>Date</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
	echo '
	
		<tr>
			<td>' . $row['log_id'] . '</td>
			<td>' . $row['name'] . '</td>
			<td>' . $row['firstname'] . '</td>
			<td>' . $row['date'] . '</td>
		  <td>';
			if($_SESSION['rights'] == 1) { echo '<a href=\'log-delete.php?id=' . $row['log_id'] . '\' class=\'button\'>Delete</a>'; }
		  echo '</td>
		</tr>';
	  }
	echo '</tbody></table></div>';
	$connection->close(); 
?>