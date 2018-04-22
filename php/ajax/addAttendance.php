<?php
/**
 * Created by PhpStorm.
 * User: jeanp
 * Date: 4/21/2018
 * Time: 5:48 PM
 */

include '../connection.php';
include '../dbUpdate.php';
$params = array();
parse_str($_POST['attend'],$params);

for ($i = 0 ; $i < count($params)/3; $i++){
    echo $params['st_ID'.$i] ."\n";
    echo $params['select_option'.$i] ."\n";
    echo $params['comment'.$i] ."\n";
    updateById('studentattendance','StudentID',$params['st_ID'.$i],array('Attendance'=>$params['select_option'.$i], 'Comments'=> $params['comment'.$i]));
}
echo 'updated 4/22';



