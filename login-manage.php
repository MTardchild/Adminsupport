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
						<div class="smallcard">
							<table class="contenttable">
								<thead>
									<tr>
										<th colspan="2">Add</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<form action="login-add.php" class="adduser" method="post">
												<select name="userid">
													<option value="" disabled selected>Staff Number</option>
													<?php
														$connection = new mysqli($MySQLHost, $MySQLUser, '', $MySQLPass);
														if ($connection->connect_error) {
														die('Connect Error (' . $connection->connect_errno . ') '
																. $connection->connect_error);
														}

														$connection->select_db('phptest');

														$query = $connection->query('SELECT id, firstname FROM users');
														
														while ($row = $query->fetch_assoc) 
														{
															echo '<option>' . $row['id'] . '</option>';
														}
														$connection->close();
													?> 
												</select>
												<div class="column"><input type="text" name="username" placeholder="User Name"></div>
												<div class="column"><input type="text" name="password" placeholder="Password"></div>
												<input type="submit" value="Add">
											</form>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="smallcard">
							<?php
								include 'login-tableview.php';
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