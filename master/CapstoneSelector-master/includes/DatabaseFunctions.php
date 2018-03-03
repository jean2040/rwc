<?php 

// Database Connection Parameters
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "r00t");
define("DB_NAME", "selector"); 

// AFS Database Connection Parameters
/* define("DB_SERVER", "sql2.njit.edu");
define("DB_USER", "dbd24");
define("DB_PASS", "53j7zTHQ");
define("DB_NAME", "dbd24") */;



// Create database connection
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Test if connection succeeded
if(mysqli_connect_errno()) {
  die("Database connection failed: " . 
       mysqli_connect_error() . 
       " (" . mysqli_connect_errno() . ")"
  );
}


// Generic
// -- confirm query set
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}


// Include Other Database Functions
require_once("DatabaseFunctionsSelect.php");
require_once("DatabaseFunctionsInsert.php");
require_once("DatabaseFunctionsUpdate.php");
require_once("DatabaseFunctionsDelete.php");