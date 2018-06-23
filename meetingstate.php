<?php
session_start();
include "db.php";

 if(isset($_GET["s"]))
{
$s = $_GET["s"];
}
 if(isset($_GET["m"]))
{
$m = $_GET["m"];
}


if ($s == 'a')
{
$q1 = mysqli_query($con,"update t_meeting set state = '1', statedescription = 'has accepted the meeting' where mid = '$m'") or die(mysql_error());
 header("Location:viewmeetings.php");
}

if ($s == 'r')
{
$q1 = mysqli_query($con,"update t_meeting set state = '2', statedescription = 'has rejected the meeting' where mid = '$m'") or die(mysql_error());
 header("Location:viewmeetings.php");
}


if ($s == 't')
{
$q1 = mysqli_query($con,"update t_meeting set state = '3', statedescription = 'has tentatively accepted the meeting' where mid = '$m'") or die(mysql_error());
 header("Location:viewmeetings.php");
}

if ($s == 'del')
{
$q1 = mysqli_query($con,"delete from t_meeting where mmid = '$m'") or die(mysql_error());
 header("Location:vieworgm.php");
}


?>