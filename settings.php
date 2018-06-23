<?php
session_start();
if(!isset($_SESSION['data']['uid']))  {
header("location:signin.php");
}
include "db.php";
$uid=$_SESSION['data']['uid'];
?>
<!DOCTYPE html><html lang="en">
<?php include 'include/head.php';?>
<body>
<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
    
}

.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

.container {
    padding: 2px 16px;
}
.button {
  border-radius: 4px;
  background-color: #1abc9c;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 18px;
  padding: 3px;
 
  width: 100%;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
.chip {
    display: inline-block;
    padding: 0 25px;
    height: 50px;
    font-size: 16px;
    line-height: 50px;
    border-radius: 25px;
    background-color: #f1f1f1;
}

.chip img {
    float: left;
    margin: 0 10px 0 -25px;
    height: 50px;
    width: 50px;
    border-radius: 50%;
}
</style>
<div class="app" id="app">
<?php include 'include/side_nav.php';  ?>
<div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
 <?php include 'include/top_nav.php'; ?>
 <?php include 'include/footer.php'  ?>
 <script>
 //update
 	$(document).ready(function(){
	$("#update_profile").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'action.php',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('.profile_update').attr("disabled","disabled");
					$('#update_profile').css("opacity",".5");
				},
				success	:	function(data){
					$("#msg").html(data);
					//alert(data);
					$('#update_profile').css("opacity","");
					$(".profile_update").removeAttr("disabled");
						
				}
			});
		});	
		
		$("#company").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'action.php',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('.c_profile_update').attr("disabled","disabled");
					$('#company').css("opacity",".5");
				},
				success	:	function(data){
					$("#msg1").html(data);
					//alert(data);
					$('#company').css("opacity","");
					$(".c_profile_update").removeAttr("disabled");
						
				}
			});
		});	
		
		$("#security").on('submit', function(e){
			e.preventDefault();
			$.ajax({
				type: 'POST',
				url: 'action.php',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: function(){
					$('.securitybtn').attr("disabled","disabled");
					$('#security').css("opacity",".5");
				},
				success	:	function(dd){
				if(dd==1){
				$("#msg2").html("<div class='alert alert-success'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Your password change successfully  : )</b></div>");
				$('#security').css("opacity","");
					$(".securitybtn").removeAttr("disabled");
					$("#security")[0].reset();
				}else{
				$("#msg2").html(dd);
					//alert(data);
					$('#security').css("opacity","");
					$(".securitybtn").removeAttr("disabled");
				}	
				}
			});
		});
		
		$(document).on("click",".currency_type",function(){
			
			var value=$('input[name=currency]:checked').val();
			var id=$("#uid").val();
			$.ajax({
				url:'action.php',
				type:'post',
				data	:{get_currency_type:1,currency:value,uid:id}
	
			});
		});

	$(document).on("click",".tax_type",function(){
			var value=$('input[name=tax_type]:checked').val();
			var id=$("#uid").val();
			$.ajax({
				url:'action.php',
				type:'post',
				data	:{get_tax_type:1,tax:value,uid:id}
	
			});
			
		});
		
		$(document).on("click",".tax_value",function(){
		   var tax_value=$("#tax_val").val();
		   var id=$("#uid").val();
		   alert("Tax added for all products="+tax_value);
		   $.ajax({
				url:'action.php',
				type:'post',
				data	:{post_tax_value:1,tax_value:tax_value,uid:id},
					
	
			});
		});
		//file type validation
		$(".file").change(function() {
			var file = this.files[0];
			var imagefile = file.type;
			var match= ["image/jpeg","image/png","image/jpg"];
			if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
				alert('Please select a valid image file (JPEG/JPG/PNG).');
				$("#file").val('');
				return false;
			}
		});
		
		function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(".file").change(function(){
    readURL(this);
});
  });
 </script>
<div class="app-body">
<div class="row-col">
<div class="col-sm-3 col-lg-3 b-r">
	<div class="p-y">
		<div class="nav-active-border left b-primary">
			<ul class="nav nav-sm">

				<li class="nav-item"><a class="nav-link block" href="#" data-toggle="tab" data-target="#tab-5">Security</a></li>
			</ul>
		</div>
	</div>
</div>


<!-- print customization -->
<a href="index.php"> <button class="button pull-right" style="width:150px;background-color:orange;padding-top:20px;padding-bottom:20px;"><span class="glyphicon glyphicon-home"></span> Dashboard</button></a>
<div class="tab-pane" id="tab-5">

<div class="p-a-md b-b _600">Security</div>
<div class="p-a-md">
<div class="clearfix m-b-lg">

	<form role="form" class="col-md-6 p-a-0" autocomplete="off" id="security">
	<div id="msg2"></div>
		<div class="form-group"><label>Old Password</label>
			<input type="password" class="form-control" name="old_password" required>
		</div>
		<div class="form-group"><label>New Password</label>
			<input type="password" class="form-control" name="new_password" required>
		</div>
		<div class="form-group"><label>New Password Again</label>
			<input type="password" class="form-control" name="confirm_password" required>
			<input type="hidden" name="change_password">
		</div>
		<button type="submit" class="btn btn-success btn-fw m-t securitybtn">Update</button>
	</form>

</div>

</div>
</div>
</div>
<script src="scripts/app.min.js"></script>
<script>
$(document).ready(function(){

    $("#check").click(function(){
    
        $("#withtax").toggle();
		
    });
});
</script>

<script>
$(document).ready(function(){
    $("#same").click(function(){
    
        $("#sametax").toggle();
			 $("#tax_val").focus();
    });
	$("#different").click(function(){
    
        $("#sametax").hide();
    });
});
</script>

<script>
$(document).ready(function(){
    $("#input_img").click(function(){
 
        $("#input_img1").show();
		

    });
	$("#input_img1").click(function(){
		 
        $("#input_img1").hide();
    });
});
</script>

<script>
$(document).ready(function() {

  $(".show-password, .hide-password").on('click', function() {
    var passwordId = $(this).parents('li:first').find('input').attr('id');
    if ($(this).hasClass('show-password')) {
      $("#" + passwordId).attr("type", "text");
      $(this).parent().find(".show-password").hide();
      $(this).parent().find(".hide-password").show();
    } else {
      $("#" + passwordId).attr("type", "password");
      $(this).parent().find(".hide-password").hide();
      $(this).parent().find(".show-password").show();
    }
  });
});
</script>
</body>
</html>