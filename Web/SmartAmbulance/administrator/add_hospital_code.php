<?php include '../database.php'; 
	
// create a variable

$oname=$_POST['oname'];
$oemail	=$_POST['oemail'];
$opass=$_POST['opass'];
$oaddress=$_POST['oaddress'];
$opin=$_POST['opin'];
$onumber=$_POST['onumber'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";


if(empty($oname) || empty($oemail) || empty($opass) || empty($oaddress)|| empty($opin)|| empty($onumber))
	{
		$msg = "Empty field are not allowed";
		echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

	}	



		elseif(!preg_match($regname,$oname)){
		$msg = "Only letters and white space allowed in Name";
						echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

	}
	
	elseif(!preg_match($regmob,$onumber)){
		$msg = "Enter valid Contact Number";
						echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";
	}
	else
	{
		
				//First let us check if the driver already exists ny check its name,mobile no ,vehicle
				$sql_m = "SELECT * FROM hospital_details WHERE hos_name='$oname'";
				$sql_n = "SELECT * FROM hospital_details WHERE hos_mail_id='$oemail'";
				$sql_v = "SELECT * FROM hospital_details WHERE hos_add='$oaddress'";
				$res_m = mysqli_query($con, $sql_m);
				$res_n = mysqli_query($con, $sql_n);
				$res_v = mysqli_query($con, $sql_v);

				if (mysqli_num_rows($res_m) > 0) 
				{
					
				  $msg = "Already Registered  "; 	
				  				echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

				}
				else if(mysqli_num_rows($res_n) > 0)
				{

				 $msg = "Already Registered "; 	
															echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

				}
				else if(mysqli_num_rows($res_v) > 0)
				{
				  $msg = "Already Registered "; 	
				   				echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

				
				}
	
	
	
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$oemail)){
		$msg = "Enter valid Email Id.";
						echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

	}
					//if the driver doesnot exist we will add him/her to the database
				elseif(strlen($opass)<25&&strlen($opass)>8)  //Here is the code

				{
					$hash_pass=password_hash($opass,PASSWORD_BCRYPT);


				mysqli_query($con,"INSERT INTO hospital_details (hos_name,hos_mail_id,hos_pass,hos_add,hos_pin,hos_contact)
								VALUES ('$oname','$oemail','$hash_pass','$oaddress','$opin','$onumber')");
								
					if(mysqli_affected_rows($con) > 0){
					$msg = "Hospital added Sucessfully";
									echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

					} else {
					$msg = "Error in adding Hospital";
									echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

					}
				}	
				else
				{
					$msg = "The Password should be min. 8 or max.25";
									echo "<script> alert('$msg'); window.location.href='add_hospital.php'</script>";

				}
	}
?>