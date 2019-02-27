<html>
  <head>
    <style>
      #map { width: 100%;height: 100%;}
    </style>
    <?php
	session_start();
    include '../database.php';
	$aid = $_GET["a_id"];	
	$_SESSION['track_id']=$aid;
	if($aid=="")
		header("location:../index.php");
	
	
    $latitude = 0;
    $longitude = 0;
    $sql1 = "select * from emergency WHERE status=1 AND track_id=$aid";
    $res1 = mysqli_query($con,$sql1); 
    while ($row = mysqli_fetch_assoc($res1)) 		
    {
        $latitude = $row['lat']; 
        $longitude = $row['lang']; 
    }
    
?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrZkebgdbC2ROmLy1ibj5Mgyp2cfMAn1g" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>        
    <script>
    var latitude = parseFloat("<?php echo $latitude; ?>"); // Latitude get from above variable
	var longitude = parseFloat("<?php echo $longitude; ?>"); // Longitude from same
	//var latlngPos = new google.maps.LatLng(latitude, longitude);
     // var latlng = {lat: 19.0655986, lng: 72.8769648};
      var latlng = {lat: latitude, lng: longitude};
      function initialize() {
        var mapCanvas = document.getElementById('map');
        var mapOptions = {
          center: latlng,
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var image = 'http://vpwork.16mb.com/ambulance/ambulance50.png';
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
          position: latlng,
          icon: image,
          title: "Ambulance is here",
          map: map   // replaces marker.setMap(map);
        });

        // now let's set a time interval, let's say every 3 seconds we check the position
        setInterval(
          function() {
            // we make an AJAX call
            $.ajax({
              dataType: 'JSON',   // this means the result (the echo) of the server will be readable as a javascript object
              url: 'testdata.php',
              success: function(data) {
                // this is the return of the AJAX call.  We can use data as a javascript object

                // now we change the position of the marker
                marker.setPosition({lat: Number(data.lat), lng: Number(data.lng)});

              }
            })
          }
          , 3000    // 3 seconds
        );
      } 
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="map"></div>
  </body>
</html>
