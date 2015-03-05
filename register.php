<?php
if(isset($_SESSION['user_id'])){
	header("location: index.php");
}
?>

<?php
	session_start(); // Starting Session
		
	if (isset($_POST['submit'])) {
		include('MySQLCredentials.php');

		if (isset($_POST['userid'])) {
			$userid = $_POST['userid'];
		}
		if (isset($_POST['username'])) {
			$username = $_POST['username'];
		}
		if (isset($_POST['password'])) {
			$password = $_POST['password'];
		}
		if (isset($_POST['password2'])) {
			$password2 = $_POST['password2'];
		}
		
		if(empty($username) OR empty($password) OR empty($userid)) {
			if(!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Input Error. Not all required fields given.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Input Error. Not all required fields given.';
			}
			$connection->close();
			exit(header('Location: register.php'));
		}
		
		if ($password != $password2) {
			if(!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Passwords do not match.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Passwords do not match.';
			}
		}

		$query = $connection->query("SELECT * FROM $login WHERE username LIKE '$username'");
		$return = $query->num_rows;
		
		if ($return > 0) {
			if(!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'Username already in use.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'Username already in use.';
			}
		}
		
		$query = $connection->query("SELECT * FROM $login WHERE user_id LIKE '$userid'");
		$return = $query->num_rows;
		
		if ($return > 0) {
			if(!isset($_SESSION['error'])) {
				$_SESSION['error'] = 'User ID already in use.';
			} else {
				$_SESSION['error'] .= '<br>' . PHP_EOL . 'User ID already in use.';
			}
		}
		
		// sha512 for encryption
		$password = hash("sha512", $password);
		
		$connection->close();
		
		if(!isset($_SESSION['error'])) {
			$entry = "INSERT INTO $login (user_id, username, password) VALUES ('$userid', '$username', '$password')";
			$entry_success = $connection->query($entry);
				
			if($entry_success == true) {
				echo "<p class=\"phpout\">User <b>$username</b> has been created. <a href=\"index.php\">Login</a></p>";
			} else {
				echo '<p class=\"phpout\">Error while trying to save. <a href=\"register.php\">Zurück</a></p>';
				echo $connection->errno . ": " . $connection->error . "\n";
				$connection->close();
			}
		} else {
			$connection->close();
			exit(header('Location: register.php'));
		}
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
					<?php 
						if (isset($_SESSION['error'])) {
							echo '<p class=\'phperror\'>' . $_SESSION['error'] . '</p>';
							unset($_SESSION['error']);
						}
					?>
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
						<input type="text" size="24" maxlength="50" name="username" placeholder="Username" value=""><br><br>

						<input type="password" size="24" maxlength="50" name="password" placeholder="Password" value=""><br>

						<input type="password" size="24" maxlength="50" name="password2" placeholder="Retype Password" value=""><br>
						<input name="submit" type="submit" value="Sign up">
					</form>
					<div id="register">
						<a href="index.php">Login</a> | <a href="">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>