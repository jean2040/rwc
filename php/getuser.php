<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/10/2018
 * Time: 8:31 AM
 */
include 'connection.php';
include 'dbSelect.php';

$id = $_POST['id'];
$table = $_POST['table'];
$value = $_POST['value'];

$user = getById($table,$value ,$id);
if (isset($user["LanguageSkill"])){
    $user["LanguageSkill"] = unserialize($user["LanguageSkill"]);
}

echo json_encode($user);
