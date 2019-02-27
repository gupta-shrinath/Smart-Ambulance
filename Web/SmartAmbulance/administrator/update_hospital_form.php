<!doctype html>
<?php
	
    session_start();
	$hos_id = $_GET["hos_id"];	
	if($_SESSION['sid']==session_id())
	{
		
	}
	else
	{
		header("location:../index.php");
	}
	
?>
<html class="no-js" lang=""> 
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="refresh" content="900;url=logout.php" />
    <title>Smart Ambulance</title>
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

 <!-- Fav and touch icons -->
  <?php include 'logo.php';?>
</head>
<body>


        <!-- Left Panel -->

    <aside id="left-panel" class="left-panel" style="background-color:#004466">
        <nav class="navbar navbar-expand-sm navbar-default">
            <?php include 'left_menu.php';?>
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <?php include 'header_menu.php';?>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard/ User Details / Hospital / Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<div class="content mt-3">
		<!--********************************************** Content Start **********************************************-->
							<?php	
							include '../database.php'; 

							$sql = "select * from hospital_details where hos_id=".$hos_id;
							
							$res = mysqli_query($con,$sql);
							 
							$result = array();

									while($row = mysqli_fetch_array($res))
								{
									
									$hos_id=$row['hos_id'];
									$hos_name=$row['hos_name']; 
									
									$hos_mail_id=$row['hos_mail_id']; 
								
									
									$hos_add= $row['hos_add'];
									
									$hos_pin =$row['hos_pin'];
									
									$hos_contact=$row['hos_contact'];									
									
									
								}
						?>
				  <div class="col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <strong>Update Profile</strong> 
                      </div>
                      <div class="card-body card-block">
                        <form action="update_hospital_code.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="row form-group">
                            <!--<div class="col col-md-3"><label class=" form-control-label">Static</label></div>  -->
                            <div class="col-12 col-md-9">
                              <!-- <p class="form-control-static">Username</p>	-->						  
                            </div>
                          </div>
						  <input type="hidden" name="hos_id" id="hos_id"  value="<?php echo $hos_id; ?>" />
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="hosname" name="hos_name" value="<?php echo $hos_name; ?>" placeholder="Name" class="form-control"><small class="form-text text-muted"></small></div>
                          </div>
						   <div class="row form-group">
                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email Id</label></div>
                            <div class="col-12 col-md-9"><input type="email" id="hos_email" name="hos_mail_id" value="<?php echo $hos_mail_id; ?>"placeholder="Enter Email" class="form-control"><small class="help-block form-text"></small></div>
                          </div>
                         <div class="row form-group">
                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Address</label></div>
                            <div class="col-12 col-md-9"><textarea name="hos_add" id="hos_add" rows="9" placeholder="Enter Full Address" class="form-control"><?php echo $hos_add; ?></textarea></div>
                          </div>
						  <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Pin Code</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="hos_pin" name="hos_pin" value="<?php echo $hos_pin; ?>" placeholder="Name" class="form-control"><small class="form-text text-muted"></small></div>
                          </div>
                          
						    <div class="row form-group">
                            <div class="col col-md-3"><label for="text" class=" form-control-label">Contact Number</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="hos_contact" name="hos_contact" placeholder="Enter Mobile Number" value="<?php echo $hos_contact; ?>" class="form-control"><small class="help-block form-text"></small></div>
                          </div>
							
						                          <button type="submit" class="btn btn-primary btn-sm">
                          <i class="fa fa-dot-circle-o"></i> Update
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
						
                      </div>
                    </div> 
		<!--********************************************** Content End **********************************************-->
		</div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
	<script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>	

</body>
</html>
