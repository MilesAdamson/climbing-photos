<?php

include_once 'strings.php';
include_once 'connect.php';
include_once 'connect.php';
include_once 'select_photo.php';
	
Header(CONTENT_TYPE_HEADER);

/*
Given a posted rating and timestamp, update the entry in the
db with a new average rating and an increased rating count
*/

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	global $connect;
	
	if (isset($_POST[T0_C0]))
	{
		$timestamp = $_POST[T0_C0];	
	} else{
		$timestamp = null;
	}
	
	if (isset($_POST[T0_C1]))
	{
		$new_rating = $_POST[T0_C1];	
	} else{
		$new_rating = null;
	}

	$row = select_photo($timestamp);
	$old_rating = $row[1];
	$rating_count = $row[2];	
	$report_count = $row[3];
	$device = $row[4];
		
	$rating_result = (($old_rating * $rating_count) + $new_rating) / ($rating_count + 1);
	$rating_count = $rating_count + 1;
	
	$query = "UPDATE ".T0." SET ".T0_C1." = '$rating_result', ".T0_C2." = '$rating_count' WHERE ".T0_C0." = $timestamp;";
	echo $query;
	
	if ($connect->query($query) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $connect->error;
	}
	
	mysqli_close($connect);
	
}

?>
