<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/26/2018
 * Time: 9:46 PM
 */

include '../connection.php';
include '../dbSelect.php';
$table = $_POST['table'];
$coach_id = $_POST['coach_id'];
$track_section_id = $_POST['track_section_id'];
$trackID = $_POST['trackId'];

RemoveById($table, array(
    "CoachID" => $coach_id,
    "TrackSectionID" => $track_section_id,
    "TrackID" => $trackID,
    ));

return "success";

