<?php
	if(isset($_SESSION['user_id'])){ 
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
		if(isset($_SESSION['user_id'])){
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
							include 'users-tableview.php';
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