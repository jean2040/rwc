<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/4/2018
 * Time: 10:41 PM
 */
include 'connection.php';
include 'dbInsert.php';
$table = $_POST['table'];
$track_id = $_POST['track_id'];
$section_id = $_POST['section_id'];


$c_track = insertFields($table, array(
        "TrackID" => $track_id,
        "SectionID" => $section_id,
        "CreationTime" => date("Y-m-d H:i:s"),
        "DeleteFlag" => "N"
));

echo json_encode($c_track);