<html>
<head>
<link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
 
</head>
 <table id="bootstrap-data-table" class="table table-striped table-bordered">
 	
						<thead>
						  <tr>
							<th>Sr.no</th>
							<th>Track ID</th>
							<th>Driver Name</th>
							<th>Vehicle Number</th>
							<th>Hospital Name</th>
							<th>Track</th>
							

						  </tr>
						</thead>
						<tbody>
						<?php 					
							include '../database.php'; 

							$sql = "select * from emergency WHERE status=1";
							
							$res = mysqli_query($con,$sql);
							 
							$result = array();
								$a=1;
									while($row = mysqli_fetch_array($res))
								{
									
									print "<tr><td>";
									echo $a++;
									print "</td> <td>";
									echo "#",$row['track_id'];
                                    
									print "</td> <td>";
									echo $row['driver_name']; 
									print "</td> <td>";
									echo $row['vehicle']; 
									print "</td> <td>";
									echo $row['hos_name'];
									print "</td> <td>";
										$temp = "./../ambulance/index.php?a_id=".$row['track_id'];
									print "<a href='$temp;'><i class='fa fa-ambulance'></i></a></td></tr>";
								
									
								}
						?>								  
						</tbody>
					  </table>
					</html>
	
	
    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>