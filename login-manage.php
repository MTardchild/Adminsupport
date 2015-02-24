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
											<form action="login-add.php" class="adduser" method="post">
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
						} else {
							?>
							<div class="restricted">
								<p>
									<b id="welcome">Restricted.</b>
								</p>
								<p>
									User <b><?php echo $_SESSION['login_user']; ?></b> does not have the rights to access this area.
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