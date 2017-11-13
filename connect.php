<?php

include 'strings.php';

$connect = mysqli_connect(hostname, user, password, databaseName)
OR die('Could not connect: '.mysqli_connect_error());

if (!$connect){
	echo 'Could not connect: '.mysqli_connect_error();
}

?>