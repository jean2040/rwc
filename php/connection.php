<?php
$host = "127.0.0.1";
$user = 'root';
$pass = '';
$db = "rwc";

$conn = new mysqli($host,$user,$pass,$db);

if ($conn->connect_error){
    die("Connection Error". $conn->connect_error);
}


?>