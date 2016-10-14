<?php

extract($_REQUEST);
if(isset($int_id)){
include("header.php");
include("get_all_data.php");
$internships=get_internships("WHERE `int_id`=".$int_id);
$internship=get_assoc($internships);

$emp_id=$internship['int_emp_id'];
$employers=get_employers("WHERE `emp_id`=".$emp_id);
$employer=get_assoc($employers);
$emp_name=$employer['emp_name'];

echo '<h2>'.$internship['int_name'].'</h2>
		<table class="table table-striped table-bordered table-hover text-center">
		<tr>
			<th>Employer Name</th>
			<td class="text-left">'.$emp_name.'</th>
		</tr>
		<tr>
			<th>Duration</th>
			<td class="text-left">'.$internship['int_duration'].'</td>
		</tr>
		<tr>
			<th>Stipend</th>
			<td class="text-left">'.$internship['int_stipend'].'</td>
		</tr>
		<tr>
			<th>Details</th>
			<td class="text-left">'.$internship['int_details'].'</td>
		</tr>
		';
	}
else
	header('Location:index.php');
	exit();
?>