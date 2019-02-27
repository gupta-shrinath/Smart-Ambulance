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
	<link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
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
                            <li class="active">Dashboard / User Details / Driver / View</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
		<div class="content mt-3">
		<!--********************************************** Content Start **********************************************-->
			<div class="animated fadeIn">
                <div class="row">

					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<strong class="card-title">Driver Data Table</strong>
							</div>
							<div class="card-body">
					  <table id="bootstrap-data-table" class="table table-striped table-bordered">
						<thead>
						  <tr>
							<th>Sr.no</th>
							<th>Name</th>
							<th>Hospital</th>
							<th>Vehicle</th>
							<th>Mobile Number</th>
							<th>Vehicle Model</th>							
							<th>Aadhar Number.</th>
						
							
						  </tr>
						</thead>
						<tbody>
						<?php 					
							include '../database.php'; 

							$sql = "select * from userdetailshosp";
							$a=1;
							$res = mysqli_query($con,$sql);
							 
							$result = array();

									while($row = mysqli_fetch_array($res))
								{
									print "<tr><td>";
									echo $a++;
									print "</td> <td>";
									echo $row['name']; 
									print "</td> <td>";
									echo $row['hospital']; 
									print "</td> <td>";
									echo $row['vehicle'];
									print "</td> <td>";
									echo $row['mobile'];
									print "</td> <td>";
									echo $row['car'];
									print "</td> <td>";
									echo $row['aadhar'];									
									
									
								}
						?>								  
						</tbody>
					  </table>
							</div>
						</div>
					</div>

                </div>
            </div><!-- .animated -->
		<!--********************************************** Content End **********************************************-->
		</div>
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

	 <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/lib/data-table/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>

</body>
</html>
