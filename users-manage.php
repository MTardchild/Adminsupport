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
											<form action="users-add.php" class="adduser" method="post">
													<div class="row">
														<input type="text" name="user_id" placeholder="Staff Number">
													</div>
													<div class="column">
														<input type="text" name="firstname" placeholder="First Name">
													</div>
													<div class="column">
														<input type="text" name="lastname" placeholder="Last Name">
													</div>
													Level<br>
													<select name="level">
														<option value="1">1</option>
														<option value="2">2</option>
														<option value="3">3</option>
													</select>
													Driver's license<br>
													<select name="driver">
														<option value="1">Yes</option>
														<option value="0">No</option>
													</select>
												<input type="submit" value="Add">
											</form>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="smallcard">
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