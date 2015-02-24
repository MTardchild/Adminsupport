<?php
	// Connect to SQL
	include 'MySQLCredentials.php';

	$query = $connection->query("SELECT * FROM $login");
	
	echo '<table>
	  <thead>
		<tr><th colspan=\'6\'>Login</th></tr>
		<tr>
		  <th>#</th>
		  <th colspan=\'2\'>Name</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['user_id'] . '</td>
			<td>' . $row['username'] . '</td>
		  <td>';
			if($_SESSION['rights'] == 1) { echo '<a href=\'login-delete.php?id=' . $row['user_id'] . '\' class=\'button\'>Delete</a>'; }
		  echo '</td>
		</tr>';
	  }
		echo '</tbody></table>';
	$connection->close(); 
?>