<?php
  define('HOST','localhost');
  define('USER','root');
  define('PASS','');
  define('DB','ambulance_data');
  $con = mysqli_connect(HOST,USER,PASS,DB);
  if(mysqli_connect_errno($con))
{
		echo 'Failed to connect';
}

?>