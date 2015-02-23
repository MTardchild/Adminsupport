<?php
	if(isset($_SESSION['login_user'])){ 
	} else {
		include('login.php'); // Login Script
	}
?>
	<?php include('head.html'); ?>
	<body>
	<!-- If logged in -->
	<?php
		if(isset($_SESSION['login_user'])){
			include('session.php');
			// Navi 
			include('navi.html');
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
						
	<!-- If _not_ logged in -->
	<?php
		} else {
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
	<footer>
		
	</footer>
	</body>
</html>