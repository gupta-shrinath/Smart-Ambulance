<?php include '../database.php'; ?>

<?php

// create a variable
$hos_id=(int)$_GET['hos_id'];

//Execute the query

$sql = "DELETE from hospital_details WHERE hos_id=$hos_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Record Deleted Successfully";
    echo "<script> alert('$msg'); window.location.href='delete_hospital_details.php'</script>";
} else {
	$msg = "Error in Deletion of Record";
    echo "<script> alert('$msg'); window.location.href='delete_hospital_details.php'</script>";
}

?>