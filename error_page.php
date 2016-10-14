<?php

session_start();
extract($_REQUEST);

if($err==1){
	$err=0;
	echo '<script type="text/javascript"> alert("This email already exists!"); window.location.href = "index.php"; </script>';
	exit();
}
if($err==2){
	$err=0;
	echo '<script type="text/javascript"> alert("Please Write correct phone number!"); window.location.href = "index.php"; </script>';
	exit();
}
if($err==101){
	$err=0;
	echo '<script type="text/javascript"> alert("Wrong Email or Password!"); window.location.href = "index.php"; </script>';
	exit();
}
if($err==104){
	$err=0;
	echo '<script type="text/javascript"> alert("This email Belongs to an Employer!"); window.location.href = "index.php"; </script>';
	exit();
}
if($err==105){
	$err=0;
	echo '<script type="text/javascript"> alert("This email Belongs to a Student!"); window.location.href = "index.php"; </script>';
	exit();
}
if($err==202){
	$err=0;
	echo '<script type="text/javascript"> alert("You are not authorized to view this page!"); window.location.href = "index.php"; </script>';
	exit();
}
header('Location:index.php');
?>