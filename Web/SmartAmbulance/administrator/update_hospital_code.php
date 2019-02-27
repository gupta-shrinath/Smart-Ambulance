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
		$msg = "Empty field are not allowed";
		echo "<script> alert('$msg'); window.location.href='update_hospital.php'</script>";

	}	
	elseif(!preg_match($regname,$hos_name))
	{
		$msg = "Only letters and white space allowed in Name";
		echo "<script> alert('$msg'); window.location.href='update_hospital.php'</script>";

	}
	elseif(!preg_match($regmob,$hos_contact)){
		$msg = "Enter valid Mobile Number";
       echo "<script> alert('$msg'); window.location.href='update_hospital.php'</script>";
	}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$hos_mail_id)){
		$msg = "Enter valid Email Id.";
        echo "<script> alert('$msg'); window.location.href='update_hospital.php'</script>";
	}
	else{
$sql = "UPDATE hospital_details SET hos_name='$hos_name', hos_contact='$hos_contact', hos_mail_id='$hos_mail_id', hos_add='$hos_add',hos_pin='$hos_pin' WHERE hos_id=$hos_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Hospital Information updated Sucessfully";
        echo "<script> alert('$msg'); window.location.href='update_hospital.php'</script>";
	} else {
	$msg = "Error in updating Hospital Information";
        echo "<script> alert('$msg'); window.location.href='update_hospital.php'</script>";
	}
        }

?>