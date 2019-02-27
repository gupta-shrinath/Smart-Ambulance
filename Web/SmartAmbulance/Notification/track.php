<!DOCTYPE html>
<html>
<head>
<title>Mumbai Fire Brigade</title>
<style type="text/css">
* {margin: 0; padding: 0;}
#container {height: 100%; width:100%; font-size: 0;}
#left, #middle, #right {display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
#left {width: 40%; background: #ddd; height: 650px; overflow: auto;}
#right {width: 60%; background: #ddd; height: 650px; overflow: auto;}
.firstRight{height:30%; background: #ddd;}
.secondRight{height:70%; background: #ddd;}
</style>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg .tg-smzr{font-family:"Times New Roman", Times, serif !important;;vertical-align:top}
.tg .tg-zlxi{font-weight:bold;font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif !important;;vertical-align:top}
.tg .tg-yw4l{vertical-align:top}
.tg .tg-5xks{font-weight:bold;font-family:"Lucida Sans Unicode", "Lucida Grande", sans-serif !important;;text-align:center;vertical-align:top}
</style>
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/sticky.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>

<?php
	$latitude =  $_GET['lat'];
	$longitude = $_GET['longi'];
	$locate = $_GET['loc'];
	$userids = $_GET['uid'];
	
?>
<script type="text/javascript">
$(document).ready(function () {
	// Define the latitude and longitude positions
	var latitude = parseFloat("<?php echo $latitude; ?>"); // Latitude get from above variable
	var longitude = parseFloat("<?php echo $longitude; ?>"); // Longitude from same
	var latlngPos = new google.maps.LatLng(latitude, longitude);
	
	// Set up options for the Google map
	var myOptions = {
		zoom: 14,
		center: latlngPos,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		zoomControlOptions: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE
		}
	};
	
	// Define the map
	map = new google.maps.Map(document.getElementById("map"), myOptions);
	
	// Add the marker
	var marker = new google.maps.Marker({
		position: latlngPos,
		map: map,
		title: "<?php echo $locate; ?>"
	});
	
});
</script>

<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

<body id="top">
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
	
    <nav>
      <ul>
       <!--
   	    <li><a href="#">Home</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">A - Z Index</a></li>
        <li><a href="#">Student Login</a></li>-->
        <li><a href="index.php">Logout</a></li>
      </ul>
    </nav>
	
    <!-- ################################################################################################ --> 
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="clear" style="background-color:#B30000"> 
    <!-- ################################################################################################ -->
	<table style="background-color:#B30000; padding:0">
	<tr style="background-color:#B30000; padding:0">
	<td style="border: hidden; width: 12%"><a href="index.html"><img style="height:90px; width: 200px; padding:0" src="images/MF_Logo.jpg" alt=""></a></td>
	<td style="border: hidden; width: 48%">
	<h1><a href="index.html"><font size="6">Mumbai Fire Brigade</font></a>
      <p>We Serve to Save</p>
	  </td>
	  <!--
	<td style="border: hidden; width: 40%"><input type="text" placeholder="Username" size="10">&nbsp;&nbsp;<input type="password" placeholder="Password">
	&nbsp;&nbsp;<button type="submit">Login</button>
	</td>-->	
	</tr>
	</table>
  </header>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <div class="rounded">
    <nav id="mainav" class="clear"> 
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li class="active"><a href="home.php">Home</a></li>
        <li><a href="monitor.php">Monitor</a></li>
        <li><a class="drop">Announcement</a>	
           <ul>
            <li><a href="addannouncement.php">Add Announcement</a></li>
            <li><a href="updateannouncement.php">Update Announcement</a></li>           
          </ul>
        </li>
        <li><a class="drop">Alerts</a>
		<ul>
		 <li><a href="addalerts.php">Add Alerts</a></li>
		 <li><a href="updatealerts.php">Update Alerts</a></li>
		</ul>
		
		</li>
        <li><a  class="drop">Employee</a>
		<ul>
		<li><a href="addemployee.php">Add Employee</a></li>
		<li><a href="updateemployee.php"> Update Employee </a></li>
		<li><a href="viewemployeedetails.php"> View Employee Details</a></li>
		<li><a href="deleteemployeerecord.php"> Delete Employee Record </a></li>
		
		</ul>
		</li>
		
        <li><a class="drop">Fire Station</a>
		<ul>
		<li><a href="addfirestation.php">Add Fire Station</a></li>
		<li><a href="viewfirestationdetails.php">View Fire Station Details</a></li>
		<li><a href="updatefirestationdetails.php">Update Fire Station Details</a></li>
		<li><a href="deletefirestationdetails.php">Delete Fire Station Details</a></li>
		</ul>
		</li>
		
        <li><a class="drop">Emergency</a>
		<ul>
		<li><a href="viewrecorddaywise.php">View Record Day Wise</a></li>
		<li><a href="viewrecordbyemergency.php">View Record By Emergency</a></li>
		<li><a href="viewandprintrecord.php">View And Print Record</a></li>
		</ul>
		</li>
		
		<li><a class="drop">User</a>
		<ul>
		<li><a  href="adduser.php">Add User</a></li>
		<li><a  href="updateuser.php">Update User</a></li>
		<li><a  href="viewuserdetails.php">View User Details</a></li>
		<li><a  href="deleteuserdetails.php">Delete User Details</a></li>
		</ul>
		</li>
      </ul>
      <!-- ################################################################################################ --> 
    </nav>
  </div>
</div>
<!------------------------->
<div class="wrapper1 row3">
  <div id="slider">
    <div id="slide-wrapper" class="rounded clear">       
	  <div id="container">
    <div id="left">
	<!--	Left Side Menu-->
	<script src="ajax2.js"></script>
	<script type="text/javascript"><!--
	refreshdiv();
	// --></script>
	<div id="timediv"></div></br>

	</div>
    <div id="right">
	<!--	Right Side Menu-->
	<div class="firstRight">
	<!--<h3>User Details</h3>-->
	<?php
	define('HOST','mysql.hostinger.in');
	define('USER','u107985738_vp');
	define('PASS','prasad1911');
	define('DB','u107985738_fire');
	$con = mysqli_connect(HOST,USER,PASS,DB);
	$sql1 = "select * from user_info WHERE uid=$userids";
	$res1 = mysqli_query($con,$sql1); 
	while ($row = mysqli_fetch_assoc($res1)) 		
	{
        $usrname = $row['uname']; 
        $usrcon = $row['ucontact']; 
        $usraddr = $row['uaddress'];
		$usraddr2 = $row['uaddress2'];
        $usremail = $row['uemai'];
		$imagedata = $row['imagedata'];
    }
	
	?>
		<table class="tg" style="width: 100%">
	  <tr>
		<th class="tg-yw4l" colspan="4" rowspan="3" align="center" valign="middle"><?php printf('<img style="height:130px; width: 130px" src="data:image/png;base64,%s"/>',$imagedata); ?></th>
		<th class="tg-5xks" colspan="8">User Information</th>
	  </tr>
	  <tr>
		<td class="tg-zlxi" colspan="2"style="width: 10%">Name</td>
		<td class="tg-smzr" colspan="2"style="width: 30%"><?php echo $usrname; ?></td>
		<td class="tg-zlxi" colspan="2"style="width: 10%">Contact</td>
		<td class="tg-smzr" colspan="2"style="width: 30%"><?php echo $usrcon; ?></td>
	  </tr>
	  <tr>
		<td class="tg-zlxi" colspan="2"style="width: 10%">Home Address</td>
		<td class="tg-smzr" colspan="2"style="width: 30%"><?php echo $usraddr; ?></td>
		<td class="tg-zlxi" colspan="2"style="width: 10%">Office Address</td>
		<td class="tg-smzr" colspan="2"style="width: 30%"><?php echo $usraddr2; ?></td>
	  </tr>
	  <tr>
		<td class="tg-zlxi" colspan="4">Email</td>
		<td class="tg-smzr" colspan="8"><?php echo $usremail; ?></td>
	  </tr>
	</table>
	
	</div>
	<div class="secondRight">
	<table class="tg" style="width: 100%">
	  <tr>
		<th class="tg-5xks" style="width: 100%">Location</th>
	  </tr>
	</table>
	<div id="content" class="two_third">
	<div id="comments">
	<div id="map" style="width:700px;height:400px;  margin:20px auto 0;"></div>	
	</div>
	</div>	
	</div>
	</div>
</div>	  
	  
	  
    </div>
  </div>
</div>

<!-------------------------->


<div class="wrapper row5">
  <div id="copyright" class="clear"> 
    <!-- ################################################################################################ -->
	<p></p><br/>
    <p class="fl_left">Copyright &copy; 2017 - All Rights Reserved - <a href="#">Mumbai Fire Brigade</a></p>
    <p class="fl_right">Developed by <a target="_blank" href="http://www.vpt.edu.in/" title="Vidyalankar Polytechnic">Vidyalankar Polytechnic</a></p>
    <!-- ################################################################################################ --> 
  </div>
</div>
<!-- JAVASCRIPTS --> 
<script src="layout/scripts/jquery.min.js"></script> 
<script src="layout/scripts/jquery.fitvids.min.js"></script> 
<script src="layout/scripts/jquery.mobilemenu.js"></script> 
<script src="layout/scripts/tabslet/jquery.tabslet.min.js"></script>
</body>
</html>