<?php

include 'strings.php';
Header(CONTENT_TYPE_HEADER);

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	include 'connect.php';
	insert();
}

function insert()
{
	global $connect;
	
	// create filename with requests timestamp
	$timestamp = strval(microtime(True));
	$filename = $timestamp.TXT_EXT;
	
	// Report count, rating and rating counts are zero initially
	$rating = 0;
	$rating_count = 0;
	$report_count = 0;
	
	
	// get users device ID
	if (isset($_POST[T0_C4]))
	{
		$device = $_POST[T0_C4];	
	} else{
		$device = null;
	}
	
	// get the base64 encoded string of photo data
	if (isset($_POST[DATA]))
	{
		$base64image = $_POST[DATA];	
	} else{
		$base64image = null;
	}
	

	
	$response = array();
	
	$columns = "(".T0_C0.", ".T0_C1.", ".T0_C2.", ".T0_C3.", ".T0_C4.")";
	$query = "INSERT INTO ".T0." " . $columns . " VALUES (?, ?, ?, ?, ?);";

	$stmt = mysqli_prepare($connect, $query);
	mysqli_stmt_bind_param($stmt, "ddiis", $timestamp, $rating,
		$rating_count, $report_count, $device);
		
	mysqli_stmt_execute($stmt);
	
	if(mysqli_affected_rows($connect) == 1)
	{
		$response[SQL_SUCCESS] = 1;
		$response[SQL_MESSAGE] = SQL_INSERT_MESSAGE;
		file_put_contents(PHOTO_PATH.$filename, $base64image);
	} else{
		$response[SQL_SUCCESS] = 0;
		$response[SQL_MESSAGE] = mysqli_error($connect);
	}
	
	echo json_encode($response);
	
	mysqli_stmt_close($stmt);
	mysqli_close($connect);
}

?>

