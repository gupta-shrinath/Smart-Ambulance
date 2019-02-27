<?php include '../database.php'; ?>

<?php

// create a variable
$tra_id=(int)$_GET['tra_id'];

//Execute the query

$sql = "DELETE from traffic_details WHERE tra_id=$tra_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Record Deleted Successfully";
    echo "<script> alert('$msg'); window.location.href='delete_traffic_details.php'</script>";
} else {
	$msg = "Error in Deletion of Record";
    echo "<script> alert('$msg'); window.location.href='delete_traffic_details.php'</script>";
}

?>