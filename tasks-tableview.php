<?php
	include 'MySQLCredentials.php';
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}

	$query = $connection->query('SELECT * FROM tasks');
	
	echo '<table>
	  <thead>
		<tr><th colspan=\"6\">Tasks</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Score</th>
		  <th colspan=\"2\">Special</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQL_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['id'] . '</td>
			<td>' . $row['name'] . '</td>
			<td>' . $row['score'] . '</td>
			<td>';
			if($row['special'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>
		  <td>
			<a href=\"tasks-delete.php?id=' . $row['id'] . '\" class=\"button\">Delete</a>
		  </td>
		</tr>';
	  }
		echo '</tbody></table>';
	$connection->close(); 
?>