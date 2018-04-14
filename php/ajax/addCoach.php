<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/14/2018
 * Time: 10:41 PM
 * This code will insert a student into the data base.
 * It takes the values send by the ajax call in the addCoachModal
 * then it returns the value as a JSON to be used by datatables
 */
include '../connection.php';
include '../dbInsert.php';
$table = $_POST['table'];
$coach_id = $_POST['coach_id'];
$section_id = $_POST['section_id'];


$c_student = insertFields($table, array(
    "CoachID" => $coach_id,
    "TrackID" => $section_id,
    "CreationTime" => date("Y-m-d H:i:s"),
    "DeleteFlag" => "N"
));

echo json_encode($c_student);