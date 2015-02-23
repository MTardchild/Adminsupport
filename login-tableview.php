<?php
	include 'MySQLCredentials.php';
	// Connect to SQL
	$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
	if ($connection->connect_error) {
		die('Connect Error (' . $connection->connect_errno . ') '
		. $connection->connect_error);
	}

	$query = $connection->query("SELECT * FROM login");
	
	echo "<table>
	  <thead>
		<tr><th colspan=\"6\">Login</th></tr>
		<tr>
		  <th>#</th>
		  <th colspan=\"2\">Name</th>
		</tr>
	  </thead>
	  <tbody>";
	  while ($row = $query->fetch_array(MYSQL_ASSOC)) {
	echo "
		<tr>
			<td>" . $row['id'] . "</td>
			<td>" . $row['username'] . "</td>
		  <td>
			<a href=\"login-delete.php?id=" . $row['id'] . "\" class=\"button\">Delete</a>
		  </td>
		</tr>";
	  }
		echo "</tbody></table>";
	$connection->close(); 
?>