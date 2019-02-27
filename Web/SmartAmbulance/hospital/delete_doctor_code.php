<?php
 include '../database.php';


// create a variable
$doc_id=(int)$_GET['doc_id'];

//Execute the query

$sql = "DELETE from doc_details WHERE doc_id=$doc_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	$msg = "Record Deleted Successfully";
    echo "<script> alert('$msg'); window.location.href='delete_doctor_details.php'</script>";
} else {
	$msg = "Error in Deletion of Record";
    echo "<script> alert('$msg'); window.location.href='delete_doctor_details.php'</script>";
}

?>