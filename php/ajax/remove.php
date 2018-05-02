<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/26/2018
 * Time: 9:46 PM
 * This file will delete students or coaches. the reuqest code from each are stores @ coaches and student modals
 */


include '../connection.php';
include '../dbSelect.php';
$table = $_POST['table'];
if (isset($_POST['coach_id'])){
    $id = $_POST['coach_id'];
    $field = "CoachID";
}else{
    $id = $_POST['student_id'];
    $field = "StudentID";
}
$coach_id = $_POST['coach_id'];
$track_section_id = $_POST['track_section_id'];
$trackID = $_POST['trackId'];

RemoveById($table, array(
    $field => $id,
    "TrackSectionID" => $track_section_id,
    "TrackID" => $trackID,
    ));

return "success";

