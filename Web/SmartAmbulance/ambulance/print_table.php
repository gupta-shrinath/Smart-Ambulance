<style>
tr{
    font-weight:bold;
    color:#000;
}
</style>
<table class="table" style= "margin: 0 auto;" >
      <thead style= "background-color: #000075; color: #ffffff; text-align:center">
        <tr>
          <th style= "text-align:center; color: #ffffff">Id</th>
          <th style= "text-align:center; color: #ffffff">Incident Type</th>
          <th style= "text-align:center; vertical-align: middle; color: #ffffff">Incident Location</th>
          <th style= "text-align:center; color: #ffffff">User Details</th>
		  <th style= "text-align:center; color: #ffffff">Images Count</th>
		  <th style= "text-align:center; color: #ffffff">Incident Images</th>
        </tr>
      </thead>
      <tbody>
<?php 
session_start();
include '../database.php'; 

$sql = "select * from emergency_request ORDER BY emid DESC";



 
$res = mysqli_query($con,$sql);
$all_locations = array();
$new_locations = array();
$row = mysqli_fetch_assoc($res);
array_push($new_locations,json_encode(array('lat'=>$row['emlat'],'lng'=>$row['emlog'],'type'=>$row['emtype'])));
$res = mysqli_query($con,$sql);
while($r = mysqli_fetch_assoc($res)){
	$new_location = true;
	for($i=0;$i<count($new_locations);$i++){
		$location = 0;
		$current = (array) json_decode($new_locations[$i]);
		if(getDistance($current['lat'],$current['lng'],$r['emlat'],$r['emlog']) < 100 && $current['type']==$r['emtype']){
			$temp = array('location'=>$i);
			$temp = array_merge($temp,$r);
			array_push($all_locations,json_encode($temp));
			$new_location = false;
			break;
		}
	}
	if($new_location){
		$temp = array('location'=>count($new_locations));
		$temp = array_merge($temp,$r);
		array_push($all_locations, json_encode($temp));
		array_push($new_locations,json_encode(array('lat'=>$r['emlat'],'lng'=>$r['emlog'],'type'=>$r['emtype'])));
	}	
}

$rowcount = count($new_locations);

echo '<script type="text/javascript" id="beep">new_requests='.$rowcount.';playSound();</script>';

$result = array();

		foreach($all_locations as $j){
		$a = (array) json_decode($j);
		//echo "<tr  bgcolor='".getColor($a['location'])."'>";
		echo "<tr style='background-color: rgba(".getColor($a['location']).",0.5)'>";
	    print "<td style= 'text-align:center; vertical-align: middle'>";
        echo $a['emid']; 
        print "</td> <td style= 'text-align:center; vertical-align: middle'>";
        echo $a['emtype']; 
        print "</td> <td>";
        echo $a['emlocation']; 
        print "</td> <td style= 'text-align:center; vertical-align: middle'>";
		$temp = "./track.php?lat=".$a['emlat']."&longi=".$a['emlog']."&uid=".$a['userid']."&loc=".$a['emlocation'];
		print "<a href='$temp'>click</a></td> <td style= 'text-align:center; vertical-align: middle'>";		
		$cno=$a['emid'];
		$sql2 = "select * from image_data WHERE em_no='$cno'";
		$res2 = mysqli_query($con,$sql2);
		if ($result=mysqli_query($con,$sql2))
		  {
		  $rowcount=mysqli_num_rows($result);
		  //echo htmlspecialchars($rowcount);
		  }
		echo $rowcount;		
		print "</td> <td style= 'text-align:center; vertical-align: middle'>";
		$temp = "./track2.php?lat=".$a['emlat']."&longi=".$a['emlog']."&uid=".$a['userid']."&loc=".$a['emlocation']."&eid=".$a['emid'];
		print "<a href='$temp'>click</a></td></tr>";
    }
    ?>
	      </tbody>
    </table>

<?php
function getDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo){
  $theta = $longitudeFrom - $longitudeTo;
    $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    return ($miles * 1609.344);	  
  }
  
function getColor($num) {
	$hash = md5('color' . $num); // modify 'color' to get a different palette
       $r = hexdec(substr($hash, 0, 2)); // r
       $g = hexdec(substr($hash, 2, 2)); // g
       $b = hexdec(substr($hash, 4, 2)); //b
	return "$r,$g,$b";
}
?>