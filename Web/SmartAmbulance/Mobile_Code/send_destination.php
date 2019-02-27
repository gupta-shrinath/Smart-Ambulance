<?php
include '../database.php'; 
$latitude=mysqli_real_escape_string($con,$_POST['lat']);
$longitude=mysqli_real_escape_string($con,$_POST['lang']);
$drivername=mysqli_real_escape_string($con,$_POST['name']);
$query = "UPDATE emergency SET des_lat='$latitude' AND des_lang='$longitude' WHERE driver_name='$drivername';";
mysqli_query($con,$query);
if(mysqli_affected_rows($con) > 0)		
echo 'success';
else
echo 'failure';
}

?>