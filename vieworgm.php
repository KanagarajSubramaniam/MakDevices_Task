<?php
session_start();
if(!isset($_SESSION['data']['uid']))  {
header("location:signin.php");
}
$uid=$_SESSION['data']['uid'];
 include "db.php";	
 
 $q1 = mysqli_query($con,"select distinct(mmid),oname,subject,location from t_meeting where oid = '$uid'") or die(mysql_error());
 $count = mysqli_num_rows($q1);
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
 <center><b> Below are the overview of your Organized Meetings, To know more information click on View button.</b></center>
</div>

   <div class="table-responsive" style="padding-top:5px;">
            <table id="exportL" class="table table-bordered  table-striped table-hover" >
								<thead>
            <tr>
        
        <th colspan="6" style="background-color:green;color:white;font-weight:bold;">ORGANIZED MEETINGS</th>
      </tr>
			<tr>
                <th>S.NO</th>
                <th>Meeting_ID</th>
                <th>Organizer_Name</th>
				<th>Subject</th>
				<th>Location</th>
				<th>Action</th>
				
                
            </tr>
        </thead>
        <tbody>
           
				<?php 
			   if($count == 0)
			   {
			 ?>
			  <tr>
				 <td colspan="6"><center> No meetings available in this view </center></td>
				</tr>
			 <?php
			   
			   }
			   else
			   {
			   
			   $n=0;
			   while($r1=mysqli_fetch_array($q1))
			   {?>
		        <tr>
				 <td><?php echo ++$n;?></td>
				 <td><?php echo $r1['mmid'];?></td>
				  <td><?php echo $r1['oname'];?></td>
				   <td><?php echo $r1['subject'];?></td>
				    <td><?php echo $r1['location'];?></td>

<td> <a href="vieworgmdetail.php?d=<?php echo $r1['mmid'];?>"> <button class="button" style="width:100%;background-color:#1abc9c;font-weight:bold;" ><span>View </span></button></a></td>
   
				 </tr>
			  <?php } }?>
			
        </tbody>
            </table> 
  </div>
 
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