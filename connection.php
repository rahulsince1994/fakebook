<?php
	$servername = "localhost:3307";
	$username = "root";
	$password ="Work_Bench_Pass";
	$database = "fakebook";

	$conn = mysqli_connect($servername,$username,$password,$database);
	// check connection
	if(!$conn){
		die(mysqli_connect_error());
	}
?>