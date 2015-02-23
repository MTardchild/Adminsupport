<?php
if(isset($_SESSION['login_user'])){
	header("location: index.php");
}
?>

<?php
	include 'MySQLCredentials.php';

	session_start(); // Starting Session
	$_SESSION['error'] = ""; // Variable To Store Error Message
		
	if (isset($_POST['submit'])) {
		$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
		if ($connection->connect_error) {
			die('Connect Error (' . $connection->connect_errno . ') '
			. $connection->connect_error);
		}

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

		$query = $connection->query("SELECT * FROM login WHERE username LIKE '$username'");
		$return = $query->num_rows;

		if($return == 0)
		{
			$entry = "INSERT INTO login (id, username, password) VALUES ('$userid', '$username', '$password')";
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
	<head>
		<title>Register</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<div id="outer">
			<div id="middle">
				<div id="content">
					<h2>Register</h2>
					<form action="" method="post">
						<select name="userid">
							<option value="" disabled selected>Personal Number</option>
							<?php
								$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
								if ($connection->connect_error) {
									die('Connect Error (' . $connection->connect_errno . ') '
									. $connection->connect_error);
								}

								$query = $connection->query('SELECT id, firstname FROM users');
								
									while ($row = $query->fetch_array(MYSQL_ASSOC)) 
									{
										echo '<option>' . $row['id'] . '</option>';
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