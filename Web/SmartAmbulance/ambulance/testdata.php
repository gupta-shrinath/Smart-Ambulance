<?php
include '../database.php';
session_start();
    $aid = $_SESSION['track_id'];
    $latitude = 0;
    $longitude = 0;
    
    //$res1 = mysqli_query($con,$sql1);


//$query = "SELECT id, longitude, latitude FROM data ORDER BY id DESC LIMIT 1";
$query = "select * from emergency WHERE track_id=$aid";
$qry_result = mysqli_query($con,$query) or die(mysqli_error());       
 if($row = mysqli_fetch_array($qry_result)) {  
   $longitude = $row['lang'];
   $latitude = $row['lat']; 
   // echo the object
   echo json_encode(array(
     'lat'=>$latitude,
     'lng'=>$longitude
   )); 
 }
 exit;     
?>