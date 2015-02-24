<?php
	session_start();
	if (!isset($_SESSION['rights']) || $_SESSION['rights'] == 0) {
		die('You have no permission to access this page.');
	}
?>