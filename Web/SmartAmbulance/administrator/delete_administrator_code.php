<?php
 include '../database.php';


// create a variable
$adm_id=(int)$_GET['adm_id'];

//Execute the query

$sql = "DELETE from admin_details WHERE adm_id=$adm_id";
mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
	
	$msg = "Record Deleted Successfully";
    echo "<script> alert('$msg'); window.location.href='delete_administrator_details.php'</script>";
		
} else {
	$msg = "Error in Deletion of Record";
    echo "<script> alert('$msg'); window.location.href='delete_administrator_details.php'</script>";
}

?>