<table border="2" style= "background-color: #84ed86; color: #761a9b; margin: 0 auto;" >
      <thead>
        <tr>
          <th>Id</th>
          <th>Incident Type</th>
          <th>Incident Location</th>
          <th>User Details</th>
		  <th>Images Count</th>
		  <th>Incident Images</th>
        </tr>
      </thead>
      <tbody>
        <?php
	session_start();
define('HOST','mysql.hostinger.in');
define('USER','u107985738_vp');
define('PASS','prasad1911');
define('DB','u107985738_fire');
$con = mysqli_connect(HOST,USER,PASS,DB);

$sql = "select * from emergency_request ORDER BY emid DESC";
$sql2 = "select * from emergency_request";
$res2 = mysqli_query($con,$sql2);

if ($result=mysqli_query($con,$sql2))
  {
      $rowcount=mysqli_num_rows($result);
  }
  //echo "Session Value :".$_SESSION["emgcount"];
  //echo "Row Count :".$rowcount;
if($rowcount > $_SESSION["emgcount"])
{
	echo '<script type="text/javascript">play_sound();</script>';
	echo '<script language="javascript">';
	echo 'document.getElementById(myAudio).play()';
	echo 'alert("Emergency Please Check")';
	echo '</script>';
    //$_SESSION["emgcount"] = $rowcount;
}
 
$res = mysqli_query($con,$sql);
 
$result = array();

        while($row = mysqli_fetch_array($res))
    {
        print "<tr> <td>";
        echo $row['emid']; 
        print "</td> <td>";
        echo $row['emtype']; 
        print "</td> <td>";
        echo $row['emlocation']; 
        print "</td> <td>";
		$temp = "./track.php?lat=".$row['emlat']."&longi=".$row['emlog']."&uid=".$row['userid']."&loc=".$row['emlocation'];
		print "<a href='$temp;'>click</a></td> <td>";		
		$cno=$row['emid'];
		$sql2 = "select * from image_data WHERE em_no='$cno'";
		$res2 = mysqli_query($con,$sql2);
		if ($result=mysqli_query($con,$sql2))
		  {
		  $rowcount=mysqli_num_rows($result);
		  //echo htmlspecialchars($rowcount);
		  }
		echo $rowcount;		
		print "</td> <td>";
		$temp = "./track2.php?lat=".$row['emlat']."&longi=".$row['emlog']."&uid=".$row['userid']."&loc=".$row['emlocation']."&eid=".$row['emid'];
		print "<a href='$temp;'>click</a></td></tr>";
    }
        ?>
	      </tbody>
    </table>