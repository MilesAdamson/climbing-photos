<?php

include_once 'strings.php';
include_once 'connect.php';
include_once 'connect.php';
include_once 'select_photo.php';
	
Header(CONTENT_TYPE_HEADER);

/*
Increases the report count of a photo by one.
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
		
	$report_result = $report_count + 1;
	
	$query = "UPDATE ".T0." SET ".T0_C3." = '$report_result' WHERE ".T0_C0." = $timestamp;";
	echo $query;
	
	if ($connect->query($query) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: " . $connect->error;
	}
	
	//TODO: delete photo and update users table if there are too many reports
	
	mysqli_close($connect);
	
}

?>
