<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/22/2018
 * Time: 9:15 PM
 */
// general
// -- Update a record in particular table
// @param: expects id and associative array of fields and values to be updated
function updateById($table, $query_array, $fields_array){

    global $connection;

    $query = "UPDATE " . $table . " SET ";
    $cnt = 0;
    foreach($fields_array as $key => $value){
        $query .= ($cnt > 0) ? ", " : " " ;
        $query .=	$key . "= '" . mysqli_real_escape_string($connection, $value) ."'";
        $cnt++;
    }

    if(isset($query_array)){
        $query .= " WHERE";
        $cnt=0;
        foreach ($query_array as $key => $value) {
            if($cnt > 0) $query .= " AND";
            $query .= " {$key} = ";
            if (substr($value, 0, 1) == "_"){
                $query .= substr($value, 1);
            } else {
                $query .= " '" . $value . "'";
            }
            $cnt++;
        }
    }

    echo $query;

    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
}