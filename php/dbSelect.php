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

// -- Get a particular table record by column value
function getByIdJoin($table1, $table2, $joinID, $column, $id) {
    global $connection;

    $query  = "SELECT ";
    $query .= "{$table1}.* ,";
    $query .= "{$table2}.* ";
    $query .= " FROM {$table1}";
    $query .= " JOIN {$table2}";
    $query .= " USING ({$joinID})";
    $query .= " WHERE {$column} = '{$id}'";
    $query .= " Limit 1";

    echo $query;

    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
    return $record_set->fetch_array(MYSQLI_ASSOC);
}

// -- Get all table records
// @param: table name, query_array (associative array of criteria: column => value), sort field and sort order
function getAll($table, $query_array, $sort_field, $sort_order) {
    global $connection;

    $query  = "SELECT *";
    $query .= " FROM {$table}";
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

    if(isset($sort_field)){
        $query .= " ORDER BY";
        $query .= " {$sort_field}";
    }

    if(isset($sort_order)){
        $query .= " {$sort_order}";
    }

    echo $query;

    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
    return $record_set;
}

// this Function call will get the values from two tables using a common joindID
// joindID must be identical in both tables
function getAll2($fields_array,$table,$joinTable, $joinID, $query_array, $sort_field, $sort_order) {
    global $connection;

    $query  = "SELECT ";
    if(isset($fields_array)){
        $h = 0;

        foreach ($fields_array as $field){
            if($h > 0){
                $query .= " ,";
            }
         $query .= "{$field} ";
         $h++;
         }
    }else{
        $query .= "*";
    }
    $query .= " FROM {$table}";

    if(isset($joinTable)){
        $query .= " LEFT JOIN {$joinTable}";
    }


    if(isset($joinID)){
        $query .= " USING";
        $query .= " ({$joinID})";
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

    if(isset($sort_field)){
        $query .= " ORDER BY";
        $query .= " {$sort_field}";
    }

    if(isset($sort_order)){
        $query .= " {$sort_order}";
    }

    //echo $query;

    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
    return $record_set;
}

// Generic
// -- Get count of particular query
// @param: table name, query_array (associative array of criteria: column => value)
function getCount($table, $query_array) {
    global $connection;

    $query  = "SELECT count(*) AS cnt";
    $query .= " FROM {$table}";
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

	//echo $query;
    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
    $result = $record_set->fetch_array(MYSQLI_ASSOC);
    return $result["cnt"];
}

// this Function call will get the values from two tables using a common joindID
// joindID must be identical in both tables
function getCountGroupBy($counter, $fields_array,$table,$joinTable, $joinID, $group_field) {
    global $connection;

    $query  = "SELECT COUNT({$counter}),";
    if(isset($fields_array)){
        $h = 0;

        foreach ($fields_array as $field){
            if($h > 0){
                $query .= " ,";
            }
            $query .= "{$field} ";
            $h++;
        }
    }
    $query .= " FROM {$table}";

    if(isset($joinTable)){
        $query .= " JOIN {$joinTable}";
    }


    if(isset($joinID)){
        $query .= " USING";
        $query .= " ({$joinID})";
    }

    if(isset($sort_field)){
        $query .= " GROUP BY";
        $query .= " {$group_field}";
    }

    echo $query;

    $record_set = mysqli_query($connection, $query);
    confirm_query($record_set);
    return $record_set;
}

