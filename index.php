<?php
	if(!isset($_SESSION['user_id'])){
		include('login.php'); // Login Script		
	}
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('head.html'); ?>
	<body>
	<!-- If _not_ logged in -->
	<?php
		if(!isset($_SESSION['user_id'])) {
	?>
		<div id="outer">
			<div id="middle">
				<div id="content">
					<form action="" method="post">
						<input id="name" name="username" placeholder="Username" type="text"><br>
						<input id="password" name="password" placeholder="Password" type="password">
						<input name="submit" type="submit" value="Sign In">
						<span><?php echo $error; ?></span>
					</form>
					<div id="register">
						<a href="register.php">Register</a> | <a href="">Forgot Password?</a>
					</div>
				</div>
			</div>
		</div>
	<?php
		exit;
		}
	?>
	
	<!-- If logged in -->
	<?php 
		include('navi.html');	
		include('session.php');
		include('session-regenerate.php');
	?>
		
	<!-- Content -->
		<div id="outer">
			<div id="middle">
				<div id="welcomemessage">
					<div class='smallcard'>
						<?php 
							if($_SESSION['rights'] == 1) {
								include('task-assign-table.html');
							} else {
								include('users-tasks.php');
							}
						?>
					</div>
					<div class="smallcard">
						<div id="welcomestring">
							<p>
								<b id="welcome">Welcome <?php echo $_SESSION['user_name'] . '!'; ?></b>
							</p>
							<p>
								<b>Your Rights:</b>
								<?php if($_SESSION['rights'] == 1) { echo ' Admin'; } else { echo ' User'; } ?>
							</p>
							<?php if($_SESSION['rights'] == 0) {
							echo'<p>
								<b>Your Score:</b> ';
									include('MySQLConnect.php');
									
									$id = $_SESSION['user_id'];
									if($query = $connection->query("SELECT score from $users WHERE user_id='$id'")) {
										echo $query->fetch_array(MYSQLI_ASSOC)['score'];
									} else {
										$_SESSION['error'] = $connection->errorno . ": " . $connection->error . "\n";
										$connection->close();
										exit(header('Location: index.php'));
									}
									$connection->close(); // Closing Connection
							}
								?>
							</p>			
						</div>
					</div>
				</div>
				<div id="dashboard">
					<div class="card">
						<?php
							include('log-tableview.php');
						?>
					</div>
				</div>
			</div>
		</div>
	<footer>
		
	</footer>
	</body>
</html>