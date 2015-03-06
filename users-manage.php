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
												include('output.php')
											?>
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