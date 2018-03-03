<!doctype html>
<html>
<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PM&amp;O, Group 1</title>
</head>

<?php 
require_once("../includes/Sessions.php");
require_once("../includes/Functions.php");
		
		$_SESSION["authenticated"] = null;
		$_SESSION["username"] = null;
		$_SESSION["fname"] = null;
		$_SESSION["lname"] = null;
		$_SESSION["id"] = null;
		$_SESSION["id"] = null;
		$_SESSION["type"] = null;
		$_SESSION["oname"] = null;
	

	// Destroy session
	$_SESSION = array();
	if (isset($_COOKIE[session_name()])) {
	  setcookie(session_name(), '', time()-42000, '/');
	}
	session_destroy(); 
	redirectTo("index.php");
?>
</body>
</html>