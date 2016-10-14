<?php
session_start();
function filter_data($variable){
    $variable=htmlspecialchars(stripslashes(trim($variable)));
    return $variable;
}
include('insert_data.php');
include('get_all_data.php');
$stu_id=$_SESSION['stud_id'];
$int_id=filter_data($_REQUEST['int_id']);

$internships=get_internships("WHERE `int_id`=$int_id");
$internships=get_assoc($internships);

$employer=get_employers("WHERE `emp_id`=".$internships['int_emp_id']);
$employer=get_assoc($employer);
$emp_id=$employer['emp_id'];

insert_applications($int_id,$stu_id,$emp_id);
header('Location: index.php'); 
?>