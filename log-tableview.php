<?php
	include 'MySQLCredentials.php';
	// Connect to SQL
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}

	$query = $connection->query("SELECT * FROM log ORDER BY date DESC");

	echo "<div class=\"log\"><table>
	  <thead>
		<tr><th colspan=\"6\">Log</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>User</th>
		  <th colspan=\"2\">Date</th>
		</tr>
	  </thead>
	  <tbody>";
	  while ($row = $query->fetch_array(MYSQL_ASSOC)) {
	echo "
		<tr>
			<td>" . $row['id'] . "</td>
			<td>" . $row['task'] . "</td>
			<td>" . $row['user'] . "</td>
			<td>" . $row['date'] . "</td>
		  <td>
			<a href=\"log-delete.php?id=" . $row['id'] . "\" class=\"button\">Delete</a>
		  </td>
		</tr>";
	  }
	echo "</tbody></table></div>";
	$connection->close(); 
?>