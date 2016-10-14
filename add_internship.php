<?php

session_start();
if(isset($_SESSION['login']))
if($_SESSION['user']=='employer'){
	include("insert_data.php");
	extract($_REQUEST);
	$emp_id=$_SESSION['emp_id'];
	function filter_data($variable){
	    $variable=htmlspecialchars(stripslashes(trim($variable)));
	    return $variable;
	}
	if (isset($submit))
	if($submit=='Add this Internship'){
	    $int_name=filter_data($int_name);
	    $int_duration=filter_data($int_duration);
	    $int_stipend=filter_data($int_stipend);
	    $int_details=filter_data($int_details);

	    insert_internships($emp_id,$int_name,$int_duration,$int_stipend,$int_details);
	}
}
header('Location:index.php');

?>