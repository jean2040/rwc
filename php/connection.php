<?php
$host = "rwcportal.cibvup9pjqxy.us-east-2.rds.amazonaws.com";
$user = 'rwcadmin';
$pass = 'rwcnjitportal';
$db = "rwc";

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