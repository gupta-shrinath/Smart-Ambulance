<?php
//including the php for accessing the database  
include '../database.php'; 
error_reporting(E_ERROR | E_PARSE);

//Taking values from add_driver.php and storing them in local variable
$name=$_POST['name'];
$hname=$_POST['hname'];
$vnum=$_POST['vnum'];
$mnum=$_POST['mnum'];
$car=$_POST['car'];
$anum=$_POST['anum'];
$opass=$_POST['opass'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";
$regaa="/^\d{12}$/";
//checking if the fields are empty or not
if(empty($name) || empty($hname) || empty($vnum) || empty($mnum)|| empty($car)|| empty($anum)|| empty($opass))
	{
		$msg = "Empty field are not allowed";
        		echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
}	
	
	//does the name field have invalid data
	elseif(!preg_match($regname,$name)){
		$msg= "Only letters and white space allowed in Name";
     		echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
}
	//does the mobile field have invalid data
	elseif(!preg_match($regmob,$mnum))
	{
		$msg = "Enter valid Mobile Number";
        	echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
}
	//does the aadhar field have invalid data
	elseif(!preg_match($regaa,$anum)){
		$msg = "Enter valid Aadhar Number";
     	echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
}
	else
	{
		
				//First let us check if the driver already exists ny check its name,mobile no ,vehicle
				$sql_m = "SELECT * FROM userdetailshosp WHERE mobile='$munum'";
				$sql_n = "SELECT * FROM userdetailshosp WHERE name='$name'";
				$sql_v = "SELECT * FROM userdetailshosp WHERE vehicle='$vnum'";
				$res_m = mysqli_query($con, $sql_m);
				$res_n = mysqli_query($con, $sql_n);
				$res_v = mysqli_query($con, $sql_v);

				if (mysqli_num_rows($res_m) > 0) 
				{
					
				  $msg = "Already Registered  "; 	
				  	echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
}
				else if(mysqli_num_rows($res_n) > 0)
				{
				  $msg = "Already Registered "; 	
				echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
				}
				else if(mysqli_num_rows($res_v) > 0)
				{
				  $status = "Already Registered "; 	
				   	echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";

				}	
				//if the driver doesnot exist we will add him/her to the database
				elseif(strlen($opass)<25&&strlen($opass)>8)  //Here is the code

				{
												//HASHING THE PASSWORD !!!//
												$hash_pass=password_hash($opass,PASSWORD_BCRYPT);




						mysqli_query($con,"INSERT INTO userdetailshosp(name,hospital,vehicle,mobile,car,aadhar,pass)
							VALUES ('$name','$hname','$vnum','$mnum','$car','$anum','$hash_pass')");
							
				
				
				if(mysqli_affected_rows($con) > 0){
				$msg = "Driver added Sucessfully";
			echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
		} else {
				$msg = "Error in adding Driver";
	echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
				}
				}
				else
				{
					$msg = "The Password should be min. 8 or max.25";
				echo "<script> alert('$msg'); window.location.href='add_driver.php'</script>";
	}
	}
	
?>	