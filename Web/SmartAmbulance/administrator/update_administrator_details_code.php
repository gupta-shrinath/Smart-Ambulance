<?php 
include '../database.php'; 
// create a variable
$adm_id=(int)$_POST['adm_id'];
$adm_name=$_POST['adm_name'];
$adm_mob=$_POST['adm_mob'];
$adm_mail_id=$_POST['adm_mail_id'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";

//Execute the query
if(empty($adm_name) || empty($adm_mob) || empty($adm_mail_id))
	{
		$msg = "Empty field are not allowed";
    echo "<script> alert('$msg'); window.location.href='update_administrator_details.php'</script>";
	}	
	elseif(!preg_match($regname,$adm_name)){
		$msg = "Only letters and white space allowed";
    echo "<script> alert('$msg'); window.location.href='update_administrator_details.php'</script>";
	}
	elseif(!preg_match($regmob,$adm_mob)){
		$msg = "Enter valid Mobile Number";
    echo "<script> alert('$msg'); window.location.href='update_administrator_details.php'</script>";
	}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$adm_mail_id)){
		$msg = "Enter valid Email Id.";
    echo "<script> alert('$msg'); window.location.href='update_administrator_details.php'</script>";
	}
	else{
$sql = "UPDATE admin_details SET adm_name='$adm_name', adm_mob='$adm_mob', adm_mail_id='$adm_mail_id' WHERE adm_id=$adm_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Information updated Sucessfully";
    echo "<script> alert('$msg'); window.location.href='update_administrator_details.php'</script>";
	} else {
	$msg = "Error in updating Information";
    echo "<script> alert('$msg'); window.location.href='update_administrator_details.php'</script>";
	}
        }

?>