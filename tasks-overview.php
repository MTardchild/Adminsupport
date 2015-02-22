<?php
	if(isset($_SESSION['login_user'])){ 
	} else {
		include('login.php'); // Login Script
	}
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Admin Support</title>
	<link href="style.css" rel="stylesheet">
	
	<!-- IE6-8 support of HTML5 elements --> <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	</head>
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