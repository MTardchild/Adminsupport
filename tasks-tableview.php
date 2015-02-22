<?php
	include 'MySQLCredentials.php';
	$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
	$db = mysql_select_db("phptest", $connection);

	$query = sprintf("SELECT * FROM tasks");
	$result = mysql_query($query);
	
	echo "<table>
	  <thead>
		<tr><th colspan=\"6\">Tasks</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th>Score</th>
		  <th colspan=\"2\">Special</th>
		</tr>
	  </thead>
	  <tbody>";
	  while ($row = mysql_fetch_assoc($result)) {
	echo "
		<tr>
			<td>" . $row['id'] . "</td>
			<td>" . $row['name'] . "</td>
			<td>" . $row['score'] . "</td>
			<td>";
			if($row['special'] == 1) { echo "Yes"; } else { echo "No"; } 
			echo "</td>
		  <td>
			<a href=\"tasks-delete.php?id=" . $row['id'] . "\" class=\"button\">Delete</a>
		  </td>
		</tr>";
	  }
		echo "</tbody></table>";
	mysql_close($connection); 
?>