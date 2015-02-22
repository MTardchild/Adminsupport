<?php
	include 'MySQLCredentials.php';
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
	$db = mysql_select_db("phptest", $connection);

	$query = sprintf("SELECT * FROM log ORDER BY date DESC");
	$result = mysql_query($query);

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
	  while ($row = mysql_fetch_assoc($result)) {
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
	mysql_close($connection); 
?>