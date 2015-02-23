<?php
	if(isset($_SESSION['login_user'])){ 
	} else {
		include('login.php'); // Login Script
	}
?>
<!DOCTYPE html>
<html>
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
							include 'tasks-tableview.php';
						?>
					</div>
				</div>
			</div>
		</div>
						
	<!-- If _not_ logged in -->
	<?php
		} else {
			header('Location: index.php'); // Redirecting To Home Page
		}
	?>
	<footer>
		
	</footer>
	</body>
</html>