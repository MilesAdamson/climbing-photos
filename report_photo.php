<?php

include_once 'strings.php';
include_once 'connect.php';
include_once 'connect.php';
include_once 'select_photo.php';
include_once 'delete_photo.php';

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
	
	if ($row != null){
		$rating = $row['1'];
		$rating_count = $row['2'];	
		$report_count = $row['3'];
		$device = $row['4'];
			
		$report_result = $report_count + 1;
		
		$query = "UPDATE ".T0." SET ".T0_C3." = '$report_result' WHERE ".T0_C0." = $timestamp;";
		echo $query;
		
		if ($connect->query($query) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $connect->error;
		}
		
		// If the first two people to see a photo report it, delete it.
		// Or, if it gets reported a lot and is low rated.
		if ($report_result == 2 && $rating_count <= 2){
			delete_photo($timestamp);
		} else if ($report_result > 10 && $rating < 3.0){
			delete_photo($timestamp);
		}
	} else {
		echo "photo does not exist";
	}
	
	mysqli_close($connect);
	
}

?>
