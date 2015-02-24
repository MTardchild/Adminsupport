<?php
	include 'MySQLCredentials.php';
	
	$query = $connection->query("SELECT * FROM $tasks");
	
	if (!$query) {
		echo 'SQL Error' . $connection->error;
	}
	
	echo '<table>
	  <thead>
		<tr><th colspan=\'6\'>Tasks</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Score</th>
		  <th colspan=\'2\'>Special</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['task_id'] . '</td>
			<td>' . $row['name'] . '</td>
			<td>' . $row['score'] . '</td>
			<td>';
			if($row['special'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>
		  <td>
			<a href=\'tasks-delete.php?id=' . $row['task_id'] . '\' class=\'button\'>Delete</a>
		  </td>
		</tr>';
	  }
		echo '</tbody></table>';
	$connection->close(); 
?>