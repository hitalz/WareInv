<?php
	//Database connection variables
	$host = 'localhost';	// host name
	$user = 'root';	// MySQL username
	$password = 'root';	// MySQL password
	$db = 'inventory';	// database name

	$conn = mysqli_connect($host, $user, $password, $db);

	if(!$conn) {
		die("Connection failed: ".mysqli_connect_error());
	}
?>
