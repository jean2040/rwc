<?php 
// Generic
// -- Delete a particular record
// @param: expects table name, column name and value
function deleteById($table, $column, $value){
	global $connection;

	$query  = "DELETE FROM {$table}";
	$query .= " WHERE {$column} = {$value}";
	echo $query;
	
	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	
	return $record_set;
}