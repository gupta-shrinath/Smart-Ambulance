<?php
include '../database.php'; 
$name = mysqli_real_escape_string($con,$_POST['name']);
$age= mysqli_real_escape_string($con,$_POST['age']);
$condition= mysqli_real_escape_string($con,$_POST['condition']);		
$sql = "INSERT INTO patient_details (p_name,p_age,p_con) VALUES ('$name','$age','$condition')";
$check=mysqli_query($con,$sql);
if(isset($check))
{
	echo 'success';
}
else
{
	echo 'failure';
}
mysqli_close($con);
?>