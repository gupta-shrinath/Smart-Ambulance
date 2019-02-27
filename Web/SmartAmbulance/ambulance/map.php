<!DOCTYPE html>
<html lang="en">

<head>
  <title>Mumbai Ambulance</title>
</head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?key=AIzaSyDrZkebgdbC2ROmLy1ibj5Mgyp2cfMAn1g&sensor=false" type="text/javascript"></script>

<?php
    include '../database.php';
    $aid = 1;
    $latitude = 0;
    $longitude = 0;
    $sql1 = "select * from ambulance_data WHERE A_ID=$aid";
    $res1 = mysqli_query($con,$sql1); 
    while ($row = mysqli_fetch_assoc($res1)) 		
    {
        $latitude = $row['Latitude']; 
        $longitude = $row['Longitude']; 
    }
    
?>
<script>

  setTimeout(function(){
      window.location.href = window.location.href;
  },5000)

$(document).ready(function () {
	// Define the latitude and longitude positions
	var latitude = parseFloat("<?php echo $latitude; ?>"); // Latitude get from above variable
	var longitude = parseFloat("<?php echo $longitude; ?>"); // Longitude from same
	var latlngPos = new google.maps.LatLng(latitude, longitude);
	
	// Set up options for the Google map
	var myOptions = {
		zoom: 16,
		center: latlngPos,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControlOptions: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE
		}
	};
	  var image = 'http://vpwork.16mb.com/ambulance/ambulance50.png';
	// Define the map
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	
	// Add the marker
	var marker = new google.maps.Marker({
		position: latlngPos,
		map: map,
	    icon: image,
		title: "<?php echo $locate; ?>"
	
	},5000);
	
	// Zoom to 50  when clicking on marker
google.maps.event.addListener(marker,'click',function() {
  map.setZoom(50);
  map.setCenter(marker.getPosition());
  });

var infowindow = new google.maps.InfoWindow({
  content:"Ambulance Location"
  });

google.maps.event.addListener(marker, 'click', function() {
  infowindow.open(map,marker);
  });	

});
</script>

<body>
    <h1>Mumbai Ambulance </h1>
   			<div id="map" style="height:600px; margin:20px auto 0;"></div>
</body>

</html>
