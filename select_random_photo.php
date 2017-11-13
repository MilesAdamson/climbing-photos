<?php	

include 'strings.php';	

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
	$randomFilename = $zeroIndexedFiles[$randomIndex];
	
	// open and read file
	$path = PHOTO_PATH."$randomFilename";
	$handle = fopen($path, "rb");
	$contents = fread($handle, filesize($path));
	echo $contents;

}
?>