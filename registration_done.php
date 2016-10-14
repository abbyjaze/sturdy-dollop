<?php
session_start();
include("insert_data.php");
include("get_all_data.php");
extract($_REQUEST);
function filter_data($variable){
	$variable=htmlspecialchars(stripslashes(trim($variable)));
	return $variable;
}
if (isset($submit))
if($submit=='Register'){
	$stud_name=filter_data($stu_name);
	$stud_email=filter_data($stu_email);
	$stu_pass=filter_data($stu_pass);
	$stu_pass=md5($stu_pass);
	$stud_qual=filter_data($stu_qual);
	$stud_contact=filter_data($stu_contact);

	if(!preg_match("/^[0-9]{10}$/", $stud_contact)){
		header('Location:error_page.php?err=2');
		exit();
	}
	$students=get_students();
	while($student=get_assoc($students))
		if($stud_email==$student['stu_email']){
			header('Location:error_page.php?err=1');
			exit();
		}
	$employers=get_employers();
	while($employer=get_assoc($employers)){
		if($stud_email==$employer['emp_email']){
			header('Location:error_page.php?err=104');
			exit();
		}
	}

	insert_students($stud_name,$stud_email,$stu_pass,$stud_qual,$stud_contact);
}
if(isset($submit2))
if($submit2=='Register'){
	$emp_name=filter_data($emp_name);
	$emp_email=filter_data($emp_email);
	$emp_pass=filter_data($emp_pass);
	$emp_pass=md5($emp_pass);
	$emp_addr=filter_data($emp_addr);

	$employers=get_employers();
	while($employer=get_assoc($employers)){
		if($emp_email==$employer['emp_email'])
			header('Location:error_page.php?err=1');
			exit();
	}

	$students=get_students();
	while($student=get_assoc($students))
		if($emp_email==$student['stu_email']){
			header('Location:error_page.php?err=105');
			exit();
		}
	insert_employers($emp_name,$emp_email,$emp_pass,$emp_addr);
}
header('Location:index.php');
?>