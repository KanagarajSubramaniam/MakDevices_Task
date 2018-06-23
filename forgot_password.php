<?php
include "db.php";
$msg="";
if(isset($_POST["forgot"])){
$email=$_POST["email"];
$sql="SELECT * FROM t_user WHERE email='$email'";
$run=mysqli_query($con,$sql);
$count=mysqli_num_rows($run);
if($count == 1){
$row=mysqli_fetch_array($run);
	$password=$row["password"];
	include "forgot_email.php";
	
	    $to = $email;
		$subject = "Email recovery password";
		
		$from= "prodeskindia@gmail.com";
		

    $mail=mail($to,$subject,$message,$headers);
	$msg="<div class='alert alert-success' id='alert' style='padding:10px;'>
				<b>We have sent the password through email :)</b>
			</div>";
}

else{

 $msg="<p style='color:red;font-size:15px;'>This email is not available</p>";

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
	$("#email").keyup(function(){
		$("#welmmsg").hide();
		$.post("check_user1.php",{email:adduser.email.value},function(data){
			$("#msg").html(data);
			
		})
	})
	});
	</script>
<div class="app" id="app">
  <div class="padding">
   <div class="navbar">
   <div class="pull-center">
		<a href="#" class="navbar-brand">
		<div data-ui-include="'images/logo.svg'"></div>
		<img src="images/logo.png" alt="." class="hide"> <span class="hidden-folded inline">UserData</span> </a>
	  </div>
   </div>
  </div>
<div class="b-t">
  <div class="center-block w-xxl w-auto-xs p-y-md text-center">
    <div class="p-a-md">
      <div><h4>Forgot your password?</h4><p class="text-muted m-y">Enter your registered email-id here below and we will send you the login password through mail</p></div>
        <form name="adduser" id="adduser" action="" method="post">
		 <?php echo $msg; ?>
           <div class="form-group">
             <input type="email" placeholder="Email" name="email" id="email" class="form-control" required  autocomplete="off">
           <div id="msg"></div>
		   </div>
           <button name="forgot" type="submit" class="btn black btn-block p-x-md">Send</button>
        </form>
          <div class="p-y-lg">Return to <a href="signin.php" class="text-primary _600">Sign in</a>
		  <p class="text-muted m-y"><br>© <?php echo date("Y");?> UserData <br>A Product by ProDesk Technology LLP </p>     
		  </div>
    </div>
  </div>
</div>
</div>
<script src="js/jquery.js"></script>
	<script src="js/jquery.validate.js"></script>
<!--<script src="scripts/app.min.js"></script>-->
</body>
</html>