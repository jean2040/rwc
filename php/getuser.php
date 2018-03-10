<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/10/2018
 * Time: 8:31 AM
 */
include 'connection.php';
include 'dbSelect.php';

$id = $_POST['user_id'];

$user = getById('rwccoach','CoachID',$id);

echo json_encode($user);
