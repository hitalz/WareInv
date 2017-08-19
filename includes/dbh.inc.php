<?php
	//Database connection variables
	$host = 'localhost';
	$user = 'root';
	$password = 'root';
	$db = 'inventory';

	$conn = mysqli_connect($host, $user, $password, $db);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
?>
