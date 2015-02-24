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
			header('Location: index.php'); // Redirecting To Home Page
		}
	?>
	
	<!-- If logged in -->
	<?php
			include('session.php');
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
	<footer>
		
	</footer>
	</body>
</html>