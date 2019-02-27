<?php
session_start();
session_regenerate_id(true);
	
	if(isset($_SESSION['alogin']))
	{
		header("location:administrator/admin_home.php");
	}
	if(isset($_SESSION['hlogin']))
	{
		header("location:hospital/hospital_home.php");
	}
	if(isset($_SESSION['tlogin']))
	{
		header("location:traffic/traffic_home.php");
	}
?>
<!doctype html>


<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Smart Ambulance</title>
    <meta name="description" content="Smart Ambulance">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
	<link rel="apple-touch-icon" sizes="57x57" href="ico/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="ico/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="ico/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="ico/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="ico/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="ico/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="ico/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="ico/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="ico/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="ico/192192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="ico/3232.png">
  <link rel="icon" type="image/png" sizes="96x96" href="ico/9696.png">
  <link rel="icon" type="image/png" sizes="16x16" href="ico/1616.png">
  <link rel="manifest" href="ico/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="ico/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

</head>

<body  style="background-color:#004466">


    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    
                        <img class="align-content" src="images/logo.png" alt="">

                </div>
				
                <div class="login-form" style="background-color:#004466">
                    <form method="post" action="login.php">
                        <div class="form-group">
                            <label style="color:white;">User name</label>
                            <input type="email" style="background-color:#004466; color:white;" id="useremail"  name="useremail" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label style="color:white;">Password</label>
                            <input type="password"  style="background-color:#004466; color:white;" id="pass"  name="pass" class="form-control" placeholder="Password">
                        </div>
						<div class="form-group">
						    <label style="color:white;">Select User</label>                           
							<select id="usertype"   style="background-color:#004466; color:white;overflow:hidden" name="usertype" class="form-control-sm form-control">
                               
								<option value="Administrator">Administrator</option>
                               <option value="Hospital">Hospital</option>
							    <option value="Traffic">Traffic Officer</option>

                            </select>
                            <div class="col-12 col-md-9">
                              
                            </div>
                          </div>                      
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>         
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


</body>
</html>
<?php
    if (isset($_GET['status'])) {
        $sta = $_GET['status'];
        echo "<script type='text/javascript'>alert('$sta');</script>";
	}
?>