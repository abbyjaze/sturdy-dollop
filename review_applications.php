<?php

include("header.php");
include("get_all_data.php");
	if($_SESSION['user']=='employer'){
		$emp_id=$_SESSION['emp_id'];
		$emp_name=$_SESSION['emp_name'];
		$internships=get_internships("WHERE `int_emp_id`=$emp_id");
		if($internships == NULL)
	    	echo "No internships posted yet!";
		else{
			$applications=get_applications("WHERE `app_emp_id`=$emp_id");
			echo '<table class="table table-striped table-bordered table-hover text-center">	
						<th>Internship Details</th>
						<th>Student Name</th>
						<th>Last Qualification</th>
						<th>Mobile Number</th>
						<th>Current Status</th>
						</tr>';
			while($row=get_assoc($applications)) {
					$stu_id=$row['app_stud_id'];
					$student=get_students("WHERE `stu_id`=$stu_id");
					$student=get_assoc($student);
					$internships=get_internships("WHERE `int_id`=".$row['app_int_id']);
					$internships=get_assoc($internships);
					echo '<tr>';
		        	echo  "<td>".$internships['int_details']."</td><td>". $student['stu_name']. "</td><td>" . $student['stu_qual']."</td><td>".$student['stu_contact']."</td>";
		        	echo '<td>';
		        	if($row['app_status']==NULL){
						$app_status='Not Reviewed Yet';
						echo '<a href="stat_change.php?stat=a&id='.$row['app_id'].'">Shortlist</a>';
						echo '/<a href="stat_change.php?stat=r&id='.$row['app_id'].'">Reject</a>' ."&nbsp; &nbsp;<br><br>";	
					}
					elseif ($row['app_status']==TRUE){
						$app_status='Shortlisted';
						echo 'Already Shortlisted'."&nbsp; &nbsp;<br><br>";
					}
					elseif ($row['app_status']==FALSE){
						$app_status='Rejected';
						echo 'Rejected'."&nbsp; &nbsp;<br><br>";
					}
					echo '</td></tr>';
				}
			echo '</table>';
		}

	}
	else
		header('Location:error_page.php?err=202');

?>