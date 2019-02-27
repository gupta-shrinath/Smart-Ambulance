<!doctype html>
<?php
	include '../database.php';
    session_start();
	$tra_id = $_GET["tra_id"];
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
    <title>Smart Ambulance</title>
	<meta http-equiv="refresh" content="900;url=logout.php" />
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
                            <li class="active">Dashboard/ User Details /Traffic Officer / Update</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<div class="content mt-3">
		<!--********************************************** Content Start **********************************************-->
							<?php	
							
							$sql = "select * from traffic_details where tra_id=".$tra_id;
							
							$res = mysqli_query($con,$sql);
							 
							$result = array();	

									while($row = mysqli_fetch_array($res))
								{ 
									$tra_name = $row['tra_name']; 
									$tra_mob = $row['tra_mob'];
									$tra_mail_id = $row['tra_mail_id'];
								
								}
						?>
				  <div class="col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <strong>Update Profile</strong> 
                      </div>
                      <div class="card-body card-block">
                        <form action="update_traffic_details_code.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="row form-group">
                            <!--<div class="col col-md-3"><label class=" form-control-label">Static</label></div>  -->
                            <div class="col-12 col-md-9">
                              <!-- <p class="form-control-static">Username</p>	-->						  
                            </div>
                          </div>
						  <input type="hidden" name="tra_id" id="tra_id"  value="<?php echo $tra_id; ?>" />
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="text-input" class=" form-control-label">Name</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="tra_name" name="tra_name" value="<?php echo $tra_name; ?>" placeholder="Name" class="form-control"><small class="form-text text-muted"></small></div>
                          </div>
						    <div class="row form-group">
                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Contact Number</label></div>
                            <div class="col-12 col-md-9"><input type="text" id="tra_mob" name="tra_mob" placeholder="Enter Contact Number" value="<?php echo $tra_mob; ?>" class="form-control"><small class="help-block form-text"></small></div>
                          </div>
							
                          <div class="row form-group">
                            <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email Id</label></div>
                            <div class="col-12 col-md-9"><input type="email" id="tra_mail_id" name="tra_mail_id" placeholder="Enter Email" value="<?php echo $tra_mail_id; ?>" class="form-control"><small class="help-block form-text"></small></div>
                          </div>
						  
						    <div>
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