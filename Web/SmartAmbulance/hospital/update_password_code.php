


<?php
include '../database.php';
session_start();

$hos_id = $_SESSION['hos_id'];

$status;
$oldpassword=($_POST['oldpass']);
$newpassword=($_POST['newpass']);
$newpasswordr=($_POST['newpassr']);
$sql=mysqli_query($con,"SELECT hos_pass FROM hospital_details where hos_id='$hos_id'");
$row=mysqli_fetch_assoc($sql);
$oldpassworddb=$row['hos_pass'];

if($oldpassword!=$oldpassworddb)
{
	$msg="Enter the correct old password";
    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
if($newpassword!=$newpasswordr)
{
	$msg = "The New password doesnot match with current  password";
    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";

}
if (strlen($newpassword)>25&&strlen($newpassword)>8)  //Here is the code
{
		$hash_pass=password_hash($newpasswordr,PASSWORD_BCRYPT);

	$sql2="update hospital_details set hos_pass='$hash_pass' where hos_id='$hos_id'"; 
	mysqli_query($con,$sql2);
	if(mysqli_affected_rows($con) > 0)
	{
	$msg = "The Password Successfully Changed";
	    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
	else
	{
		$msg = "Error in Updating password";
		    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
}
else
{
	$msg = "The Password Should be between 8 to 25 characters";
	    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
?>