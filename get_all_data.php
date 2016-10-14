<?php

include("db_connect.php");

function get_applications($where=NULL){
	$sql_applications="SELECT * FROM `applications`";
	if($where){
		$sql_applications.=" ";
		$sql_applications.=htmlspecialchars($where);
	}
	return mysqli_query($GLOBALS['conn'],$sql_applications);
}

function get_employers($where=NULL){
	$sql_employers="SELECT * FROM `employers`";
	if($where){
		$sql_employers.=" ";
		$sql_employers.=htmlspecialchars($where);
	}
	return mysqli_query($GLOBALS['conn'],$sql_employers);
}

function get_internships($where=NULL){
	$sql_internships="SELECT * FROM `internships`";
	if($where){
		$sql_internships.=" ";
		$sql_internships.=htmlspecialchars($where);
	}
	return mysqli_query($GLOBALS['conn'],$sql_internships);
}

function get_students($where=NULL){
	$sql_students="SELECT * FROM `students`";
	if($where){
		$sql_students.=" ";
		$sql_students.=htmlspecialchars($where);
	}
	return mysqli_query($GLOBALS['conn'],$sql_students);
}

function get_assoc($current_row){
	return mysqli_fetch_assoc($current_row);
}

?> 