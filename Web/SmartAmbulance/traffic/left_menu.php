<?php

  if($_SESSION['tlogin'])
	{
		if (isset($_GET['status'])) {
        $sta = $_GET['status'];
        echo "<script type='text/javascript'>alert('$sta');</script>";
		}
	}
		else	
	{
		header("location:../index.php");
	}
?>
<div class="navbar-header" style="background-color:#004466;"  >
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
		<i class="fa fa-bars"></i>
	</button>
	<img src="images/logo2.png">
		
</div>

<div id="main-menu" class="main-menu collapse navbar-collapse" style="background-color:#004466;">
	<ul class="nav navbar-nav">
		<li class="active">

	<img src="images/logo.png" >
		</li>
		
				<div id="main-menu" class="main-menu collapse navbar-collapse">
	<ul class="nav navbar-nav">
		<li class="active">

			
		<h3 class="menu-title" style="color:white; "><a href="emergency.php" style="color:white; font-weight:bold; font-family:Times New Roman;" > <i class="fa fa-heartbeat"></i>  EMERGENCY</a></h3>
			
		</li>
			
		
        <h3 class="menu-title">Profile</h3><!-- /.menu-title -->
		<li class="menu-item-has-children dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-drivers-license-o" style="color:white;font-size: 20px"></i>View Details</a>
			<ul class="sub-menu children dropdown-menu">
				
			<li><i class="fa fa-edit"></i><a href="update_traffic_profile.php">View/Edit Profile</a></li>
				
				<li><i class="fa fa-id-badge"></i><a href="change_password.php">Change Password</a></li>
			</ul>
		</li>


		
		<h3 class="menu-title">User Details</h3><!-- /.menu-title -->
<li class="menu-item-has-children dropdown" >


			<li class="menu-item-has-children dropdown" style="background-color:#004466">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user" style="color:white;font-size: 20px"></i>Driver</a>
			<ul class="sub-menu children dropdown-menu">
				
				<li><i class="fa fa-eye" ></i><a href="view_driver_details_form.php">View</a></li>
			
				</ul> 
				</li>
				<li class="menu-item-has-children dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-hospital-o" style="font-size: 20px;color:white;"></i>Hospital</a>
			<ul class="sub-menu children dropdown-menu">
				<li><i class="fa fa-eye"></i><a href="view_hospital_details.php">View</a></li>
		</ul>
			</li>
				 <li class="menu-item-has-children dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-md" style="font-size: 25px;color:white;"></i>Doctor</a>
			<ul class="sub-menu children dropdown-menu">
				
				<li><i class="fa fa-eye"></i><a href="view_doctor_details.php">View</a></li>
		</ul>
	
			</li>
		
</div><!-- /.navbar-collapse -->