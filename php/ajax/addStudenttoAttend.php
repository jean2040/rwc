<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/8/2018
 * Time: 10:41 PM
 * This code will insert a student into the data base.
 * It takes the values send by the ajax call in the addStudentModal
 * then it returns the value as a JSON to be used by datatables
 */
include '../connection.php';
include '../dbInsert.php';
$table = $_POST['table'];
$student_id = $_POST['student_id'];
$track_sectionId = $_POST['track_sectionId'];
$trackID = $_POST['trackId'];


$c_student = insertFields($table, array(
    "StudentID" => $student_id,
    "TrackSectionID" => $track_sectionId,
    "TrackID" => $trackID,
    "CreationTime" => date("Y-m-d H:i:s"),
    "DeleteFlag" => "N"
),null);

echo json_encode($c_student);