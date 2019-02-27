<?php 
include '../database.php'; 
// create a variable
$doc_id=(int)$_POST['doc_id'];
$doc_name=$_POST['doc_name'];
$doc_mob=$_POST['doc_mob'];
$doc_mail_id=$_POST['doc_mail_id'];
$regname="/^[a-zA-Z ]*$/";
$regmob="/^\d{10}$/";

//Execute the query
if(empty($doc_name) || empty($doc_mob) || empty($doc_mail_id))
	{
		$msg = "Empty field are not allowed";
    echo "<script> alert('$msg'); window.location.href='update_doctor.php'</script>";
	}	
	elseif(!preg_match($regname,$doc_name)){
		$msg = "Only letters and white space allowed";
    echo "<script> alert('$msg'); window.location.href='update_doctor.php'</script>";
	}
	elseif(!preg_match($regmob,$doc_mob)){
		$msg = "Enter valid Mobile Number";
    echo "<script> alert('$msg'); window.location.href='update_doctor.php'</script>";
	}
	elseif(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$doc_mail_id)){
		$msg = "Enter valid Email Id.";
    echo "<script> alert('$msg'); window.location.href='update_doctor.php'</script>";
	}
	else{
$sql = "UPDATE doc_details SET doc_name='$doc_name', doc_mob='$doc_mob', doc_mail_id='$doc_mail_id' WHERE doc_id=$doc_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Information updated Sucessfully";
    echo "<script> alert('$msg'); window.location.href='update_doctor.php'</script>";
	} else {
	$msg = "Error in updating Information";
    echo "<script> alert('$msg'); window.location.href='update_doctor.php'</script>";
	}
        }

?>