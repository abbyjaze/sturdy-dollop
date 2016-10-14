<?php
include("header.php");
include("get_all_data.php");
?>


<?php

//include intenrships
if(isset($_SESSION['login'])){
	//student version internships
	if($_SESSION['user']=='student'){
		//applied internships
		$applications=get_applications("WHERE `app_stud_id`=".$_SESSION['stud_id']);
		if(mysqli_num_rows($applications)==0)
	    	echo "No internships applied yet!<br><br>";
		else{
			echo '<h2>Your Applications</h2>
					<table class="table table-striped table-bordered table-hover text-center"><tr>
						<th>Employer Name</th>
						<th>Stipend Offered</th>
						<th>Internship Name</th>
						<th>Status</th>
						</tr>';
			while($row=get_assoc($applications)) {
					//get Internship Name
					$app_int_id=$row['app_int_id'];
					$internships=get_internships("WHERE `int_id`=".$app_int_id);
					$internship=get_assoc($internships);
					if($row['app_status']==NULL)
						$app_status='Not Reviewed Yet';
					elseif ($row['app_status']==TRUE)
						$app_status='Shortlisted';
					elseif ($row['app_status']==FALSE)
						$app_status='Rejected';

					$emp_id=$internship['int_emp_id'];
					$employers=get_employers("WHERE `emp_id`=".$emp_id);
					$employer=get_assoc($employers);
					$emp_name=$employer['emp_name'];
					$stipend=($internship['int_stipend']==0?'Unpaid':$internship['int_stipend']);
					echo '<tr>';
		        	echo "<td>".$emp_name."</td><td>". $stipend. "</td><td>" . $internship['int_name']."</td><td>".$app_status. "</td>";
		        	echo '</tr>';
				}
				echo '</table>';
		}
		//all internships
		$internships=get_internships("WHERE internships.int_id NOT IN (SELECT app_int_id FROM `applications`)");

		if(mysqli_num_rows($internships) == 0)
	    	echo "<h2>You have applied to all available Internships!</h2>";
		else{
			echo '<h2>All Internships</h2>
					<table class="table table-striped table-bordered table-hover text-center"><tr>
						<th>Employer Name</th>
						<th>Stipend Offered</th>
						<th>Internship Name</th>
						<th>Want to Apply?</th>
						</tr>';
			while($row=get_assoc($internships)) {
					$emp_id=$row['int_emp_id'];
					$employers=get_employers("WHERE `emp_id`=".$emp_id);
					$employer=get_assoc($employers);
					$emp_name=$employer['emp_name'];
					$stipend=($row['int_stipend']==0?'Unpaid':$row['int_stipend']);
					echo '<tr>';
		        	echo "<td>".$emp_name."</td><td>". $stipend. "</td><td><a href='internship_details.php?int_id=".$row['int_id']."'>" . $row['int_name']. "</a></td>";
		        	echo '<td><a href="add_app.php?int_id='.$row['int_id'].'">APPLY</a></td>';
		        	echo '</tr>';
				}
			echo '</table>';	
		}
	}
	elseif($_SESSION['user']=='employer'){
		$internships=get_internships();
		if($internships == NULL)
	    	echo "No internships posted yet!";
		else{
			echo '<h2>All Internships</h2>
					<table class="table table-striped table-bordered table-hover text-center"><tr>
						<th>Employer Name</th>
						<th>Stipend Offered</th>
						<th>Internship Name</th>
						</tr>';
			while($row=get_assoc($internships)) {
					$emp_id=$row['int_emp_id'];
					$employers=get_employers("WHERE `emp_id`=".$emp_id);
					$employer=get_assoc($employers);
					$emp_name=$employer['emp_name'];
					$stipend=($row['int_stipend']==0?'Unpaid':$row['int_stipend']);
					echo '<tr>';
		        	echo "<td>".$emp_name."</td><td>". $stipend. "</td><td><a href='internship_details.php?int_id=".$row['int_id']."'>" . $row['int_name']. "</a></td>";
		        	echo '</tr>';
				}
			echo '</table>';
		}
		//add internships
		echo '<a data-toggle="modal" data-target="#add_InternshipModal" role="button">Add Internship</a><br><br>';
		//review internships
		echo '<a href="review_applications.php">Review Applications</a>';
	}
}
else{
	$internships=get_internships();
	if($internships == NULL)
    	echo "No internships posted yet!";
	else{
		echo '<table class="table table-striped table-bordered table-hover text-center"><tr>
						<th>Employer Name</th>
						<th>Stipend Offered</th>
						<th>Internship Name</th>
						</tr>';
		while($row=get_assoc($internships)) {
				$emp_id=$row['int_emp_id'];
				$employers=get_employers("WHERE `emp_id`=".$emp_id);
				$employer=get_assoc($employers);
				$emp_name=$employer['emp_name'];
				$stipend=($row['int_stipend']==0?'Unpaid':$row['int_stipend']);
				echo '<tr>';
	        	echo "<td>".$emp_name."</td><td>". $stipend. "</td><td><a href='internship_details.php?int_id=".$row['int_id']."'>" . $row['int_name']. "</a></td>";
	        	echo '</tr>';
			}
		echo '</table>';
	}
}
?>
<?php
if(isset($_SESSION['login']) && $_SESSION['user']=='employer')
echo '
<div id="add_InternshipModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" data-keyboard="true">&times;</button>
        <h4 class="modal-title"><center>Add Internship</center></h4>
      </div>
      <div class="modal-body">
        <table class="table table-responsive table-hover">
            <form id="register_form" method="post" action="add_internship.php"><center>
            <tbody>
            <tr>    
                <td><input name="int_name" type="text" maxlength="30" placeholder="Name?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="int_duration" type="number" maxlength="2" placeholder="Duration in Months?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="int_stipend" type="number" placeholder="Stipend?(0 for unpaid)" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>    
                <td><input name="int_details" type="textarea" rows="20" cols="100" placeholder="Details?" required="required" class="form-control input-sm"/><br></td>
            </tr>
            <tr>
                <td colspan="2"><br><input name="submit" type="submit" value="Add this Internship" class="btn btn-primary btn-block" /></td>
            </tr>
            </tbody>
            </form>
        </table>
      </div>
    </div>

  </div>
</div>';
echo "</div>";
echo "</body></html>";
?>