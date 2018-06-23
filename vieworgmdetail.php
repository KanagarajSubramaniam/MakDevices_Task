<?php
session_start();
if(!isset($_SESSION['data']['uid']))  {
header("location:signin.php");
}
$uid=$_SESSION['data']['uid'];
 include "db.php";	
 
 $type = "";
 $th = "";
 if(isset($_GET['d']))
{
$mmid = $_GET['d'];
}

 $q1 = mysqli_query($con,"select distinct(mmid),oname,oemail,subject,location,description,fromdatetime,todatetime from t_meeting where mmid = '$mmid' and rid='$uid'") or die(mysql_error());
 $q2 = mysqli_query($con,"select * from t_meeting where mmid = '$mmid'") or die(mysql_error());
 $r1=mysqli_fetch_array($q1);
 
 $_SESSION["tmmid"] = $r1["mmid"];

 $_SESSION["toname"] = $r1["oname"];
 $_SESSION["toemail"] = $r1["oemail"];

 $_SESSION["tfromdatetime"] = $r1["fromdatetime"];
 $_SESSION["ttodatetime"] = $r1["todatetime"];
 $_SESSION["tlocation"] = $r1["location"];
 $_SESSION["tsubject"] = $r1["subject"];
 $_SESSION["tdescription"] = $r1["description"];

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
 
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
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

  <h5 class="view_head"  style="padding-bottom:35px;"><b>ORGANIZED MEETINGS</b><a href="meetings.php"> <button class="button pull-right" style="width:150px;background-color:green;"><span class="glyphicon glyphicon-calendar"></span> Meetings</button></a></h5>
 <div class="container" style="background-color:white;">
<br>



  <div class="alert alert-info alert-dismissible" style="padding-top:5px;padding-bottom:5px;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <center><b> Below are the detailed description about your organized meeting, you can delete it any time.</b></center>
</div>
<center>
<img src="uploads/meeting.jpg" alt="Meeting Icon" class="img-thumbnail" height="200" width="200">
</center>

<h4 style="padding-top:10px;"><center><b><?php echo $_SESSION["tsubject"];?></b></center></h4> 
<h6 style="padding-top:5px;"><center><b>Happening at <?php echo $_SESSION["tlocation"];?></b></center></h6> 
<p><center><b>Organized by <?php echo $_SESSION["toname"];?>(<?php echo $_SESSION["toemail"];?>)</b></center></p> 
<p><center><b>From <?php echo date('d-m-Y H:i',strtotime($_SESSION["tfromdatetime"]));?> to <?php echo date('Y-m-d H:i',strtotime($_SESSION["ttodatetime"]));?></b></center></p> 
<p><center><b>NOTE: <?php echo $_SESSION["tdescription"];?></b></center></p> 
      
 <hr>
 <?php

  while($r2=mysqli_fetch_array($q2))
			   {
 
 ?>
 <p><b>- <?php echo $r2["rname"];?>(<?php echo $r2["remail"];?>) <?php echo $r2["statedescription"];?></b></p> 
 
  <?php

}
 
 ?>
  <hr>
<center>

<a href="meetingstate.php?s=del&m=<?php echo $_SESSION["tmmid"];?>"> <button class="button" style="background-color:red;font-weight:bold;width:150px;" ><span>DELETE</span></button></a>

</center>
 <br>
 
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
			$("#errordiv").html(data);
			
		})
	});	

</script>

</body>
</html>