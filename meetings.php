<?php
session_start();
if(!isset($_SESSION['data']['uid']))  {
header("location:signin.php");
}
$uid=$_SESSION['data']['uid'];
 include "db.php";	
 $th="";
 date_default_timezone_set($_SESSION["timezone"]);
	 $q1 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as org from t_meeting where oid = '$uid'") or die(mysql_error());
 $r1=mysqli_fetch_array($q1);
			$org=$r1['org'];

			$q2 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as new from t_meeting where rid = '$uid' and state='0'") or die(mysql_error());
 $r2=mysqli_fetch_array($q2);
			$new=$r2['new'];
			
				$q3 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as acc from t_meeting where rid = '$uid' and state='1'") or die(mysql_error());
 $r3=mysqli_fetch_array($q3);
			$acc=$r3['acc'];
			
			$q4 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as rej from t_meeting where rid = '$uid' and state='2'") or die(mysql_error());
 $r4=mysqli_fetch_array($q4);
			$rej=$r4['rej'];
			
			
			$q5 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as ten from t_meeting where rid = '$uid' and state='3'") or die(mysql_error());
 $r5=mysqli_fetch_array($q5);
			$ten=$r5['ten'];
	
$muser = "";
$mdate = "";
 if(isset($_GET['muser']))
{
$muser = $_GET['muser'];
}
 if(isset($_GET['mdate']))
{
$mdate = $_GET['mdate'];
}
 $dtnow = date('Y-m-d',time());
 $dtn = date('d-m-Y',time());
 $mdate = date("Y-m-d", strtotime($mdate));
 $md = $mdate;
 $mdn = date("d-m-Y", strtotime($md));
if(empty($muser))
{
 $q = mysqli_query($con,"select mid,mmid,oname,subject,location,fromdatetime,todatetime from t_meeting where rid = '$uid' and date(fromdatetime) = '$dtnow' and (state = '1' or state = '3')") or die(mysql_error());
 $count = mysqli_num_rows($q);
 $th = "<th colspan='6' style='background-color:#1abc9c;color:white'>ACCEPTED AND TENTATIVE MEETINGS FOR ".$_SESSION["f_name"]." ".$_SESSION["l_name"]." ON ".$dtn."</th>";
}
else
{
 $q = mysqli_query($con,"select mid,mmid,oname,subject,location,fromdatetime,todatetime from t_meeting where rid = '$muser' and date(fromdatetime) = '$md' and (state = '1' or state = '3')") or die(mysql_error());
 $count = mysqli_num_rows($q);
 $qq = mysqli_query($con,"select f_name,l_name from t_user where uid = '$muser'") or die(mysql_error());
 $rr=mysqli_fetch_array($qq);
 $th = "<th colspan='6' style='background-color:#1abc9c;color:white'>ACCEPTED AND TENTATIVE MEETINGS FOR ".$rr["f_name"]." ".$rr["l_name"]." ON ".$mdn."</th>";

}


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
  <h5 class="view_head"  style="padding-bottom:15px;"><b>AVAILABLE MEETINGS</b><a href="index.php"> <button class="button pull-right" style="width:150px;background-color:orange;"><span class="glyphicon glyphicon-home"></span> Dashboard</button></a></h5>

 <div class ="row">
 
 
 					    <div class ="col-md-3">
<div class="card">
  
  <ul class="list-group">
    <li class="list-group-item">Organized Meetings <span class="label label-success pull-right" style="background-color:gery;"><?php echo $org;?></span></li>
    <li class="list-group-item">New Meeting Requests <span class="label label-success pull-right" style="background-color:blue;"><?php echo $new;?></span></li>
    <li class="list-group-item">Accepted Meetings <span class="label label-success pull-right" style="background-color:green;"><?php echo $acc;?></span></li>
	<li class="list-group-item">Tentative Meetings <span class="label label-success pull-right" style="background-color:orange;"><?php echo $ten;?></span></li>
	<li class="list-group-item">Rejected Meetings <span class="label label-success pull-right" style="background-color:red;"><?php echo $rej;?></span></li>
  </ul>
</div>
    </div>

	 					    <div class ="col-md-3">
<div class="card" style="background-color:#0984e3;">
<a href="viewmeetings.php?c=a"><center><span class="glyphicon glyphicon-dashboard" style="color:white;font-size:120px;padding-top:35px;padding-bottom:20px;"></span>
<h4 style="color:white;font-weight:bold;padding-bottom:20px;">VIEW MEETING REQUESTS</h4>
</center></a>
</div>
    </div>
	
		 					    <div class ="col-md-3">
<div class="card" style="background-color:#e67e22;">
<a href="vieworgm.php"><center><span class="glyphicon glyphicon-cog" style="color:white;font-size:120px;padding-top:35px;padding-bottom:20px;"></span>
<h4 style="color:white;font-weight:bold;padding-bottom:20px;">VIEW ORGANIZED MEETINGS</h4>
</center></a>
</div>
    </div>
	
		 					    <div class ="col-md-3">
<div class="card" style="background-color:#1abc9c;">
<a href="newmeeting.php"><center><span class="glyphicon glyphicon-calendar" style="color:white;font-size:120px;padding-top:35px;padding-bottom:20px;"></span>
<h4 style="color:white;font-weight:bold;padding-bottom:20px;">CREATE NEW MEETING </h4>
</center></a>
</div>
    </div>
	</div>
	<div class="row">
 					    <div class ="col-md-3">
<div class="card">
   <center><h5 class="view_head"  style="padding-bottom:5px;padding-top:5px;"><b>DAILY CALENDAR - MEETINGS</b></h5></center>
 <hr>
<form class="form-horizontal" id="mtask" action="" method="get">
    <div class="form-group" style="padding-bottom:30px !important;">
      
      <div class="col-sm-12">
          <select class="form-control" id="muser" name="muser"  required>
    <option value="<?php echo $uid;?>">-- Select User --</option>
<?php 
$q1 = mysqli_query($con,"select uid,f_name,l_name from t_user") or die(mysql_error());

while($r1=mysqli_fetch_array($q1))
			   { ?>
			   
			 <option value="<?php echo $r1["uid"];?>"><?php echo $r1["f_name"];?> <?php echo $r1["l_name"];?></option>  
			   
			   <?php
			   
			   }
			   ?>
   
  </select>
	  </div>
    </div>
	
	    <div class="form-group" style="padding-bottom:30px !important;">
      
       <div class="col-sm-12">
        <input type="text" class="form-control" id="mdate" name="mdate" placeholder="Choose Date" value="<?php echo date("d-m-Y")?>" autocomplete="off" required readonly>
      </div>
    </div>
	 


    <div class="form-group" style="padding-bottom:20px !important;">      
	
<center> <button type="submit" name="viewm" id="viewm" class="button" style="width:250px;background-color:blue;">VIEW MEETINGS</button></center>
    </div>
  </form>
</div>
    </div>
	
	
	
			 					    <div class ="col-md-9">
<div class="card" style="background-color:white;">

   <div class="table-responsive" style="padding-top:5px;">
            <table id="exportL" class="table table-bordered  table-striped table-hover" >
								<thead>
            <tr>
        
        <?php echo $th;?>
      </tr>
			<tr>
               
                <th>Meeting_ID</th>
                <th>Organizer_Name</th>
				<th>Subject</th>
				<th>Location</th>
				<th>From_DateTime</th>
				<th>To_DateTime</th>
				
				
                
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
			   while($r=mysqli_fetch_array($q))
			   {?>
		        <tr>
				
				 <td><?php echo $r['mmid'];?></td>
				  <td><?php echo $r['oname'];?></td>
				   <td><?php echo $r['subject'];?></td>
				    <td><?php echo $r['location'];?></td>
					 <td><?php echo $r['fromdatetime'];?></td>
					  <td><?php echo $r['todatetime'];?></td>
		 </tr>
			  <?php }} ?>
			
        </tbody>
            </table> 
  </div>


</div>
    </div>
	
</div>
 

  </div>
  
							</div>
</div>
</div>



</div>

<br><br><br><br><br><br>



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
    $('#exportTable').DataTable()
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
    $('#mdate').datepicker({
    format: "dd-mm-yyyy",
    todayBtn: "linked",
    autoclose: true,
	orientation: "bottom auto",
    todayHighlight: true,
    toggleActive: true
});

});
</script>

</body>
</html>