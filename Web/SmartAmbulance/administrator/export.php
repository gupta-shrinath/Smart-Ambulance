
<?php  
//export.php  
require '../database.php';
$output = '';

 $query = "SELECT * FROM emergency";
 $result = mysqli_query($con, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table class="table" bordered="1">  
                    <tr>  
                         <th>Track ID</th> 
						<th>Hospital Name<th>	
                         <th>Driver Name</th>  
                         <th>Vehicle Number</th>  
      
                    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
                         <td>'.$row["track_id"].'</td>  
                         <td>'.$row["hos_name"].'</td>  
                         <td>'.$row["driver_name"].'</td> 
                         <td>'.$row["vehicle"].'</td> 
          </tr>
   ';
  }
  $output .= '</table>';
 header("Content-type: application/vnd.ms-excel");  
header("Content-Disposition: attachment; filename=User_Detail.xls");  
header("Pragma: no-cache");  
header("Expires: 0");  

  echo $output;
 }
 
?>