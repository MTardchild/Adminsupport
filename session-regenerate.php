<?php 
	// Session timeout for security
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
		// If the user did not interact with the homepage in the last 30 minutes, destroy session
		header("Location: logout.php");
	}
	$_SESSION['last_activity'] = time(); // update last activity time stamp

	// regenerate session periodically to avoid attacks on sessions
	if (time() - $_SESSION['created'] > 300) {
		// session started more than 5 minutes ago
		session_regenerate_id(true);    // change session ID for the current session and invalidate old session ID
		$_SESSION['created'] = time();  // update creation time
	}
?>