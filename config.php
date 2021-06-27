<?php
	require 'dbconst.php';
	error_reporting(0);
	//creating databse connection
	$connect =  mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	//Check connection and selection
		if (!$connect) {
		    die("Connection failed: " . mysqli_connect_error());
		}else{
			// echo "Connected successfully";
		}

?>