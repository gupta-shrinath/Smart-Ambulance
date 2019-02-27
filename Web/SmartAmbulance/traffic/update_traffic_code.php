<?php include '../database.php'; 
// create a variable
$tra_id=(int)$_POST['tra_id'];
$tra_name=$_POST['tra_name'];
$tra_mob=$_POST['tra_mob'];
$tra_mail_id=$_POST['tra_mail_id'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";

//Execute the query
if(empty($tra_name) || empty($tra_mob) || empty($tra_mail_id))
	{
		$msg = "Empty field are not allowed";
     echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
	}	
	elseif(!preg_match($regname,$tra_name)){
		$msg = "Only letters and white space allowed";
       echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
	}
	elseif(!preg_match($regmob,$tra_mob)){
		$msg = "Enter valid Mobile Number";
     echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
	}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$tra_mail_id)){
		$msg = "Enter valid Email Id.";
       echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
	}
	else{
$sql = "UPDATE traffic_details SET tra_name='$tra_name', tra_mob='$tra_mob', tra_mail_id='$tra_mail_id' WHERE tra_id=$tra_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Profile updated Sucessfully";
    echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
		} else {
	$msg = "Error in updating Profile";
    echo "<script> alert('$msg'); window.location.href='add_doctor.php'</script>";
	}
        }

?>