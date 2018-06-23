<?php
session_start();
include "db.php";
$mc = 0;
if (($_POST["to"] == "") || ($_POST["subject"] == "") || ($_POST["location"] == "") || ($_POST["fromdate"] == "") || ($_POST["fromtime"] == "") || ($_POST["todate"] == "") || ($_POST["totime"] == "") || ($_POST["message"] == ""))
{
    echo "
<div class='alert alert-danger alert-dismissible' style='padding-top:5px;padding-bottom:5px;'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
 <center><b> All fields are mandatory, Kindly fill in the same. </b></center>
</div>
";
}
else{
$to = $_POST["to"];
$subject=$_POST["subject"];
$location=$_POST["location"];
$fromdate=$_POST["fromdate"];
$fromtime=$_POST["fromtime"];
$todate=$_POST["todate"];
$totime=$_POST["totime"];
$message=$_POST["message"];

$fromdatetime = implode(' ', array(date("Y-m-d", strtotime($fromdate)),$fromtime));
$todatetime = implode(' ', array(date("Y-m-d", strtotime($todate)),$totime));

if (strpos($to, ',') !== false) {
    echo "
<div class='alert alert-danger alert-dismissible' style='padding-top:5px;padding-bottom:5px;'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
 <center><b> Kindly remove special character ',' in TO email address </b></center>
</div>
";
}
else
{
 $toarray = explode(';', $to);

foreach($toarray as $item):
     
	$sql = "SELECT * FROM t_user WHERE email = '$item' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){

	$row=mysqli_fetch_array($check_query);
	$_SESSION["mtuid"]=$row["uid"];
	$_SESSION["mtemail"]=$row["email"];
	$_SESSION["mtf_name"]=$row["f_name"];
	$_SESSION["mtl_name"]=$row["l_name"];
	$_SESSION["mttimezone"]=$row["timezone"];
	
	$mtuid = $_SESSION["mtuid"];
		
		
date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["mttimezone"]);
$fdt = new DateTime($fromdatetime);
$fdt->setTimezone( $newTZ );
$fromdatetime = $fdt->format('Y-m-d H:i');
$tdt = new DateTime($todatetime);
$tdt->setTimezone( $newTZ );
$todatetime = $tdt->format('Y-m-d H:i');		
		
	$checkmeeting = "SELECT * FROM t_meeting WHERE rid = '$mtuid' and state = 1 and (('$fromdatetime' > fromdatetime and '$fromdatetime' < todatetime) or ('$todatetime' > fromdatetime and '$todatetime' < todatetime) or (fromdatetime='$fromdatetime' and todatetime ='$todatetime'))" ;
	$check_m = mysqli_query($con,$checkmeeting);
	$count_meeting = mysqli_num_rows($check_m);
	$mrow=mysqli_fetch_array($check_m);
	
		$_SESSION["mmfromdatetime"]=$mrow["fromdatetime"];
		$_SESSION["mmtodatetime"]=$mrow["todatetime"];
	
if($count_meeting > 0){
++$mc;
			    echo "
<div class='alert alert-danger alert-dismissible' style='padding-top:5px;padding-bottom:5px;'>
  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
 <center><b> ".$item." is already having another meeting between ".date("d-m-Y H:i", strtotime($_SESSION["mmfromdatetime"]))." and  ".date("d-m-Y H:i", strtotime($_SESSION["mmtodatetime"]))." (".$_SESSION["mttimezone"].") </b></center>
</div>
";
}	
	} 
  
 endforeach;


	
	if($mc == 0)
	{
	
	
	
	  $q1 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as mmid from t_meeting") or die(mysql_error());
 $r1=mysqli_fetch_array($q1);
			$mmid=$r1['mmid'];
	$mmid = $mmid+1;
	
	$oid = $_SESSION["uid"];
	$oname = implode(' ', array($_SESSION["f_name"],$_SESSION["l_name"]));
	$oemail = $_SESSION["email"];
	
	foreach($toarray as $item):
     $fromdatetime = implode(' ', array(date("Y-m-d", strtotime($fromdate)),$fromtime));
$todatetime = implode(' ', array(date("Y-m-d", strtotime($todate)),$totime));
	$sql = "SELECT * FROM t_user WHERE email = '$item' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){

	$row=mysqli_fetch_array($check_query);
	$_SESSION["mtuid"]=$row["uid"];
	$_SESSION["mtemail"]=$row["email"];
	$_SESSION["mtf_name"]=$row["f_name"];
	$_SESSION["mtl_name"]=$row["l_name"];
	$_SESSION["mttimezone"]=$row["timezone"];
	
	$mtuid = $_SESSION["mtuid"];
	
	
	$rname = implode(' ', array($_SESSION["mtf_name"],$_SESSION["mtl_name"]));
	$rid = $_SESSION["mtuid"];
	$remail = $_SESSION["mtemail"];
	
	
	date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["mttimezone"]);
$fdt = new DateTime($fromdatetime);
$fdt->setTimezone( $newTZ );
$fromdatetime = $fdt->format('Y-m-d H:i');
$tdt = new DateTime($todatetime);
$tdt->setTimezone( $newTZ );
$todatetime = $tdt->format('Y-m-d H:i');
		
		$insertmeeting = "insert into t_meeting (mmid,oid,oname,oemail,rid,rname,remail,fromdatetime,todatetime,subject,location,description,state,statedescription) values ('$mmid','$oid','$oname','$oemail','$rid','$rname','$remail','$fromdatetime','$todatetime','$subject','$location','$message','0','has not accepted the meeting')" ;		
	$im = mysqli_query($con,$insertmeeting);
	
	} else {
	
	$fromdatetime = implode(' ', array(date("Y-m-d", strtotime($fromdate)),$fromtime));
$todatetime = implode(' ', array(date("Y-m-d", strtotime($todate)),$totime));
		$insertmeeting = "insert into t_meeting (mmid,oid,oname,oemail,rid,rname,remail,fromdatetime,todatetime,subject,location,description,state,statedescription) values ('$mmid','$oid','$oname','$oemail','-','-','$item','$fromdatetime','$todatetime','$subject','$location','$message','0','has not accepted the meeting')" ;	
			
	$im = mysqli_query($con,$insertmeeting);

	
	$to      = $item;

  $sub	="Invitation to Join User Data - ProDesk";
 
		$msg = "
Hi,

$oname has invited you to join meeting via User Data - ProDesk.

Use the below sign up link to register.

Link: https://prodesk.in/demo/ud/signup.php

Thanks,
The Team,
ProDesk Technology LLP.
Web: www.prodesk.in
";
		 $headers = "MIME-Version: 1.0" . "\r\n";
 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";


 
 $headers = "From: support@prodesk.in\r\n";
		
    $mail=mail($to,$sub,$msg,$headers);
	
	
	}
  

  
 endforeach;
	
	$fromdatetime = implode(' ', array(date("Y-m-d", strtotime($fromdate)),$fromtime));
$todatetime = implode(' ', array(date("Y-m-d", strtotime($todate)),$totime));
	$insertmeeting = "insert into t_meeting (mmid,oid,oname,oemail,rid,rname,remail,fromdatetime,todatetime,subject,location,description,state,statedescription) values ('$mmid','$oid','$oname','$oemail','$oid','$oname','$oemail','$fromdatetime','$todatetime','$subject','$location','$message','1','has accepted the meeting')" ;		
	$im = mysqli_query($con,$insertmeeting);
	
	  			    echo "1";

	}
 
 
}
}

?>