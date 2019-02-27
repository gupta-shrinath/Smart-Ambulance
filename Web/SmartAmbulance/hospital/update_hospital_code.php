<?php include '../database.php'; 
// create a variable
$hos_id=(int)$_POST['hos_id'];
$hos_name=$_POST['hos_name'];
$hos_contact=$_POST['hos_contact'];
$hos_mail_id=$_POST['hos_mail_id'];
$hos_pin=$_POST['hos_pin'];
$hos_add=$_POST['hos_add'];
$regname="/^[a-zA-Z]*$/";
$regmob="/^\d{10}$/";

//Execute the query
if(empty($hos_name) || empty($hos_contact) || empty($hos_mail_id)|| empty($hos_pin) || empty($hos_add))
	{
		$status = "Empty field are not allowed";
        header("location: update_hospital_profile.php?status=".$status);
	}	
	elseif(!preg_match($regname,$hos_name)){
	$status = "Only letters and white space allowed in Name";
        header("location: update_hospital_profile.php?status=".$status);
	}
	elseif(!preg_match($regmob,$hos_contact)){
		$status = "Enter valid Mobile Number";
        header("location: update_hospital_profile.php?status=".$status);
	}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$hos_mail_id)){
		$status = "Enter valid Email Id.";
        header("location: update_hospital_profile.php?status=".$status);
	}
	else{
$sql = "UPDATE hospital_details SET hos_name='$hos_name', hos_contact='$hos_contact', hos_mail_id='$hos_mail_id', hos_add='$hos_add',hos_pin='$hos_pin' WHERE hos_id=$hos_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$status = "Information updated Sucessfully";
    header("location: update_hospital_profile.php?status=".$status);
	} else {
	$status = "Error in updating Information";
    header("location: update_hospital_profile.php?status=".$status);
	}
        }

?>