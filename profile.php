<?php
include('session.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login Form in PHP with Session</title>
		<link href="style.css" rel="stylesheet">
	</head>
	<body>
		<div id="outer">
			<div id="login">
				<div id="content">
					<b id="welcome">Welcome: <i><?php echo $login_session; ?></i></b>
					<b id="logout"><a href="logout.php">Log Out</a></b>
				</div>
			</div>
		</div>
	</body>
</html>