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
												// Connect to SQL
												$connection = new mysqli($MySQLHost, $MySQLUser , $MySQLPass, $MySQLDB);
												if ($connection->connect_error) {
													die('Connect Error (' . $connection->connect_errno . ') '
													. $connection->connect_error);
												}

												$query = $connection->query('SELECT user_id, firstname FROM users');
												
												echo '<select name=\'trainee\'><option value=\'default\'>Default</option>';
												while ($row = $query->fetch_array(MYSQL_ASSOC)) {
												echo '<option value=\'' . $row['user_id'] . '\'>' . $row['user_id'] . ', ' . $row['firstname'] . '</option>';
												  }
													echo '</select>';
											?>	
											<b>Task</b><br>
											<?php													
												$query = $connection->query('SELECT * FROM tasks');
												
												echo '<select name=\'task\'><option name=\'default\' value=\'default\' selected>Please Select Task</option>';
												while ($row = $query->fetch_array(MYSQL_ASSOC)) {
												echo '<option value=\'' . $row['user_id'] . '\'>' . $row['name'] . ', ' . $row['score']; 
												if ($row['special'] == 1) {
													echo ', Special';
												}
												echo '</option>';
												  }
													echo '</select>';
												$connection->close(); 
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
	<footer>
		
	</footer>
	</body>
</html>