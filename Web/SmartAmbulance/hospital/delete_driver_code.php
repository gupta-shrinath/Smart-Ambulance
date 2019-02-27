<?php include '../database.php'; ?>

<?php

// create a variable
$a_id=(int)$_GET['a_id'];

//Execute the query

$sql = "DELETE from userdetailshosp WHERE a_id=$a_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Record Deleted Successfully";
    echo "<script> alert('$msg'); window.location.href='delete_driver_details.php'</script>";
} else {
	$msg = "Error in Deletion of Record";
    echo "<script> alert('$msg'); window.location.href='delete_driver_details.php'</script>";
}

?>