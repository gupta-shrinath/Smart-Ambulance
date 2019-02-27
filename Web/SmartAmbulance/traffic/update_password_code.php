


<?php
include '../database.php';
session_start();

$tra_id = $_SESSION['tra_id'];

$status;
$oldpassword=($_POST['oldpass']);
$newpassword=($_POST['newpass']);
$newpasswordr=($_POST['newpassr']);
$sql=mysqli_query($con,"SELECT tra_pass FROM traffic_details where tra_id='$tra_id'");
$row=mysqli_fetch_assoc($sql);
$oldpassworddb=$row['tra_pass'];

if($oldpassword!=$oldpassworddb)
{
	$msg="Enter the correct old password";
    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
if($newpassword!=$newpasswordr)
{
	$msg = "The New password doesnot match current  password";
    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
if (strlen($newpassword)<25&&strlen($newpassword)<8)  //Here is the code
{
		$hash_pass=password_hash($newpasswordr,PASSWORD_BCRYPT);

	$sql2="update traffic_details set tra_pass='$hash_pass' where tra_id='$tra_id'"; 
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