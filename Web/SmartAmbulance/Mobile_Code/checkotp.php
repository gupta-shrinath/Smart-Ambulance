<?php
include '../database.php';
$phone = mysqli_real_escape_string($con,$_POST['phone']);
$otp=mysqli_real_escape_string($con,$_POST['otp']);
$query = ("SELECT * FROM otp_table WHERE phone='$phone' AND otp='$otp'");
$check=mysqli_query($con,$query);
$count=mysqli_affected_rows($con);
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