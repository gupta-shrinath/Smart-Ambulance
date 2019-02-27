<?php
include '../database.php'; 
$username = mysqli_real_escape_string($con,$_POST['name']);
$status=0;
$sql1= "UPDATE emergency SET status='$status' WHERE driver_name='$username'";
mysqli_query($con,$sql1);
if(mysqli_affected_rows($con) > 0)
{
	echo 'success';
}
else
{
	echo 'failure';
}
mysqli_close($con);



?>