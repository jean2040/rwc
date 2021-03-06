<?php 
// General
// -- Create a Blank Record
// @param: expects table name
function insertBlank($table) {

	global $connection;

	$query  = "INSERT INTO {$table}";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $connection->insert_id;
}


// General
// -- Create a Blank Record with selected fields
// @param: expects table, fields_array
function insertFields($table, $fields_array) {
	$keys = null;
	$values = null;
	global $connection;

	$query  = "INSERT INTO {$table}";
	$i = 0;

	foreach($fields_array as $key => $value){
		$value1 = mysqli_real_escape_string($connection, $value);
		
		if($i == 0) {
			$keys .= " {$key}";
			$values .= "'{$value1}'";	
		} else {
			$keys .= ", {$key}";
			$values .= ", '{$value1}'";	
		}
		$i++;
	}
	$query .= "(";
	$query .= $keys;
	$query .= ")";
	$query .= " VALUES (";
	$query .= $values;
	$query .= ")";
	
	//echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $connection->insert_id;
}


