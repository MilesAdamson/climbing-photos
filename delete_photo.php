<?php

include_once 'strings.php';
include_once 'connect.php';

/* 
deletes a photo from both the photos table and its text file
*/

function delete_photo($timestamp){
	
	global $connect;
	$query = "DELETE FROM ".T0." WHERE ".T0_C0." = ?;";
	$stmt = $connect->prepare($query);
		
	$stmt->bind_param("d", $timestamp);
	$result = mysqli_stmt_execute($stmt);

	unlink(PHOTO_PATH.$timestamp.TXT_EXT);
	mysqli_stmt_close($stmt);
}
?>