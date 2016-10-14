<?php

session_start();
if(isset($_SESSION['user'])=='employer'){
	extract($_REQUEST);
	include('insert_data.php');
	if($_REQUEST['stat']=='a')
		status_update('TRUE',$id);
	else
		status_update('FALSE',$id);
	header('Location:review_applications.php');
}
else
	header('Location:error_page.php?err=202');
?>