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
if(isset($_GET['uid']))
{
$guid = $_GET['uid'];
}

$query=mysqli_query($con,"select * from t_user where uid = '$guid'");
$row=mysqli_fetch_array($query);
		   	
$_SESSION['uuid'] = $row['uid'];
$_SESSION['uf_name'] = $row['f_name'];
$_SESSION['ul_name'] = $row['l_name'];
$_SESSION['uemail'] = $row['email'];
$_SESSION['upassword'] = $row['password'];
$_SESSION['utimezone'] = $row['timezone'];
$_SESSION['ulastsignin'] = $row['lastsignin'];
$_SESSION['ulastsignout'] = $row['lastsignout'];
$_SESSION['ustate'] = $row['state'];

?>
<!DOCTYPE html>
 <html lang="en">
 <?php include 'include/head.php'; ?>
<body>
<script>
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportBIToCSV(filename) {
    var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
function exportLIToCSV(filename) {
    var csv = [];
	var rows = document.querySelectorAll("table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
</script>
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
  <h5 class="view_head"  style="padding-bottom:35px;"><b>USER DETAILS</b><a href="index.php"> <button class="button pull-right" style="width:150px;background-color:orange;"><span class="glyphicon glyphicon-home"></span> Dashboard</button></a></h5>
 <div class="container" style="background-color:white;">
<br><center>
<img src="uploads/default_user_image.png"  class="img-circle" alt="User Image" width="150" height="150"> 
 </center>
 <h4 style="padding-top:10px;"><center><b><?php echo $_SESSION['uf_name'];?> <?php echo $_SESSION['ul_name'];?></b></center></h4> 
 <center> <p><b>Timezone - <?php echo $_SESSION['utimezone'];?></b></p> </center>
 <center>
<a href="users.php"> <button class="button" style="width:150px;background-color:green;"><span class="glyphicon glyphicon-user"></span> Users</button></a>
 <button class="button" onclick="exportBIToCSV('User_Data_Basic_Informations.csv')" style="width:150px;background-color:green;"><span class="glyphicon glyphicon-download"></span> Export Data</button>
 </center>
 <hr>
   <div class="alert alert-info alert-dismissible" style="padding-top:5px;padding-bottom:5px;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <center><b> Users Logged In details are displayed with respect to your Timezone.</b></center>
</div>
 <div class="table-responsive"  style="padding-top:5px;">
 <table class="table table-bordered table-striped table-hover" id="exportB">
    <thead>
	 <tr>
        <th colspan="6" style="background-color:#1abc9c;color:white;">BASIC INFORMATIONS</th>
        
      </tr>
      <tr>
        <th>User_ID</th>
        <th>Email</th>
        <th>Password</th>
		<th>Last_Sign_In</th>
		<th>Last_Sign_Out</th>
		<th>Availability</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo $_SESSION['uuid'];?></td>
		 <td><?php echo $_SESSION['uemail'];?></td>
		  <td><?php echo $_SESSION['upassword'];?></td>
		   <td><?php 
		   date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["utimezone"]);
$dt = new DateTime($_SESSION['ulastsignin']);
$dt->setTimezone( $newTZ );
$lastsignin = $dt->format('d-m-Y H:i');		   
		   echo  $lastsignin;?></td>
		    <td>		   <?php 
			
			if ($_SESSION['ulastsignout'] != "-")
			{
date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["utimezone"]);
$dt = new DateTime($_SESSION['ulastsignout']);
$dt->setTimezone( $newTZ );
$lastsignout = $dt->format('d-m-Y H:i');		   
		   echo  $lastsignout;
			
			}
			else
			{
			echo $_SESSION['ulastsignout'];
			}?></td>
			 <td><?php echo $_SESSION['ustate'];?></td>
        
      </tr>
    </tbody>
  </table>
  </div>
  <hr>
  <div class="alert alert-info alert-dismissible" style="padding-top:5px;padding-bottom:5px;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 <center><b> Note: By default Login Informations display last 30 login history for the user.</b></center>
</div>
   <div class="table-responsive" style="padding-top:5px;">
            <table id="exportL" class="table table-bordered  table-striped table-hover" >
								<thead>
            <tr>
        <th colspan="3" style="background-color:#1abc9c;color:white;">LOGIN INFORMATIONS</th>
        
      </tr>
			<tr>
                <th>S.NO</th>
                <th>Sign_In_DateTime</th>
                <th>Sign_Out_DateTime</th>
                
            </tr>
        </thead>
        <tbody>
           
			<?php 
			   $data=mysqli_query($con,"select * from t_user_history where uid='$guid' order by signin desc LIMIT 30");
			   $n=0;
			   while($user_data=mysqli_fetch_array($data))
			   {?>
		        <tr>
				 <td><?php echo ++$n;?></td>
                 <td>
				 <?php 
			if ($user_data['signin'] != "-")
			{
			 date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["utimezone"]);
$dt = new DateTime($user_data['signin']);
$dt->setTimezone( $newTZ );
$signin = $dt->format('d-m-Y H:i');		   
		   echo  $signin;
			
			
			}
			else
			{
			echo $user_data['signin'];
			}?>
				 
				 </td>
                 <td>		 <?php 
			if ($user_data['signout'] != "-")
			{
					 date_default_timezone_set($_SESSION['timezone']);
$newTZ = new DateTimeZone($_SESSION["utimezone"]);
$dt = new DateTime($user_data['signout']);
$dt->setTimezone( $newTZ );
$signout = $dt->format('d-m-Y H:i');		   
		   echo  $signout;}
			else
			{
			echo $user_data['signout'];
			}?></td>
   
				 </tr>
			  <?php } ?>
			
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


</body>
</html>