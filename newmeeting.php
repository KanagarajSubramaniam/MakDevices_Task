<?php
session_start();
if(!isset($_SESSION['data']['uid']))  {
header("location:signin.php");
}
$uid=$_SESSION['data']['uid'];
 include "db.php";	
 
 $q1 = mysqli_query($con,"select ifnull(count(uid),0) as users from t_user") or die(mysql_error());
 $r1=mysqli_fetch_array($q1);
			$users=$r1['users'];

?>
<!DOCTYPE html>
 <html lang="en">
 <?php include 'include/head.php'; ?>
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
  padding: 5px;
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
 <?php include 'include/side_nav.php';  ?>
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
 <?php include 'include/top_nav.php'; ?>
 <?php include 'include/footer.php'; ?>

<div class="app-body">
 <div class="padding" >

  <h5 class="view_head"  style="padding-bottom:35px;"><b>NEW MEETING</b><a href="meetings.php"> <button class="button pull-right" style="width:150px;background-color:green;"><span class="glyphicon glyphicon-calendar"></span> Meetings</button></a></h5>
 <div class="container" style="background-color:white;">
<br>
<div class="alert alert-info alert-dismissible" id="semimessage" style="padding-top:5px;padding-bottom:5px;display:none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <center><b> Enter multiple TO email address separated by ; (Semi Colon)</b></center>
</div>
<div id="errordiv">

</div>
<div class="alert alert-danger alert-dismissible" id="semierror" style="padding-top:5px;padding-bottom:5px;display:none;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <center><b> Special character ',' is not allowed in To email address</b></center>
</div>

<form class="form-horizontal" id="mnew" action="" method="post">
    <div class="form-group" style="padding-bottom:30px !important;">
      <label class="control-label col-sm-1" for="mto" align="right"><b>To :</b></label>
      <div class="col-sm-11">
    <!-- <select id="mto" name="mto" placeholder="Enter Email's" multiple>
                    <option value="">Type a Email...</option>
                
<?php 
$q1 = mysqli_query($con,"select email from t_user") or die(mysql_error());

while($r1=mysqli_fetch_array($q1))
			   { ?>
			   
			 <option value="<?php echo $r1["email"];?>"><?php echo $r1["email"];?></option>  
			   
			   <?php
			   
			   }
			   ?>
                  
                  </select> -->
	  
       <input type="text"  class="form-control" id="mto" name="mto" placeholder="Enter Email's" autocomplete="off" required>
       

	  </div>
    </div>
	
    <div class="form-group" style="padding-bottom:30px !important;">
      <label class="control-label col-sm-1" for="msubject" align="right"><b>Subject :</b></label>
      <div class="col-sm-11">
        <input type="text" class="form-control" id="msubject" name="msubject" placeholder="Enter Subject" autocomplete="off" required>
      </div>
    </div>
    <div class="form-group" style="padding-bottom:30px !important;">
      <label class="control-label col-sm-1" for="mlocation"  align="right"><b>Location :</b></label>
      <div class="col-sm-11">
        <input type="text" class="form-control" id="mlocation" name="mlocation" placeholder="Enter Location" autocomplete="off" required>
      </div>
    </div>
	    <div class="form-group" style="padding-bottom:30px !important;">
      <label class="control-label col-sm-1" for="mfromdate"  align="right"><b>Starting :</b></label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="mfromdate" name="mfromdate" placeholder="Choose Start Date" autocomplete="off" required readonly>
      </div>
	   <div class="col-sm-2">
       <div class="form-group">
 
  <select class="form-control" id="mfromtime" name="mfromtime"  required>
    <option value="00:00">00:00</option>
	<option value="00:30">00:30</option>
	<option value="01:00">01:00</option>
	<option value="01:30">01:30</option>
	<option value="02:00">02:00</option>
	<option value="02:30">02:30</option>
	<option value="03:00">03:00</option>
	<option value="03:30">03:30</option>
	<option value="04:00">04:00</option>
	<option value="04:30">04:30</option>
	<option value="05:00">05:00</option>
	<option value="05:30">05:30</option>
	<option value="06:00">06:00</option>
	<option value="06:30">06:30</option>
	<option value="07:00">07:00</option>
	<option value="07:30">07:30</option>
	<option value="08:00">08:00</option>
	<option value="08:30">08:30</option>
	<option value="09:00">09:00</option>
	<option value="09:30">09:30</option>
	<option value="10:00">10:00</option>
	<option value="10:30">10:30</option>
	<option value="11:00">11:00</option>
	<option value="11:30">11:30</option>
	<option value="12:00">12:00</option>
	<option value="12:30">12:30</option>
	<option value="13:00">13:00</option>
	<option value="13:30">13:30</option>
	<option value="14:00">14:00</option>
	<option value="14:30">14:30</option>
	<option value="15:00">15:00</option>
	<option value="15:30">15:30</option>
	<option value="16:00">16:00</option>
	<option value="16:30">16:30</option>
	<option value="17:00">17:00</option>
	<option value="17:30">17:30</option>
	<option value="18:00">18:00</option>
	<option value="18:30">18:30</option>
	<option value="19:00">19:00</option>
	<option value="19:30">19:30</option>
	<option value="20:00">20:00</option>
	<option value="20:30">20:30</option>
	<option value="21:00">21:00</option>
	<option value="21:30">21:30</option>
	<option value="22:00">22:00</option>
	<option value="22:30">22:30</option>
	<option value="23:00">23:00</option>
	<option value="23:30">23:30</option>
   
  </select>
</div>
      </div>
	 
	        <label class="control-label col-sm-1" for="mtodate"  align="right"><b>Ending :</b></label>
      <div class="col-sm-3">
        <input type="text" class="form-control" id="mtodate" name="mtodate" placeholder="Choose End Date" autocomplete="off" required readonly>
      </div>
	   <div class="col-sm-2">
       <div class="form-group">
 
  <select class="form-control" id="mtotime" name="mtotime" height="100" required>
    <option value="00:00">00:00</option>
	<option value="00:30">00:30</option>
	<option value="01:00">01:00</option>
	<option value="01:30">01:30</option>
	<option value="02:00">02:00</option>
	<option value="02:30">02:30</option>
	<option value="03:00">03:00</option>
	<option value="03:30">03:30</option>
	<option value="04:00">04:00</option>
	<option value="04:30">04:30</option>
	<option value="05:00">05:00</option>
	<option value="05:30">05:30</option>
	<option value="06:00">06:00</option>
	<option value="06:30">06:30</option>
	<option value="07:00">07:00</option>
	<option value="07:30">07:30</option>
	<option value="08:00">08:00</option>
	<option value="08:30">08:30</option>
	<option value="09:00">09:00</option>
	<option value="09:30">09:30</option>
	<option value="10:00">10:00</option>
	<option value="10:30">10:30</option>
	<option value="11:00">11:00</option>
	<option value="11:30">11:30</option>
	<option value="12:00">12:00</option>
	<option value="12:30">12:30</option>
	<option value="13:00">13:00</option>
	<option value="13:30">13:30</option>
	<option value="14:00">14:00</option>
	<option value="14:30">14:30</option>
	<option value="15:00">15:00</option>
	<option value="15:30">15:30</option>
	<option value="16:00">16:00</option>
	<option value="16:30">16:30</option>
	<option value="17:00">17:00</option>
	<option value="17:30">17:30</option>
	<option value="18:00">18:00</option>
	<option value="18:30">18:30</option>
	<option value="19:00">19:00</option>
	<option value="19:30">19:30</option>
	<option value="20:00">20:00</option>
	<option value="20:30">20:30</option>
	<option value="21:00">21:00</option>
	<option value="21:30">21:30</option>
	<option value="22:00">22:00</option>
	<option value="22:30">22:30</option>
	<option value="23:00">23:00</option>
	<option value="23:30">23:30</option>
   
  </select>
</div>
      </div>
	  
    </div>
	
	
	    <div class="form-group" style="padding-bottom:30px !important;">
      <label class="control-label col-sm-1" for="mdescription"  align="right"><b>Message :</b></label>
      <div class="col-sm-11">
        <textarea class="form-control" rows="8" name="mdescription" id="mdescription" width="100%" placeholder="Enter Message" required></textarea>
      </div>
    </div>
	

    <div class="form-group" style="padding-bottom:20px !important;">      
	
<center> <button type="button" name="newmeeting" id="newmeeting" class="button" style="width:250px;background-color:blue;">SEND</button></center>
    </div>
  </form>
 
 </div>

  
							</div>
</div>
</div>



</div>





<script src="scripts/app.min.js"></script>
<!-- DataTables -->
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<!-- you need to include the shieldui css and js assets in order for the components to work -->
<link rel="stylesheet" type="text/css" href="http://www.shieldui.com/shared/components/latest/css/light/all.min.css" />
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/shieldui-all.min.js"></script>
<script type="text/javascript" src="http://www.shieldui.com/shared/components/latest/js/jszip.min.js"></script>
<script type="text/javascript" src="src/datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="src/datepicker/js/bootstrap-datepicker.min.js"></script>
 
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/selectize.min.js"></script>
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.4/js/standalone/selectize.min.js"></script>

<script type="text/javascript">
    jQuery(function ($) {
        $("#exportButton").click(function () {
            // parse the HTML table element having an id=exportTable
            var dataSource = shield.DataSource.create({
                data: "#exportTable",
                schema: {
                    type: "table",
                    fields: {
                        SNo: { type: Number },
                        Product_Name: { type: String },
                        Product_Price: { type: Number },
                        Stock: { type: Number }
                    }
                }
            });

            // when parsing is done, export the data to PDF
            dataSource.read().then(function (data) {
                var pdf = new shield.exp.PDFDocument({
                    author: "PrepBootstrap",
                    created: new Date()
                });

                pdf.addPage("a4", "portrait");

                pdf.table(
                    50,
                    50,
                    data,
                    [
                        { field: "SNo", title: "S.No", width: 50 },
                        { field: "Product_Name", title: "Product Name", width: 100 },
                        { field: "Product_Price", title: "Product Price", width: 100 },
                        { field: "Stock", title: "Stock", width: 50 }
                    ],
                    {
                        margins: {
                            top: 50,
                            left: 50
                        }
                    }
                );

                pdf.saveAs({
                    fileName: "Provoice_Product_Report"
                });
            });
        });
    });
</script>

<script>
  $(function () {
    $('#exportTable').DataTable({
	"lengthMenu": [[10, 25, 50,100,200,300,400,500,-1], [10, 25, 50,100,200,300,400,500, "All"]]
	});
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
$( document ).ready(function() {
    $('#mfromdate').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    autoclose: true,
	orientation: "bottom auto",
    todayHighlight: true,
    toggleActive: true
});

    $('#mtodate').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    autoclose: true,
	orientation: "bottom auto",
    todayHighlight: true,
    toggleActive: true
});



$.ajax({                                                     //the jquery ajax method

url : 'mtovalidate.php',                              //url paramater

type: 'POST',                                       //type of request – GET or POST

dataType : 'json',                            //type of data to expect from the server/source

success : function(data){                       //perform this function on successful reception of the json object

$('#mto').selectize({
    delimiter: ';',
    persist: false,
    options: data,
    valueField: 'text',
   plugins: ['remove_button'],
    create: function(input) {
        return {
            value: input,
            text: input
        }
    }
});

}

});




});

$("#mto").click(function() {
    $("#semimessage").show();
});

$("#mto").change(function() {
   var textarea = document.getElementById('mto');

var word = ',';

var textValue=textarea.value;  //-> don't use .innerHTML since there is no HTML in a textarea element

if (textValue.indexOf(word)!=-1)
{
  $("#semierror").show();
}
else
{
$("#semierror").hide();
}
});

$("#newmeeting").click(function(){
	
		$.post("meetingvalidate.php",{to:mnew.mto.value,subject:mnew.msubject.value,location:mnew.mlocation.value,fromdate:mnew.mfromdate.value,fromtime:mnew.mfromtime.value,todate:mnew.mtodate.value,totime:mnew.mtotime.value,message:mnew.mdescription.value},function(data){
			if(data.indexOf("1") > -1)
			{
			$("#errordiv").html("<div class='alert alert-success alert-dismissible' style='padding-top:5px;padding-bottom:5px;'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><center><b> Meeting request sent to the participants :) </b></center></div>");
			
			$('#mnew').trigger("reset");
			var $select = $('#mto').selectize();
 var control = $select[0].selectize;
 control.clear();
			}
			else
{			
			$("#errordiv").html(data);
}			
		})
	});	

	
	
	
</script>

</body>
</html>