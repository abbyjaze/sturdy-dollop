<?php
session_start();
include('get_all_data.php');
if(isset($_REQUEST['submit']))
  	if($_REQUEST['submit']=='Sign Me IN!') {
		extract($_REQUEST);
		$email=htmlspecialchars(trim($_REQUEST['email']));
		$passwd=md5(htmlspecialchars(trim($_REQUEST['passwd'])));
		$performing_login=get_students("WHERE `stu_email`='$email' AND `stu_pass`='$passwd'");
		if(mysqli_num_rows($performing_login)!=1){
			header('Location:error_page.php?err=101');
			exit();
		}
		else{
			$student=get_assoc($performing_login);
			$_SESSION['login']=$student['stu_email'];
			$_SESSION['stud_id']=$student['stu_id'];
			$_SESSION['user']='student';
  			header('Location: index.php');  
    	}
    header('Location: index.php'); 
}
//set session variable


if(isset($_REQUEST['submit2']))
  	if($_REQUEST['submit2']=='Sign Me IN!') {
		extract($_REQUEST);
		$email=htmlspecialchars(trim($_REQUEST['email']));
		$passwd=md5(htmlspecialchars(trim($_REQUEST['passwd'])));
		$performing_login=get_employers("WHERE `emp_email`='$email' AND `emp_pass`='$passwd'");
		if(mysqli_num_rows($performing_login)!=1){
			header('Location:error_page.php?err=101');
			exit();
		}
		else{
			$employer=get_assoc($performing_login);
			$_SESSION['login']=$employer['emp_email'];
			$_SESSION['emp_name']=$employer['emp_name'];
			$_SESSION['emp_id']=$employer['emp_id'];
			$_SESSION['user']='employer';
		  	header('Location: index.php');  
		    }
    header('Location: index.php'); 
}

?>