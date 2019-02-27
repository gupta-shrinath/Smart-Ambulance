<?php
include '../database.php'; 
$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);

$sql = "SELECT * FROM userdetailshosp WHERE mobile='$username'";
$sql2 = "SELECT pass FROM userdetailshosp WHERE mobile='$username'";
$row = mysqli_fetch_row(mysqli_query($con,$sql2));

$check = mysqli_fetch_array(mysqli_query($con,$sql));
if(isset($check))
{
if(password_verify($password, $row[0]))
	{
	echo 'success';
	}
	else
	{
	echo 'failure';
	}			
}
mysqli_close($con);
?>