<?php 
include '../database.php'; 
// create a variable

$a_id=(int)$_POST['a_id'];

$d_name=$_POST['d_name'];
$d_mob=$_POST['d_mob'];
$d_veh=$_POST['d_veh'];
$d_car=$_POST['d_car'];
$d_aadhar=$_POST['d_aadhar'];
$d_hos=$_POST['d_hos'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";
$regaa="/^\d{12}$/";

//Execute the query
if(empty($d_name) || empty($d_mob) || empty($d_aadhar) || empty($d_veh)|| empty($d_car) || empty($d_hos))
	{
		$msg = "Empty field are not allowed";
    echo "<script> alert('$msg'); window.location.href='update_driver.php'</script>";
	}	
	elseif(!preg_match($regname,$d_name)){
		$msg = "Only letters and white space allowed in Name";
    echo "<script> alert('$msg'); window.location.href='update_driver.php'</script>";
	}
	
	elseif(!preg_match($regmob,$d_mob)){
		$msg = "Enter valid Mobile Number";
    echo "<script> alert('$msg'); window.location.href='update_driver.php'</script>";
	}
	elseif(!preg_match($regaa,$d_aadhar)){
		$msg = "Enter valid Aadhar Number";
    echo "<script> alert('$msg'); window.location.href='update_driver.php'</script>";
	}
	
	
	
	else{
			$sql = "UPDATE userdetailshosp SET name='$d_name', mobile='$d_mob', hospital='$d_hos',vehicle='$d_veh',car='$d_car',aadhar='$d_aadhar' WHERE a_id=$a_id";
			mysqli_query($con,$sql);

			if(mysqli_affected_rows($con) > 0){
				$msg = "Driver Information updated Sucessfully";
				
    echo "<script> alert('$msg'); window.location.href='update_driver.php'</script>";
				} else {
				$msg = "Error in updating Driver Information";
    echo "<script> alert('$msg'); window.location.href='update_driver.php'</script>";
				}
        }

?>