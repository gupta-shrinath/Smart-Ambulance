<?php include '../database.php';
$aid=(int) $_POST['aid'];
$myLatitude=$_POST['myLatitude'];
$myLongitude=$_POST['myLongitude'];


$sql = "UPDATE ambulance_data SET Latitude='$myLatitude', Longitude='$myLongitude' WHERE A_ID=$aid";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
echo 'success';	
} else {
echo 'failure';	
}

?>