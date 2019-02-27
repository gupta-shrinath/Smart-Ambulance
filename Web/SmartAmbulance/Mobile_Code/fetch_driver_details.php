<?php
include '../database.php'; 
$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$sql2 = "SELECT pass FROM userdetailshosp WHERE mobile='$username'";
$row = mysqli_fetch_row(mysqli_query($con,$sql2));
 	if(password_verify($password, $row[0]))
	{
				
		$sql = "SELECT * FROM userdetailshosp WHERE mobile='$username' ";


			$res = mysqli_query($con,$sql);
			$result = array();
			while($row = mysqli_fetch_array($res)){
			array_push($result,
			array('a_id'=>$row[0],
			'name'=>$row[1],
			'hospital'=>$row[2],
			'vehicle'=>$row[3],
			'mobile'=>$row[4],
			'car'=>$row[5],
			'aadhar'=>$row[6]


			));
			}
			 
			echo json_encode(array("result"=>$result));
				
	}
	else
	{
		echo 'failure';
	}
 
mysqli_close($con);

			
?>