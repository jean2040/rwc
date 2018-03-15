<?php
$host = "127.0.0.1";
$user = 'root';
$pass = '';
$db = "rwc";
//testing gitnore
$connection = new mysqli($host,$user,$pass,$db);

if ($connection->connect_error){
    die("Connection Error". $connection->connect_error);
}

// -- confirm query set
function confirm_query($result_set) {
    if (!$result_set) {
        die("Database query failed.");
    }
}
?>