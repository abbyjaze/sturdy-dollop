<?php
include("db_connect.php");

function insert_applications($app_int_id,$stud_id,$emp_id){
	$sql_applications="INSERT INTO applications";
	if($app_int_id && $stud_id){
		$sql_applications.="(`app_int_id`,`app_stud_id`,`app_emp_id`) VALUES ";
		$sql_applications.="('$app_int_id','$stud_id','$emp_id')";
	}
	if(mysqli_query($GLOBALS['conn'],$sql_applications)){
    	echo "New record created successfully";
	} 
	else{
    	echo "Error: " . $sql_applications . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}

function insert_students($name,$email,$pwd,$qual,$contact){
	$sql_students="INSERT INTO `students`";
	if($name && $email && $pwd){
		$sql_students.=" (`stu_name`, `stu_email`, `stu_pass`, `stu_qual`, `stu_contact`) VALUES ";
		$sql_students.="('$name','$email','$pwd','$qual','$contact')";
	}
	if (mysqli_query($GLOBALS['conn'],$sql_students)){
    	echo "New record created successfully";
	} 
	else{
    	echo "Error: " . $sql_students . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}

function insert_employers($name,$email,$pwd,$addr){
	$sql_employers="INSERT INTO `employers`";
	if($name && $email && $pwd){
		$sql_employers.=" (`emp_name`, `emp_email`, `emp_pass`, `emp_addr`) VALUES ";
		$sql_employers.="('$name','$email','$pwd','$addr')";
	}
	if (mysqli_query($GLOBALS['conn'],$sql_employers)){
    	echo "New record created successfully";
	} 
	else{
    	echo "Error: " . $sql_employers . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}

function insert_internships($emp_id,$int_name,$duration,$stipend,$details){
	$sql_internships="INSERT INTO `internships`";
	if($emp_id && $duration && $stipend){
		$sql_internships.=" (`int_emp_id`, `int_name`, `int_duration`, `int_stipend`, `int_details`) VALUES ";
		$sql_internships.="('$emp_id','$int_name','$duration','$stipend','$details')";
	}
	if (mysqli_query($GLOBALS['conn'],$sql_internships)){
    	echo "New record created successfully";
	} 
	else{
    	echo "Error: " . $sql_internships . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}

function status_update($value,$id){
	$sql_status="UPDATE `applications` SET `app_status`=$value WHERE `app_id`=$id";
	if (mysqli_query($GLOBALS['conn'],$sql_status)){
    	echo "New record created successfully";
	} 
	else{
    	echo "Error: " . $sql_status . "<br>" . mysqli_error($GLOBALS['conn']);
    }
}
?>