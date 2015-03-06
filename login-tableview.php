<?php
	include 'MySQLCredentials.php';

	$query = $connection->query("SELECT * FROM $users a INNER JOIN $login b ON a.user_id = b.user_id WHERE b.rights='0'");
	
	echo '<table>
	  <thead>
		<tr><th colspan=\'8\'>Trainees</th></tr>
		<tr>
		  <th>#</th>
		  <th>User Name</th>
		  <th>Level</th>
		  <th>Driver</th>
		  <th >Available</th>
		  <th colspan=\'2\'>Score</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['user_id'] . '</td>
			<td>' . $row['username'] . '</td>									
			<td>' . $row['level'] . '</td>
			<td>';
			if($row['driver'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>									
			<td>';
			if($row['available'] == 1) { echo 'Yes'; } else { echo 'No'; } 
			echo '</td>
			<td>' . $row['score'] . '</td>
		  <td>';
			if($_SESSION['rights'] == 1) { echo '<a href=\'login-delete.php?id=' . $row['user_id'] . '\' class=\'button\'>Delete</a>'; }
		  echo '</td>
		</tr>';
	  }
	echo '</tbody></table>';
	
	$query = $connection->query("SELECT * FROM $users a INNER JOIN $login b ON a.user_id = b.user_id WHERE b.rights='1'");
	
	echo '<table>
	  <thead>
		<tr><th colspan=\'8\'>Admins</th></tr>
		<tr>
		  <th>#</th>
		  <th>Name</th>
		  <th colspan=\'2\'>Lastname</th>
		</tr>
	  </thead>
	  <tbody>';
	  while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
	echo '
		<tr>
			<td>' . $row['user_id'] . '</td>
			<td>' . $row['firstname'] . '</td>
			<td>' . $row['lastname'] . '</td>
			<td>';
			// Protect user from deleting his own account
			if($_SESSION['rights'] == 1 && $_SESSION['user_id'] != $row['user_id']) { 
				echo '<a href=\'login-delete.php?id=' . $row['user_id'] . '\' class=\'button\'>Delete</a>'; 
			} else {
				echo '<b>Forbidden</b>';
			}
		  echo '</td>			
		</tr>';
	  }
	echo '</tbody></table>';
	
	$connection->close(); 
?>