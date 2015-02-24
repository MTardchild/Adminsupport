<?php
	if(!isset($_SESSION['login_user'])){
		include('login.php'); // Login Script		
	}
?>
<!DOCTYPE html>
<html lang="en">
	<?php include('head.html'); ?>
	<body>
	<!-- If _not_ logged in -->
	<?php
		if(!isset($_SESSION['login_user'])) {
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
	?>
		
	<!-- Content -->
		<div id="outer">
			<div id="middle">
				<div id="welcomemessage">
					<?php 
						if($_SESSION['rights'] == 1) {
							echo '<div class=\'smallcard\'>';
									include('task-assign-table.html');
							echo '</div>';
						}
					?>
					<div class="smallcard">
						<div id="welcomestring">
							<p>
								<b id="welcome">Welcome: <i><?php echo $login_session; ?></i></b>
							</p>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non ligula rhoncus, molestie diam sed, pharetra turpis. Morbi cursus neque tincidunt lorem porttitor egestas.
							</p>			
						</div>
					</div>
				</div>
				<div id="dashboard">
					<div class="card">
						<?php
							include 'log-tableview.php';
						?>
					</div>
				</div>
			</div>
		</div>
	<footer>
		
	</footer>
	</body>
</html>