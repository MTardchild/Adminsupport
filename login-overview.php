<?php
	if(isset($_SESSION['user_id'])){
		include('session.php');
	} else {
		include('login.php'); // Login Script
	}
?>
<!DOCTYPE html>
<html>
	<?php include('head.html'); ?>	
	<!-- If _not_ logged in -->
	<?php
		if(!isset($_SESSION['user_id'])){
			header('Location: index.php'); // Redirecting To Home Page
		}
	?>
	<body>
	<!-- If logged in -->
	<?php
			include('navi.html');
	?>
	<!-- Content -->
		<div id="outer">
			<div id="middle">
				<div id="dashboard">
					<div class="card">
						<?php
							include 'login-tableview.php';
						?>
					</div>
				</div>
			</div>
		</div>
	<footer>
		
	</footer>
	</body>
</html>