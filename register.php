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
		$connection = mysql_connect($MySQLHost, $MySQLUser , $MySQLPass)
		or die("Could not connect to database");

		mysql_select_db("phptest") or die ("Unable to select database");

		$userid = $_POST["userid"];
		$username = $_POST["username"];
		$password = $_POST["password"];
		$password2 = $_POST["password2"];

		if($password != $password2 OR $username == "" OR $password == "") {
			echo "<p class=\"phpout\">Input Error. Not all required fields given. <a href=\"register.php\">Zurück</a></p>";
			exit;
		}
		$password = md5($password);

		$result = mysql_query("SELECT * FROM login WHERE username LIKE '$username'");
		$return = mysql_num_rows($result);

		if($return == 0)
		{
			$entry = "INSERT INTO login (id, username, password) VALUES ('$userid', '$username', '$password')";
			$entry_success = mysql_query($entry);
			
			if($entry_success == true) {
				echo "<p class=\"phpout\">User <b>$username</b> has been created. <a href=\"index.php\">Login</a></p>";
			}
			else {
				echo "<p class=\"phpout\">Error while trying to save. <a href=\"register.php\">Zurück</a></p>";
				echo mysql_errno($connection) . ": " . mysql_error($connection) . "\n";
			}
		} else {
			echo "<p class=\"phpout\">Username already in use. <a href=\"register.php\">Zurück</a></p>";
		}
		mysql_close($connection);
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
									
									$connection = mysql_connect($MySQLHost, $MySQLUser , $MySQLPass)
									or die("Could not connect to database");

									mysql_select_db("phptest") or die ("Unable to select database");

									$query = sprintf("SELECT id, firstname FROM users");
									$result = mysql_query($query);
									
										while ($row = mysql_fetch_assoc($result)) 
										{
											echo "<option>" . $row['id'] . "</option>";
										}
									mysql_close($connection);
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