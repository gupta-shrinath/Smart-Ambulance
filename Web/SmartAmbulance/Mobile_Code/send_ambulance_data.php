<?php
include '../database.php'; 
$aid = mysqli_real_escape_string($con,$_POST['id']);
$drivername = mysqli_real_escape_string($con,$_POST['name']);
$vehicle=mysqli_real_escape_string($con,$_POST['vehicle']);
$hospitalname=mysqli_real_escape_string($con,$_POST['hospitalname']);
$sql="SELECT hos_id FROM hospital_details WHERE hos_name='$hospitalname'";
$row = mysqli_fetch_row(mysqli_query($con,$sql));
$latitude=mysqli_real_escape_string($con,$_POST['latitude']);
$longitude=mysqli_real_escape_string($con,$_POST['longitude']);
$status=1;//to check if the ambulance has reached the destination so that we can display only the active ambulance running//
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d', time());
$query = "SELECT * FROM  emergency WHERE driver_name='$drivername' ;";
mysqli_query($con,$query);
$count = mysqli_affected_rows($con);
if($count > 0)
{
$query = "UPDATE emergency SET lat='$latitude' AND lang='$longitude' WHERE driver_name='$drivername';";
mysqli_query($con,$query);
if(mysqli_affected_rows($con) > 0)		
echo 'success';
else
echo 'failure';
}
else
{
$sql1= "INSERT INTO emergency (a_id,driver_name,vehicle,hos_id,hos_name,lat,lang,status)VALUES ('$aid','$drivername','$vehicle','$sql','$hospitalname','$latitude','$longitude','$status')";
mysqli_query($con,$sql1);
if(mysqli_affected_rows($con) > 0)
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
