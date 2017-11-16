<?php

include_once 'strings.php';
include_once 'connect.php';

/* 
selects an entry from photos table given a timestamp.
The return value is an array with its elements in the same
order as the database table.

Returns null if no photo is found.
*/

function select_photo($timestamp){
	global $connect;
	$query = "SELECT ".T0_C0.", ".T0_C1.", ".T0_C2.", ".T0_C3.", ".T0_C4." FROM ".T0." WHERE ".T0_C0." = ?;";
	$stmt = $connect->prepare($query);
		
	$stmt->bind_param("d", $timestamp);
		
	mysqli_stmt_execute($stmt);
	$stmt->bind_result($timestamp, $rating, $rating_count, $report_count, $device);

	$response = array();
	$rows = array();
	$result = $stmt->get_result();

	// convert result into an array for the return variable
	while($row = $result->fetch_array()){
		array_push($response, $row[T0_C0]);
		array_push($response, $row[T0_C1]);
		array_push($response, $row[T0_C2]);
		array_push($response, $row[T0_C3]);
		array_push($response, $row[T0_C4]);
	}
	mysqli_stmt_close($stmt);
	return $response;
}
?>