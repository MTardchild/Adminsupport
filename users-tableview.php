<?php
	include 'MySQLCredentials.php';
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}

	$query = $connection->query("SELECT * FROM users");
	
	echo '<table>
	  <thead>
		<tr><th colspan=\'8\'>Users</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Lastname</th>
		  <th>Level</th>
		  <th>Driver</th>
		  <th >Available</th>
		  <th colspan=\'2\'>Score</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQL_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['id'] . '</td>
			<td>' . $row['firstname'] . '</td>
			<td>' . $row['lastname'] . '</td>									
			<td>' . $row['level'] . '</td>
			<td>';
			if($row['driver'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>									
			<td>';
			if($row['available'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>
			<td>' . $row['score'] . '</td>
		  <td>
			<a href=\'users-delete.php?id=' . $row['id'] . '\' class=\'button\'>Delete</a>
		  </td>
		</tr>';
	  }
	echo '</tbody></table>';
	$connection->close(); 
?>