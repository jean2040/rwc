<?php 
require_once("../includes/DatabaseFunctions.php");

// Redirect Page to URI
function redirectTo($page) {
	$host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  header("Location: http://$host$uri/$page");
  ob_end_flush();
  exit;
}


// Check if User Is Logged In
function isLoggedIn() {
	if (!isset($_SESSION["authenticated"])) {
		return false;
	} else {
		return true;
	}
}


// Check if User Is Logged In
function validateUser() {
	if (!isLoggedIn()) {
		redirectTo("index.php");
	}
}

// Check if Executive Team
function isAdmin() {
	if (!isLoggedIn()) {
		redirectTo("index.php");
	} else if($_SESSION["type"] != "executive") {
		redirectTo("myhome.php");
	} 
	return true;
}

// Convert Date
function dateMath($queryDate, $dateString) {
	$date=date_create($queryDate);
	date_add($date, date_interval_create_from_date_string($dateString));
	return strtotime(date_format($date, 'Y-m-d H:i:s'));
}


// Check Query Parameters and Return Array of all Params
function checkQueryParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_GET[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_GET[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}


// Check Form Post Parameters and Return Array of all Params
function checkFormParams($param_array){
	$cnt = 0;
	for($i=0; $i < count($param_array); $i++){
		if(isset($_POST[$param_array[$i]])){
			$params_set[$param_array[$i]] = $_POST[$param_array[$i]];
			$cnt++;
		}
		$params_set["cnt"] = $cnt;
	}
	return $params_set;
}


// Return Current Server Date in DB Format
function currentDate(){
	$date = date("Y-m-d H:i:s");
	return $date;
}


// Pad Strings with Preceding Zeros
function padString($number, $pad_len){
	$result=null;
	for($i=0; $i < $pad_len - strlen($number); $i++){
		$result .= "0";
	}
	$result .= $number;
	return $result;
}


// Generate Query String from Associative Array
function queryString($param_array){
	$cnt = 0;
	$qstring = null;
	foreach ($param_array as $key => $value){
		if($cnt > 0){
			$qstring .= "&" . $key . "=" . $value;
		} else {
			$qstring = $key . "=" . $value;
		}
		$cnt++;
	}
	return $qstring;
}

// Generate Random Password
function randomPassword() {
	$set = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $length = strlen($set);
    $passLength = rand(4,6);
    $randomPass = '';

    for ($i = 0; $i < $passLength; $i++) {
        $randomPass .= $set[rand(0, $length - 1)];
    }
    return $randomPass;
}


// Generate Password Hash
function passHash($password) {
	$options = array(
    	"cost" => 12,
    	"salt" => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	);
	$theHash = password_hash($password, PASSWORD_BCRYPT, $options);
	return $theHash;
}


// Verify Username and Password
function isValidUser($username, $password) {
	$result = getByTwoIds("user", "userEmail", $username, "userPassword", $password);
	if(isset($result)){
		$_SESSION["authenticated"] = true;
		$_SESSION["username"] = $result["userEmail"];
		$_SESSION["fname"] = $result["userFname"];
		$_SESSION["lname"] = $result["userLname"];
		$_SESSION["id"] = $result["id"];
		$_SESSION["type"] = $result["userType"];
		$_SESSION["oname"] = $result["userOname"];
		return true; 
	}
	return false;
}