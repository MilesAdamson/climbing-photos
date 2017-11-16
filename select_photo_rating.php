<?php

include_once 'strings.php';
include_once 'connect.php';
Header(CONTENT_TYPE_HEADER);

/* 
selects rating of a photo from its timestamp
*/
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	if (isset($_POST[T0_C0]))
	{
		$timestamp = $_POST[T0_C0];	
		global $connect;
		$query = "SELECT ".T0_C1." FROM ".T0." WHERE ".T0_C0." = ?;";
		$stmt = $connect->prepare($query);
			
		$stmt->bind_param("d", $timestamp);

		$stmt->execute();
		$result = $stmt->get_result();
		echo $result->fetch_array(MYSQLI_NUM)[0];

		mysqli_stmt_close($stmt);
	} else {
		$timestamp = null;
		echo "null";
	}
}
?>