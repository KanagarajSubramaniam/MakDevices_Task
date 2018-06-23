<?php 
		   echo  date("d-m-Y H:i", strtotime($_SESSION['ulastsignin']));?>

<?php 
		   date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["utimezone"]);
$dt = new DateTime($_SESSION['ulastsignin']);
$dt->setTimezone( $newTZ );
$lastsignin = $dt->format('d-m-Y H:i');		   
		   echo  $lastsignin;?>
		   
		   <?php 
			if ($_SESSION['ulastsignout'] != "-")
			{
			echo date("d-m-Y H:i", strtotime($_SESSION['ulastsignout']));}
			else
			{
			echo $_SESSION['ulastsignout'];
			}?>
		   
		   <?php 
			
			if ($_SESSION['ulastsignout'] != "-")
			{
date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["utimezone"]);
$dt = new DateTime($_SESSION['ulastsignout']);
$dt->setTimezone( $newTZ );
$lastsignout = $dt->format('d-m-Y H:i');		   
		   echo  $lastsignout;
			
			}
			else
			{
			echo $_SESSION['ulastsignout'];
			}?>



<?php
session_start();
date_default_timezone_set($_SESSION['timezone']);
echo date_default_timezone_get();

$date = date('d-m-Y H:i');
echo $date ;

$newTZ = new DateTimeZone("America/Chicago");
$date = new DateTime($date);
$date->setTimezone( $newTZ );
echo $date->format('d-m-Y H:i');

?>

 <?php

 if(isset($_POST["newmeeting"])){
 $mto = $_POST["mto"];
 $msubject = $_POST["msubject"];
 $mlocation = $_POST["mlocation"];
 $mfromdate = $_POST["mfromdate"];
 $mfromtime = $_POST["mfromtime"];
 $mtodate = $_POST["mtodate"];
 $mtotime = $_POST["mtotime"];
 $mdescription = $_POST["mdescription"];

if (strpos($mto, ',') !== false) {
    echo '<div class="alert alert-danger alert-dismissible" id="semierror" style="padding-top:5px;padding-bottom:5px;display:none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <center><b> Error! Kindly remove special character "," from To email address box </b></center>
</div>';
}
 
 $mtoarray = explode(';', $mto);

foreach($mtoarray as $item):
      echo '<div>'.$item.'</div>';
      
 endforeach;
 }
 ?>
 
 $fromdatetime = date("Y-m-d H:i", strtotime($fromdate)) + " " + $fromtime;
$todatetime = date("Y-m-d H:i", strtotime($todate)) + " " + $totime;