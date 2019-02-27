<?php
include('../database.php');

$phone = mysqli_real_escape_string($con,$_POST['phone']);
$pass=mysqli_real_escape_string($con,$_POST['pass']);
$hash_pass=password_hash($pass,PASSWORD_BCRYPT);

$otp=mysqli_real_escape_string($con,$_POST['otp']);

$query = ("SELECT * FROM otp_table WHERE phone='$phone' AND otp='$otp';");
mysqli_query($con,$query);
$count=mysqli_affected_rows($con);
if($count>0)
{
		$query = "SELECT * FROM userdetailshosp WHERE phone = '$phone'";
			mysqli_query($con,$query);
			$countone= mysqli_affected_rows($con);
	if($countone>0)
	{
		
	$querytwo=("UPDATE userdetailshosp SET pass='$hash_pass' WHERE mobile='$phone';");
	mysqli_query($con,$querytwo);
	echo 'success';
	}
	else
	{
	$query1=("UPDATE doc_details SET doc_pass='$hash_pass' WHERE doc_mob='$phone';");
	mysqli_query($con,$query1);
	echo 'success';
	}
}
else
{
echo 'failure';
}

?>