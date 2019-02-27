<?php
	session_start();
	if($_SESSION['sid']==session_id())
	{
		
	}
	else
	{
		header("location:../index.php");
	}
        if (isset($_GET['status'])) {
        $sta = $_GET['status'];
        echo "<script type='text/javascript'>alert('$sta');</script>";
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Mumbai Fire Brigade</title>
<style type="text/css">
* {margin: 0; padding: 0;}
#container {height: 100%; width:100%; font-size: 0;}
#left, #middle, #right {display: inline-block; *display: inline; zoom: 1; vertical-align: top; font-size: 12px;}
#left {width: 40%; background: #ddd; height: 458px; overflow: auto;}
#right {width: 60%; background: #ddd; height: 458px; overflow: auto;}
.firstRight{height:50%; background: #ddd;}
.secondRight{height:50%; background: #ddd;}
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
	$latitude = 18.9725783;
	$longitude = 72.8309387;
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
		title: "Your Location"
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
        <li><a href="../index.php">Logout</a></li>
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
    <div id="right" style="background-color:#F9F9F9">
	<!--	Right Side Menu-->
	<div id="content" class="two_third">
	<div id="comments">
	<br/>
	<h1> ADD Alerts</h1>
	<br/>
		<form method="post" action="broadcastalert.php">
	<p><label for="message">Alert Title:</label></p>	
<input type="text" name="atitle" id="atitle" size="35" style="font-size: 20pt"><br>
<p><label for="message">Alert:</label></p>	
						<textarea cols="50" rows="5" name="amessage" id="amessage"></textarea>

<br><input name="submit" type="submit" value="Submit Alert">&nbsp;
    <input name="reset" type="reset" value="Reset Alert"><br> <br>
</form>

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