<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "internship_portal";

	$conn=new mysqli($servername, $username, $password, $dbname);
	if(mysqli_connect_error()){
		die("Database Connection Failed : ".mysqli_connect_error());
		}
?>	