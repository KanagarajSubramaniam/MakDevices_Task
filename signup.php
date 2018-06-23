

<!DOCTYPE html>
<html lang="en">
<?php include 'include/head.php';
?>
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
				f_name: "required",
				l_name: "required",
				email: {
					required: true,
					email: true
				},
				password: {
					required: true,
					minlength: 6
				},
				repassword: {
					required: true,
					minlength: 6,
					equalTo: "#password"
				}
			},
			messages: {
				f_name: "Please enter your firstname",
				l_name: "Please enter your lastname",
				email: "Please enter a valid email address",
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},
				repassword: {
					required: "Please provide confirm password",
					minlength: "Your password must be at least 6 characters long",
					equalTo: "Password and confirm password doesn't match"
				}
			}
	});
$("#email").keyup(function(){
		$("#welmmsg").hide();
		$.post("check_user.php",{email:adduser.email.value},function(data){
			$("#msg").html(data);
			
		})
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
     <!-- <div><a href="#" class="btn btn-block indigo text-white m-b-sm"><i class="fa fa-facebook pull-left"></i> Sign up with Facebook</a> <a href="#" class="btn btn-block red text-white"><i class="fa fa-google-plus pull-left"></i> Sign up with Google+</a></div>
      <div class="m-y text-sm">OR</div> -->
	  <div>
		<h4 style="font-weight:bold;">Sign Up</h4>
		<p class="text-muted m-y">Enjoy the complete features of User Data free for life time, we're sure that you will love it :)  </p>
	  </div>
	  <?php
				if($_GET){
					$success=$_GET['success']; 					
				
			?>
			<div class='alert alert-success' style="padding:10px;">
				<b><?php echo $success;   ?></b>
			</div>
			 <?php } ?>
	  <div id="err"></div>
        <form name="adduser" id="adduser" action="register.php" method="post">
            <div class="form-group">
              <input id="f_name" type="text" class="form-control"  name="f_name" placeholder="Firstname"  autofocus   autocomplete="off" required>
			</div>
			<div class="form-group">
              <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Lastname"  autocomplete="off" required>
			</div>

            <div class="form-group">
              <input type="email" class="form-control" id="email" name="email" placeholder="Email"  autocomplete="off" required>
			  <div id="msg"></div>
			</div>
            <div class="form-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password"  autocomplete="off" required>
            </div>
			<div class="form-group">
              <input type="hidden" class="form-control" id="repassword" name="repassword"  placeholder="Confirm Password"  autocomplete="off" required>
			</div>
			<div class="form-group">
              <input type="text" class="form-control" id="timezone" name="timezone"  value="<?php echo $timezone;?>"  autocomplete="off" readonly>
			</div>
			<div class="alert alert-info alert-dismissible" style="padding-top:5px;padding-bottom:5px;">
   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  We Have Auto Detected Your Timezone
</div>

            <div class="m-b-md text-sm"><span class="text-muted">By clicking Sign Up, I agree to the</span> <a href="#">Terms of service</a>  </div>
            <button id="signupbtn" type="submit" class="btn btn-lg black p-x-lg">Sign Up</button>
		
		</form>
		

         <div class="p-y-lg text-center">
            <div>Already have an account? <a href="signin.php" class="text-primary _600">Sign in</a></div>
         <p class="text-muted m-y"><br>© <?php echo date("Y");?> User Data | A Product by ProDesk</p>
		 </div>
		 
	</div>
  </div>
 </div>
</div>
<script src="js/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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