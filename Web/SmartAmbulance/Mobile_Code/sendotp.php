
<?php
include('../database.php');
$phone = mysqli_real_escape_string($con,$_POST['phone']);
$que1=("SELECT * FROM doc_details WHERE doc_mob = '$phone';");
$que2=("SELECT * FROM userdetailshosp WHERE mobile = '$phone';");
$a=mysqli_query($con,$que1);
$count = mysqli_affected_rows($con);
$b=mysqli_query($con,$que2);
$count2 = mysqli_affected_rows($con);
if($count or $count2>0)
{
			$query = "SELECT * FROM otp_table WHERE phone = '$phone';";
			mysqli_query($con,$query);
			$count = mysqli_affected_rows($con);
			$otp = rand(1000,9999);
			if($count > 0)
			$query = "UPDATE otp_table SET otp='$otp' WHERE phone='$phone';";
			else
			$query = "INSERT INTO otp_table(otp,phone) VALUES('$otp','$phone')";
			mysqli_query($con,$query);
			$msg = "Your OTP is ".$otp;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "http://api-mapper.clicksend.com/http/v2/send.php");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, FALSE);

			curl_setopt($ch, CURLOPT_POST, TRUE);



curl_setopt($ch, CURLOPT_POSTFIELDS, "method=http&username=gupta_shrinath&key=0AE2F792-67AF-D438-B7F1-E93C373CEB5D&to=+91".$phone."&message=".$msg."&senderid=vpverve");

			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded"));
			$response = curl_exec($ch);
			curl_close($ch);
			echo 'success';
			
}
else
{
	echo 'failure';

}
mysqli_close($con);
?>