 <table id="timediv" class="table table-striped table-bordered">
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

							$sql = "select * from emergency";
							
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
										$temp = "admin_home.php";
									print "<a href='$temp'><i class='fa fa-ambulance'></i></a></td></tr>";
								
									
								}
						?>								  
						</tbody>
					  </table>
					