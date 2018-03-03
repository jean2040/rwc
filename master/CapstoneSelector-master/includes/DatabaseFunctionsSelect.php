<?php

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


// Generic
// -- Get a particular table record by column value
function getByTwoIds($table, $column1, $id1, $column2, $id2) {
	global $connection;

	$query  = "SELECT *";
	$query .= " FROM {$table}";
	$query .= " WHERE {$column1} = '{$id1}'";
	$query .= " AND {$column2} = '{$id2}'";
	$query .= " Limit 1";
	
	// echo $query;

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	return $record_set->fetch_array(MYSQLI_ASSOC);
}

// Generic
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

	$query  = "SELECT count(*) as cnt";
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
	

	$record_set = mysqli_query($connection, $query);
	confirm_query($record_set);
	$result = $record_set->fetch_array(MYSQLI_ASSOC);
	return $result["cnt"];
}