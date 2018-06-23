<?php
session_start();
include "db.php";
$date=date("Y-m-d");
	$f_name            = $_POST['f_name'];
	$l_name            = $_POST['l_name'];
	
	$email             = $_POST['email'];
	$password          = $_POST['password'];
	$Confirm_Password  = $_POST['repassword'];
	$timezone  = $_POST['timezone'];
	
	 date_default_timezone_set($timezone);
	 $dtnow = date('Y-m-d H:i',time());

	$dtempty = "-";
	$state = "Logged In";
	
	
	$name = "/^[a-zA-Z ]+$/";


		
	//existing email address in our database
	$sql = "SELECT email FROM t_user WHERE email = '$email' LIMIT 1" ;
	$check_query = mysqli_query($con,$sql);
	$count_email = mysqli_num_rows($check_query);
	if($count_email > 0){
		
			$success="This email is already registered with us :)";
			 header("Location:signup.php?success=".$success);
		exit();
	} else {
		//$password = md5($password);
		$run_query =mysqli_query($con,"insert into t_user (f_name,l_name,email,password,timezone,lastsignin,lastsignout,state)values('$_POST[f_name]','$_POST[l_name]','$_POST[email]','$password','$timezone','$dtnow','$dtempty','$state')");
	
		if($run_query){
			
			$login=mysqli_query($con,"SELECT * FROM t_user WHERE email='$_POST[email]' AND password='$password'");
		
			$row=mysqli_fetch_array($login);
			$_SESSION["uid"]=$row["uid"];
			$_SESSION["email"]=$row["email"];
			$_SESSION["f_name"]=$row["f_name"];
			$_SESSION["l_name"]=$row["l_name"];
			$_SESSION["timezone"]=$row["timezone"];
			$_SESSION["lastsignin"]=$row["lastsignin"];
			$_SESSION["lastsignout"]=$row["lastsignout"];
			$_SESSION["state"]=$row["state"];
			$_SESSION['data']=$row;
			$id=$_SESSION['data']['id'];
			$success="Sign Up Successful :)";
			$uid = $row["uid"];
			
				$run_history =mysqli_query($con,"insert into t_user_history (uid,signin,signout) values ('$uid','$dtnow','$dtempty')");
	$run_history_row =mysqli_query($con,"select id from t_user_history where uid ='$uid' order by signin desc");
	$history=mysqli_fetch_array($run_history_row);
		$_SESSION["hid"]=$history["id"];
			
			 header("Location:index.php");
			
		}else{
			echo "<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Error</b>
			</div>";
		}
	}
	
   
		
?>