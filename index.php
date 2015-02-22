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
				<div id="welcomemessage">
					<div class="smallcard">
						<table class="contenttable">
							<thead>
								<tr>
									<th colspan="2">Assign Task</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<form action="tasks-assign.php" class="adduser" method="post">
											<b>Trainee</b><br>
											Usually left default.
											<?php													
												$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
												$db = mysql_select_db("phptest", $connection);

												$query = sprintf("SELECT id, firstname FROM users");
												$result = mysql_query($query);
												
												echo "<select name=\"trainee\"><option value=\"default\">Default</option>";
												while ($row = mysql_fetch_assoc($result)) {
												echo "<option value=\"" . $row['id'] . "\">" . $row['id'] . ", " . $row['firstname'] . "</option>";
												  }
													echo "</select>";
												mysql_close($connection); 
											?>	
											<b>Task</b><br>
											<?php													
												$connection = mysql_connect($MySQLHost, $MySQLUser, $MySQLPass);
												$db = mysql_select_db("phptest", $connection);

												$query = sprintf("SELECT * FROM tasks");
												$result = mysql_query($query);
												
												echo "<select name=\"task\"><option name=\"default\" value=\"default\" selected>Please Select Task</option>";
												while ($row = mysql_fetch_assoc($result)) {
												echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . ", " . $row['score']; 
												if ($row['special'] == 1) {
													echo ", " . "Special";
												}
												echo "</option>";
												  }
													echo "</select>";
												mysql_close($connection); 
											?>	
											<input type="submit" value="Assign">
										</form>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
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
	<!-- If _not_ logged in -->
	<?php
		} else {
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
		}
	?>
	<footer>
		
	</footer>
	</body>
</html>