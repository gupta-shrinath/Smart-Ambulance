<?php 
include '../database.php'; 

// create a variable
error_reporting(E_ERROR | E_PARSE);
$adm_name=$_POST['adm_name'];
$adm_mob=$_POST['adm_mob'];
$adm_mail_id=$_POST['adm_mail_id'];
$adm_pass=$_POST['adm_pass'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";

	if(empty($adm_name) || empty(adm_mob) || empty($adm_mail_id) || empty($adm_pass))
	{
		$msg = "Empty field are not allowed";
		echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
		}	
	
	
	elseif(!preg_match($regname,$adm_name)){
		$msg = "Only letters and white space allowed in Name";
    	echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
	}
	
	elseif(!preg_match($regmob,$adm_mob)){
		$msg= "Enter valid Mobile Number";
    	echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
		}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$adm_mail_id)){
		$msg = "Enter valid Email Id.";
        	echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
		}
	
	else
	{
		
				//First let us check if the driver already exists ny check its name,mobile no ,vehicle
				$sql_m = "SELECT * FROM  admin_details WHERE adm_mob='$adm_mob'";
				$sql_n = "SELECT * FROM admin_details WHERE adm_name='$adm_name'";
				$sql_e = "SELECT * FROM admin_details WHERE adm_mail_id='$adm_mail_id'";
				$res_m = mysqli_query($con, $sql_m);
				$res_n = mysqli_query($con, $sql_n);
				$res_e = mysqli_query($con, $sql_e);

				if (mysqli_num_rows($res_m) > 0) 
				{
					
				  $msg = "Already Registered  "; 	
					echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
				}
				
				else if(mysqli_num_rows($res_e) > 0)
				{
				  $msg = "Already Registered "; 	
				echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
		
				}		
				//if the driver doesnot exist we will add him/her to the database
				elseif(strlen($adm_pass)<25&&strlen($adm_pass)>8)  //Here is the code

				{
					//HASHING THE PASSWORD !!!//
					$hash_pass=password_hash($adm_pass,PASSWORD_BCRYPT);

					mysqli_query($con,"INSERT INTO admin_details (adm_name,adm_mob,adm_mail_id,adm_pass)
									VALUES ('$adm_name','$adm_mob','$adm_mail_id','$hash_pass')");
									
						if(mysqli_affected_rows($con) > 0){
						$msg = "New Admin added Sucessfully";
						echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
						} 
						else {
						$msg= "Error in adding New Admin";
						echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
	
						}
				}
				else
				{
					$msg = "The Password should be min. 8 or max.25";
					echo "<script> alert('$msg'); window.location.href='add_administrator.php'</script>";
	
				}
}
?>