<?php

//Credit function to
// Checks POST  Parameters  send by the form on submit and Return Array of all Params
//this Paramr will be used on the sql query
function checkFormParams($param_array){
$cnt = 0;
for($i=0; $i < count($param_array); $i++){
if(isset($_POST[$param_array[$i]])){
$params_set[$param_array[$i]] = $_POST[$param_array[$i]];
$cnt++;
}
$params_set["cnt"] = $cnt;
}
return $params_set;
}

function getId($type){
    return uniqid($type);
}

