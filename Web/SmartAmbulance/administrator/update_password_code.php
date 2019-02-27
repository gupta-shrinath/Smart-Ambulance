


<?php
include '../database.php';
session_start();

$adm_id = $_SESSION['aid'];

$msg;
$oldpassword=($_POST['oldpass']);
$newpassword=($_POST['newpass']);
$newpasswordr=($_POST['newpassr']);
$sql=mysqli_query($con,"SELECT adm_pass FROM admin_details where adm_id='$adm_id'");
$row=mysqli_fetch_assoc($sql);
$oldpassworddb=$row['adm_pass'];

if($oldpassword!=$oldpassworddb)
{
	$msg="Enter the correct old password";
    echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
if($newpassword!=$newpasswordr)
{
	$msg = "The New password doesnot match with confirm password";
 echo "<script> alert('$msg'); window.location.href='change_password.php'</script>";
}
if (strlen($newpassword)<25&&strlen($newpassword)>8)  //Here is the code
{
	//HASHING THE PASSWORD !!!//
												$hash_pass=password_hash($newpasswordr,PASSWORD_BCRYPT);

	$sql2="update admin_details set adm_pass='$hash_pass' where adm_id='$adm_id'"; 
	mysqli_query($con,$sql2);
	if(mysqli_affected_rows($con) > 0)
	{
	$msg = "	Password Successfully Changed";
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