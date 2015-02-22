<?php
	include 'MySQLCredentials.php';
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
	$db = mysql_select_db("phptest", $connection);

	$query = sprintf("SELECT * FROM users");
	$result = mysql_query($query);
	
	echo "<table>
	  <thead>
		<tr><th colspan=\"8\">Users</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Lastname</th>
		  <th>Level</th>
		  <th>Driver</th>
		  <th >Available</th>
		  <th colspan=\"2\">Score</th>
		</tr>
	  </thead>
	  <tbody>";
	  while ($row = mysql_fetch_assoc($result)) {
	echo "
		<tr>
			<td>" . $row['id'] . "</td>
			<td>" . $row['firstname'] . "</td>
			<td>" . $row['lastname'] . "</td>									
			<td>" . $row['level'] . "</td>
			<td>";
			if($row['driver'] == 1) { echo "Yes"; } else { echo "No"; } 
			echo "</td>									
			<td>";
			if($row['available'] == 1) { echo "Yes"; } else { echo "No"; } 
			echo "</td>
			<td>" . $row['score'] . "</td>
		  <td>
			<a href=\"users-delete.php?id=" . $row['id'] . "\" class=\"button\">Delete</a>
		  </td>
		</tr>";
	  }
	echo "</tbody></table>";
	mysql_close($connection); 
?>