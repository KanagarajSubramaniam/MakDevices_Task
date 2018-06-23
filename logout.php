<?php   
session_start(); 
include "db.php";
$tz = $_SESSION["browsertimezone"];
	 date_default_timezone_set($tz);
	 $dtnow = date('Y-m-d H:i',time());
$email = $_SESSION["email"];
	
	$state = "Logged Out";
	
$sqlup="update t_user set
lastsignout = '$dtnow',
state = '$state' 
WHERE email='$email'";

mysqli_query($con,$sqlup);
$hid = $_SESSION["hid"];
$uid = $_SESSION["uid"];
mysqli_query($con,"update t_user_history set signout='$dtnow' where id='$hid' and uid='$uid'");
	
session_destroy(); 
header("location:signin.php");
exit();
?>