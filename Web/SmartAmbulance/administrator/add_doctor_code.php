<?php 
include '../database.php'; 
	
// create a variable
error_reporting(E_ERROR | E_PARSE);
$doc_name=$_POST['doc_name'];
$doc_mob=$_POST['doc_mob'];
$doc_mail_id=$_POST['doc_mail_id'];
$doc_pass=$_POST['doc_pass'];
$doc_hos=$_POST['doc_hos'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";

//Execute the query
if(empty($doc_name) || empty($doc_mob) || empty($doc_mail_id) || empty(doc_pass)|| empty(doc_hos))
	{
		$msg = "Empty field are not allowed";
		echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
							
	}	
	elseif(!preg_match($regname,$doc_name)){
		$msg = "Only letters and white space allowed in Name";
       echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
	}
	elseif(!preg_match($regmob,$doc_mob)){
		$msg = "Enter valid Mobile Number";
     echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
							}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$doc_mail_id)){
		$msg = "Enter valid Email Id.";
        echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
							
		}
	else
	{
		
				//First let us check if the driver already exists ny check its name,mobile no ,vehicle
				$sql_m = "SELECT * FROM doc_details WHERE doc_mob='$doc_mob'";
					
				$sql_e = "SELECT * FROM doc_details WHERE doc_mail_id='$doc_mail_id'";
				$res_m = mysqli_query($con, $sql_m);
				
				$res_e = mysqli_query($con, $sql_e);

				if (mysqli_num_rows($res_m) > 0) 
				{
					
				  $msg = "Already Registered  "; 	
							echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
				}
				else if(mysqli_num_rows($res_e) > 0)
				{
				  $msg = "Already Registered "; 	
					echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
							
				}
					
				//if the driver doesnot exist we will add him/her to the database
				elseif(strlen($doc_pass)<25&&strlen($doc_pass)>8)  //Here is the code
				

				{
					
					//HASHING THE PASSWORD !!!//
					$hash_pass=password_hash($doc_pass,PASSWORD_BCRYPT);





						mysqli_query($con,"INSERT INTO doc_details(doc_name,doc_mob,doc_mail_id,doc_pass,doc_hos)
										VALUES ('$doc_name','$doc_mob','$doc_mail_id','$hash_pass','$doc_hos')");
										
							if(mysqli_affected_rows($con) > 0){
							$msg = "New Doctor added Sucessfully";
							echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
								} else {
							$msg = "Error in adding New Doctor";
							echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
							
								}
				}
				else
				{	
					$msg = "The Password should be min. 8 or max.25";
			
							echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";	
				}	
	}
?>