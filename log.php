<?php
	if(!isset($_SESSION['login_user'])){
		include('login.php'); // Login Script
	}
?>
<!doctype html>
<html lang="en">
	<?php include('head.html'); ?>
	<body>
		<!-- If _not_ logged in -->
	<?php
		if(!isset($_SESSION['login_user'])){
	?>
		<div id="outer">
			<div id="middle">
				<div id="content">
					<form action="" method="post">
						<input id="name" name="username" placeholder="Username" type="text">
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
		}
	?>
	
	<!-- If logged in -->
	<?php
		if(isset($_SESSION['login_user'])){
			include('session.php');
			include('navi.html');
		}
	?>
	<!-- Content -->
		<div id="outer">
			<div id="middle">
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