<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/21/2018
 * Time: 1:35 AM
 * THIS FILE WILL ADD STUDENTS TO THE ATTENDANCE TABLE
 * THE ATTENDANCE FILL WILL BE EMPTY
 * THEN IT WILL REDIRECT TO THE take_attendance PAGE
 */
session_start();
include 'connection.php';
include 'dbSelect.php';
include 'dbInsert.php';
$trackSection = $_POST['track_section'];

$students = getAll('studenttaketrack',array('TrackSectionID'=> $trackSection),null,null);

foreach ( $students as $student ){

    insertFields('studentattendance',array('StudentID' => $student['StudentID'],
                                                'TrackSectionID'=> $trackSection,
                                                'TrackID' => $student['TrackID'],
                                                'Date' => date("Y-m-d")
                                                ), 'ignore');
}
$_SESSION['TrackSection']= $trackSection;
header('Location: ../public/studentAttendance.php');



