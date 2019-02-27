<?php include 'database.php'; ?>

<?php 
$username=$_POST['useremail'];
$password=$_POST['pass'];
$usertypeop=$_POST['usertype'];


$sql ="select * from hospital_details where hos_mail_id = '$username'";
$sqlqueryone= "SELECT hos_pass FROM hospital_details WHERE hos_mail_id='$username'";
$rowh = mysqli_fetch_row(mysqli_query($con,$sqlqueryone));

$sql1 ="select * from admin_details where adm_mail_id = '$username' ";
$sqlquery= "SELECT adm_pass FROM admin_details WHERE adm_mail_id='$username'";
$row = mysqli_fetch_row(mysqli_query($con,$sqlquery));

$sql2 ="select * from traffic_details where tra_mail_id = '$username' ";
$sqlquerytwo= "SELECT tra_pass FROM traffic_details WHERE tra_mail_id='$username'";
$rowt = mysqli_fetch_row(mysqli_query($con,$sqlquerytwo));

	$res = mysqli_query($con,$sql);
	$res1 = mysqli_query($con,$sql1);
	$res2 = mysqli_query($con,$sql2);
	
	$check = mysqli_fetch_array($res);
	$check1 = mysqli_fetch_array($res1);
	$check2 = mysqli_fetch_array($res2);
		
	
    if($username=="" or $password=="")
    {
		$status = "Please enter your Email Id and Password for Login";
        header("location:index.php?status=".$status);
    }
    else if($usertypeop=="Hospital")
	{
		if(!isset($_SESSION['hlogin']))
		{
			if(password_verify($password,$rowh[0]))
			{
			if(isset($check))
			{	
				session_start();
					$_SESSION['sid']=session_id();
				$res = mysqli_query($con,$sql);
				$result = array();
				$hos_id;
				$hos_name;
				while($row = mysqli_fetch_array($res))
				{
						$hos_name=$row[hos_name];
						$hos_id=$row['hos_id'];
				}
				$_SESSION['hos_id']=$hos_id;
				$_SESSION['hos_name']=$hos_name;
				$_SESSION['hlogin']=true;
				header("location:hospital/hospital_home.php");
			}	
			}
			else
			{
				$status = "Wrong Email Id or Password";
				header("location:index.php?status=".$status);
			}
		}
		else
		{
			header("location:hospital/hospital_home.php");
		
		}
	}		
	else  if($usertypeop=="Administrator")
	{
		
		session_start();
			if(!isset($_SESSION['alogin']))
		{
			if(password_verify($password,$row[0]))
			{
			if(isset($check1))
			{
				$_SESSION['sid']=session_id();
				$res1 = mysqli_query($con,$sql1);
				$result = array();
				$aid;
				while($row = mysqli_fetch_array($res1))
				{
					$aid = $row['adm_id'];
				}	
				$_SESSION['alogin']=true;
				$_SESSION['aid'] = $aid;
				header("location:administrator/admin_home.php");	
			}
			}
			else
			{
				$status = "Wrong Email Id or Password";
				header("location:index.php?status=".$status);
			}
		}
		else
		{
			header("location:administrator/admin_home.php");
		}
	}
	
	else  if($usertypeop=="Traffic")
	{
		
		session_start();
		if(!isset($_SESSION['tlogin']))
		{
			if(password_verify($password,$rowt[0]))
			{
				if(isset($check2))
				{
					
					$_SESSION['sid']=session_id();		
					$res2= mysqli_query($con,$sql2);
					$result = array();
					$tra_id;
					while($row = mysqli_fetch_array($res2))
					{
						$tra_id = $row['tra_id'];
					}	
						$_SESSION['tlogin']=true;
						$_SESSION['tra_id'] = $tra_id;
					header("location:traffic/traffic_home.php");
				}
			}
			else
			{
			$status = "Wrong Email Id or Password";
			header("location:index.php?status=".$status);
			}
		}
			else
			{
			header("location:traffic/traffic_home.php");
			}
	}
mysqli_close($con);
?>