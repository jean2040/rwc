<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/30/2018
 * Time: 6:43 PM
 */
header("Content-Type: application/json; charset=UTF-8");
include '../connection.php';

//echo "5.15 - ";
//echo $_POST['sectionID'];
$val = $_POST['sectionID'];

//$stmt = $connection->prepare("SELECT * FROM `studenttaketrack` WHERE TrackID = ?");
$stmt = $connection->prepare("SELECT trackhassection.SectionID, trackhassection.TrackSectionID, rwccoachteachtrack.CoachID, rwccoach.Firstname AS 'coachName', COUNT(studenttaketrack.StudentID)
FROM trackhassection
LEFT JOIN rwccoachteachtrack ON rwccoachteachtrack.TrackSectionID = trackhassection.TrackSectionID
LEFT JOIN rwccoach ON rwccoach.CoachID = rwccoachteachtrack.CoachID
LEFT JOIN studenttaketrack ON studenttaketrack.TrackSectionID = trackhassection.TrackSectionID
WHERE trackhassection.DeleteFlag= 'N' AND trackhassection.SectionID = ? 
GROUP by trackhassection.TrackSectionID");

$stmt->bind_param('s', $val);
$stmt->execute();
$result = $stmt->get_result();
$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);



