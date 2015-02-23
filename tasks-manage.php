<?php
	if(isset($_SESSION['login_user'])){ 
		include('session.php');
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
											<form action="tasks-add.php" class="adduser" method="post">
												<div class="row">
													<input type="text" name="task_id" placeholder="Task ID">
												</div>
												<div class="column">
													<input type="text" name="taskname" placeholder="Task Name">
												</div>
												<div class="column">
													<input type="text" name="score" placeholder="Score">
												</div>												
													Special<br>
													<select name="special">
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
								include 'tasks-tableview.php';
							?>
						</div>
					</div>
				</div>
			</div>
							
		<!-- If _not_ logged in -->
		<?php
			if(!isset($_SESSION['login_user'])){ 
				header('Location: index.php'); // Redirecting To Home Page
			}
		?>
		<footer>
			
		</footer>
	</body>
</html>