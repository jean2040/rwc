<?php
/**
 * Created by PhpStorm.
 * User: JeanPaul
 * Date: 3/7/2018
 * Time: 9:01 PM
 */

// Generic
// -- Get a particular table record by column value
function getById($table, $column, $id) {
    global $connection;

    $query  = "SELECT *";
    $query .= " FROM {$table}";
    $query .= " WHERE {$column} = '{$id}'";
    $query .= " Limit 1";

    //echo $query;

    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
    return $record_set->fetch_array(MYSQLI_ASSOC);
}