<?php
    session_start();

  if($_SESSION['alogin'])
	{	
	}
		else	
	{
		header("location:../index.php");
	}
?>
<!doctype html>
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
  <!-- Fav and touch icons ends-->
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
                            <li class="active">Dashboard / Profile / Change Password </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<div class="content mt-3">
		<!--********************************************** Content Start **********************************************-->
			<div class="col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <strong>Change Password</strong> 
                      </div>
                      <div class="card-body card-block">
                        <form action="update_password_code.php" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="row form-group">
                            <!--<div class="col col-md-3"><label class=" form-control-label">Static</label></div>  -->
                            <div class="col-12 col-md-9">
                              <!-- <p class="form-control-static">Username</p>	-->						  
                            </div>
                          </div>
						 
                          </div> 
                          <div class="row form-group">
                            <div align =center class="col col-md-4"><label for="text-input" class=" form-control-label">Old Password</label></div>
                            <div class="col-12 col-md-7" ><input type="password" id="bname" name="oldpass" placeholder="Enter Old Password" class="form-control"><small class="form-text text-muted"></small></div>
                          </div>
                          
                          
						  <div class="row form-group">
                            <div align =center class="col col-md-4"><label for="email-input" class=" form-control-label">New Password</label></div>
					
                            <div class="col-12 col-md-7"><input type="password" id="bcemail" name="newpass" placeholder="Enter New Password" class="form-control"><small class="help-block form-text"></small></div>
                          </div>
						  
						  <div class="row form-group">
                            <div align =center class="col col-md-4"><label for="email-input" class=" form-control-label">Retype New Password</label></div>
					
                            <div class="col-12 col-md-7"><input type="password" id="email-input" name="newpassr" placeholder="Retype New Password" class="form-control"><small class="help-block form-text"></small></div>
                          
						                          
                      </div>
					  
						 <div class="row form-group">
						   <div align =center class="col col-md-1"><input type="checkbox"  onclick="togglepassword()"></div>
						  <label for="text-input" class=" form-control-label">Show Password</label>
					 
					   </div>
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
						
                          <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                          <i class="fa fa-ban"></i> Reset
                        </button>
						
                      </div>
                    </div> 
				</form>	
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
        ( 
	function ( $ ) {
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
	<script>
			function togglepassword() {
			  var x = document.getElementById("bname");
			  if (x.type === "password") {
				x.type = "text";
			  } else {
				x.type = "password";
			  }
			   var y = document.getElementById("bcemail");
			  if (y.type === "password") {
				y.type = "text";
			  } else {
				y.type = "password";
			  }
			  var z = document.getElementById("email-input");
			  if (z.type === "password") {
				z.type = "text";
			  } else {
				z.type = "password";
			  }
			} 
	</script>

</body>
</html>
