<?php
if(isset($_SESSION['user_id'])){
	header("location: index.php");
}
?>

<?php
	session_start(); // Starting Session
	$_SESSION['error'] = ""; // Variable To Store Error Message
		
	if (isset($_POST['submit'])) {
		include('MySQLCredentials.php');

		$userid = $_POST["userid"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password2 = $_POST["password2"];

		if($password != $password2 OR $username == "" OR $password == "") {
			echo "<p class=\"phpout\">Input Error. Not all required fields given. <a href=\"register.php\">Zurück</a></p>";
			$connection->close();
			exit;
		}
		// sha512 for encryption
		$password = hash("sha512", $password);

		$query = $connection->query("SELECT * FROM $login WHERE username LIKE '$username'");
		$return = $query->num_rows;

		if($return == 0)
		{
			$entry = "INSERT INTO $login (user_id, username, password) VALUES ('$userid', '$username', '$password')";
			$entry_success = $connection->query($entry);
			
			if($entry_success == true) {
				echo "<p class=\"phpout\">User <b>$username</b> has been created. <a href=\"index.php\">Login</a></p>";
			}
			else {
				echo '<p class=\"phpout\">Error while trying to save. <a href=\"register.php\">Zurück</a></p>';
				echo $connection->errno . ": " . $connection->error . "\n";
			}
		} else {
			echo '<p class=\"phpout\">Username already in use. <a href=\"register.php\">Zurück</a></p>';
		}
		$connection->close();
	}
?> 

<!doctype html>
<html lang="de">
	<?php include('head.html'); ?>	
	<body>
		<div id="outer">
			<div id="middle">
				<div id="content">
					<h2>Register</h2>
					<form action="" method="post" class="register">
						<select name="userid">
							<option value="" disabled selected>Personal Number</option>
							<?php
								include('MySQLCredentials.php');

								$query = $connection->query("SELECT user_id, firstname FROM $users");
								
									while ($row = $query->fetch_array(MYSQLI_ASSOC)) 
									{
										echo '<option>' . $row['user_id'] . '</option>';
									}
								$connection->close();
							?>
						</select>
						<input type="text" size="24" maxlength="50" name="username" placeholder="Username"><br><br>

						<input type="password" size="24" maxlength="50" name="password" placeholder="Password"><br>

						<input type="password" size="24" maxlength="50" name="password2" placeholder="Retype Password"><br>
						<input name="submit" type="submit" value="Sign up">
					</form>
				</div>
			</div>
		</div>
	</body>
</html>