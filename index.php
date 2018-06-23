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
			
			 $q2 = mysqli_query($con,"select ifnull(count(distinct(mmid)),0) as meetings from t_meeting where oid = '$uid'") or die(mysql_error());
 $r2=mysqli_fetch_array($q2);
			$meetings=$r2['meetings'];

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
</style>
 <?php include 'include/side_nav.php';  ?>
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
 <?php include 'include/top_nav.php'; ?>
 <?php include 'include/footer.php'; ?>

<div class="app-body">
 <div class="padding" >
 <h5 class="view_head"  style="padding-bottom:15px;"><b>WELCOME, <?php echo $_SESSION['f_name'];?> <?php echo $_SESSION['l_name'];?></b></h5>
  <h5 class="view_head"  style="padding-bottom:15px;"><b>OPTION CARDS</b></h5>
 
 <div class ="row">
 
    <div class ="col-md-4">
        <div class="card">
 
  <div class="container">
  <div class="row">
  <div class="col-sm-6">
   <h4 class="view_head" style="padding-top:15px;"><b>User Activities</b></h4> 
    <p class="view_head">Users Data and Logged In Details</p> 
  </div>
  <div class="col-sm-6" style="padding-top:20px;">
  
 <a href="users.php"> <button class="button" ><span><?php echo $users;?> Users </span></button></a>
  </div>
</div>
   
	
  </div>
</div>
    </div>
    <div class ="col-md-4">
        <div class="card">
  
  <div class="container">
  <div class="row">
  <div class="col-sm-6">
  <h4 class="view_head" style="padding-top:15px;"><b>Overall Meetings</b></h4> 
    <p class="view_head">Plan and Schedule Meetings</p> 
  </div>
  <div class="col-sm-6" style="padding-top:20px;">
  <a href="meetings.php"><button class="button"><span><?php echo $meetings;?> Organized </span></button></a>
  </div>
  
</div>

	
  </div>
</div>
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


</body>
</html>