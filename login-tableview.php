<?php
	include 'MySQLCredentials.php';
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
	$db = mysql_select_db("phptest", $connection);

	$query = sprintf("SELECT * FROM login");
	$result = mysql_query($query);
	
	echo "<table>
	  <thead>
		<tr><th colspan=\"6\">Login</th></tr>
		<tr>
		  <th>#</th>
		  <th colspan=\"2\">Name</th>
		</tr>
	  </thead>
	  <tbody>";
	  while ($row = mysql_fetch_assoc($result)) {
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
	mysql_close($connection); 
?>