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
					<?php 			
						if($_SESSION['rights'] == 1) 
						{
					?>
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
											<?php 
												include('output.php');					
											?>
											<form action="login-add.php" class="adduser" method="post">
												<div class="column2">
													<select name="userid">
														<option value="" disabled selected>Staff Number</option>
														<?php
															$query = $connection->query("SELECT user_id, firstname FROM $users");
															
															while ($row = $query->fetch_assoc()) 
															{
																echo '<option>' . $row['user_id'] . '</option>';
															}
															$connection->close();
														?> 
													</select>
												</div>
												<div class="column2">
													<select name="rights">
														<option value="" disabled selected>Rights</option>
														<option value="0">Trainee</option>
														<option value="1">Admin</option>
													</select>
												</div>		
												<div class="column"><input type="text" name="username" placeholder="User Name" value=""></div>
												<div class="column"><input type="text" name="password" placeholder="Password" value=""></div>
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
						} else {
							?>
							<div class="restricted">
								<p>
									<b id="welcome">Restricted.</b>
								</p>
								<p>
									User <b><?php echo $_SESSION['user_name']; ?></b> does not have the rights to access this area.
								</p>
							</div>
						<?php } ?>
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