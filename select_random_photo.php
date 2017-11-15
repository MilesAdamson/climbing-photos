<?php	
include 'strings.php';	
/*
echos the base64 encoded string which represents a 
random image saved on the server. 
*/
if($_SERVER["REQUEST_METHOD"]=="GET")
{
	// remove random dots from start of array
	$files = array_diff(scandir(PHOTO_PATH), array('..', '.'));
	
	// correct index issues caused by the dots at the start of array
	$zeroIndexedFiles = array();
	foreach ($files as $columnName => $columnData) {
		array_push($zeroIndexedFiles, $columnData);
    }
	
	// choose a random file and get its filename
	$randomIndex = rand(0, sizeof($zeroIndexedFiles) - 1);
	$randomFilename = "http://192.168.1.69/climb/photos/".$zeroIndexedFiles[$randomIndex];

	echo $randomFilename;
	
	/*
	$fp = fopen($randomFilename, 'rb');

	header("Content-Type: image/jpg");
	header("Content-Length: " . filesize($randomFilename));

	fpassthru($fp);
	*/
}
?>