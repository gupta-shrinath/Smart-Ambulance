<?php
include '../database.php'; 
$username = mysqli_real_escape_string($con,$_POST['username']);
$password = mysqli_real_escape_string($con,$_POST['password']);
$sql2= "SELECT doc_pass FROM doc_details WHERE doc_mob='$username'";
$row = mysqli_fetch_row(mysqli_query($con,$sql2));
 	if(password_verify($password, $row[0]))
	{
			
			
		$sql = "SELECT * FROM doc_details WHERE doc_mob='$username' ";
		$res = mysqli_query($con,$sql);

		$result = array();

		while($row = mysqli_fetch_array($res)){
		array_push($result,
		array('doc_id'=>$row[0],
		'doc_name'=>$row[1],
		'doc_mail_id'=>$row[2],
		'doc_mob'=>$row[3],
		'doc_hos'=>$row[4]


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