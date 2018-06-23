<?php
session_start();
include "db.php";
$msg="";
if(isset($_POST["login"])){
$email=$_POST["email"];
//$password=md5($_POST["password"]);
$password=$_POST["password"];
$timezone=$_POST["timezone"];
$sql="SELECT * FROM t_user WHERE email='$email' AND password='$password'";
$run=mysqli_query($con,$sql);
$count=mysqli_num_rows($run);
if($count == 1){

	 date_default_timezone_set($timezone);
	 $dtnow = date('Y-m-d H:i',time());

	$dtempty = "-";
	$state = "Logged In";
	
$sqlup="update t_user set
lastsignin = '$dtnow',
lastsignout = '$dtempty',
state = '$state' 
WHERE email='$email'";

mysqli_query($con,$sqlup);

$row=mysqli_fetch_array($run);
	$_SESSION["uid"]=$row["uid"];
	$_SESSION["email"]=$row["email"];
	$_SESSION["f_name"]=$row["f_name"];
	$_SESSION["l_name"]=$row["l_name"];
	$_SESSION["timezone"]=$row["timezone"];
	$_SESSION["lastsignin"]=$row["lastsignin"];
	$_SESSION["lastsignout"]=$row["lastsignout"];
	$_SESSION["state"]=$row["state"];
	$_SESSION["browsertimezone"]=$timezone;
	$_SESSION['data']=$row;
	$uid = $row["uid"];
		$run_history =mysqli_query($con,"insert into t_user_history (uid,signin,signout) values ('$uid','$dtnow','$dtempty')");
	$run_history_row =mysqli_query($con,"select id from t_user_history where uid ='$uid' order by signin desc");
	$history=mysqli_fetch_array($run_history_row);
		$_SESSION["hid"]=$history["id"];
	
	
	if(!empty($_POST["remember"])) {
				setcookie ("member_login",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));
				setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));
			} else {
				if(isset($_COOKIE["member_login"])) {
					setcookie ("member_login","");
				}
				if(isset($_COOKIE["member_password"])) {
					setcookie ("member_password","");
				}
			}
	
	$msg="<div class='alert alert-success' id='alert' style='padding:10px;'>
				<b>Sign In Successful :)</b>
			</div>";
	header( "refresh:1;url=index.php" );
}
else{

 $msg="<div class='alert alert-danger' id='alert' style='padding:10px;'>
				<b>Invalid Email or Password :(</b>
			</div>";
}

}

?>

<!DOCTYPE html><html lang="en">
<?php include 'include/head.php'  ?>
<link rel="stylesheet" href="css/screen.css">
<body>

<script>
$(document).ready(function() {
	$.validator.setDefaults({
		submitHandler: function() {
			$.ajax({
				url: form.attr("action")

			});
		}
	});
	$("#adduser").validate({
		rules: {
			
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
				},
			},
			messages: {
				email: "Please enter a valid email address",
				password: {
					required: "Please enter a password",
				}
				
			}
	});	
	$("#email").change(function(){
		$("#welmmsg").hide();
		$.post("check_user1.php",{email:adduser.email.value},function(data){
			$("#msg").html(data);	
		})
	});
	$(".btn").click(function(){
        $(this).button('loading').delay(1000).queue(function() {
            $(this).button('reset');
            $(this).dequeue();
        });        
    });
	$("input").keyup(function(){
		$("#alert").hide();
    });
	
	
	});
	</script>


<div class="app" id="app">
  <div class="padding">
    <div class="navbar">
      <div class="pull-center">
		<a href="#" class="navbar-brand">
		<div data-ui-include="images/logo.png"></div>
		<img src="images/logo.png" alt="." > <span class="hidden-folded inline">User Data - UD Application</span> </a>
	  </div>
    </div>
  </div>
<div class="b-t">
  <div class="center-block w-xxl w-auto-xs p-y-md text-center">
   <div class="p-a-md">
    <!-- <div><a href="#" class="btn btn-block indigo text-white m-b-sm"><i class="fa fa-facebook pull-left"></i> Sign in with Facebook</a> <a href="#" class="btn btn-block red text-white"><i class="fa fa-google-plus pull-left"></i> Sign in with Google+</a></div>
       <div class="m-y text-sm">OR</div> -->
	   
	   <div>
	     <h4 style="font-weight:bold;"> Sign In to your account  </h4>
		 <p class="text-muted m-y">Please enter your registered email and password, we'll help you out to handle the things :)</p>
	   </div>
          <form name="adduser" id="adduser" action="" method="POST">
		  <?php echo $msg;   ?>
		  
			<div class="form-group">
			<input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" placeholder="Email"  autocomplete="off" required>
			<div id="msg"></div>
			</div>
			<div class="form-group">
			<input type="password" class="form-control" name="password" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>"  placeholder="Password"  autocomplete="off" required></div>
			
				<div class="form-group">
              <input type="hidden" class="form-control" id="timezone" name="timezone"  value="<?php echo $timezone;?>"  autocomplete="off" readonly>
			</div>
			<div class="m-b-md">
			<label class="md-check"><input type="checkbox" name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?>/><i class="primary"></i> Keep me signed in</label></div>
			<button type="submit" name="login" id="submit" class="btn btn-lg black p-x-lg">Sign In</button>
          </form>
        <div class="m-y"><a href="forgot_password.php" class="_600"></a></div>
      <div>Do not have an account? <a href="signup.php" class="text-primary _600">Sign up</a></div>
	  <p class="text-muted m-y"><br>© <?php echo date("Y");?> User Data | A Product by ProDesk</p>
   </div>
  </div>
</div>
</div>
<script src="js/jquery.js"></script>
	<script src="js/jquery.validate.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js">
</script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js">
</script>
<!--<script src="scripts/app.min.js"></script>-->
<script>
$(document).ready(function() {
 var tz = jstz.determine(); // Determines the time zone of the browser client
    var timezone = tz.name(); //'Asia/Kolkata' for Indian Time.

    document.getElementById("timezone").value = timezone;
});
</script>
</body>
</html>