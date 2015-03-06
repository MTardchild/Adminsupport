<?php 
	if (isset($_SESSION['error'])) {
		echo '<p class=\'phperror\'>' . $_SESSION['error'] . '</p>';
		unset($_SESSION['error']);
	}
	if (isset($_SESSION['success'])) {
		echo '<p class=\'phpsuccess\'>' . $_SESSION['success'] . '</p>';
		unset($_SESSION['success']);
	}						
?>