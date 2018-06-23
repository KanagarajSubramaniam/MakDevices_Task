<?php
session_start();
 include "db.php";
 $uid=$_GET['uid'] ;

$data=mysqli_query($con,"select * from t_user where uid='$uid'");
$user_data=mysqli_fetch_array($data);
 ?>

<!DOCTYPE html>
 <html lang="en">
 <?php include 'include/head.php'; ?>
<body>
<?php include 'include/side_nav.php';  ?>
  <div id="content" class="app-content box-shadow-z2 bg pjax-container" role="main">
 <?php include 'include/top_nav.php'; ?>
 <?php include 'include/footer.php'; ?>

 
<div class="app-body">
 <div class="padding">
  <div class="box">
    <div class="box-body">
      <div class="box-header">
        <div class="col-md-10">
        <h3 class="view_head"><b>EDIT - USERS DATA</b></h3>

		</div>
     
      </div> </br>   <hr/>
       </br>
	   <div id="content">
       <form action="action.php" method="post">
	   <label for="uid"><b>ID</b> </label>
	   <input type="text" name="uid" id="uid" value="<?php echo $user_data["uid"];?>" class="form-control" readonly>
	   <br>
	   <label for="fname"><b>First Name</b> </label>
	   <input type="text" name="fname" id="fname" value="<?php echo $user_data["f_name"];?>" class="form-control">
	   <br>
	   <label for="lname"><b>Last Name</b> </label>
	   <input type="text" name="lname" id="lname" value="<?php echo $user_data["l_name"];?>" class="form-control">
	  <br>
	  <label for="uemail"><b>Email</b> </label>
	   <input type="text" name="uemail" id="uemail" value="<?php echo $user_data["email"];?>" class="form-control">
	      
<br>
		<center>  <a href="index.php"> <button type="button" class="btn btn-md w-md orange" >Back to Dashboard</button></a>
	<button class="btn btn-md w-md green" name="edituser" id="edituser">Save</button></a>
				</center>
	   
	   </form>
	   
	   </div>
            </div>
							  </div>
							</div>
</div>
</div>

 <!--delete popup-->
	<div id="m-delete" class="modal" data-backdrop="true">
	 <div class="row-col h-v">
	  <div class="row-cell v-m">
		<div class="modal-dialog modal-sm">
		<div class="modal-content">
		<form action="action.php" method="post">
		  <div class="modal-header">
		 <button type="button" class="close" data-dismiss="modal">&times;</button>
			<h5 class="modal-title">Delete Product </h5>
		</div>
		<div class="modal-body text-center p-lg">
		 <p>Are you sure to delete this product?</p>
		</div>
		<div class="modal-footer">
		 <input type="hidden" name="del_id" value="">
		   <button type="button" class="btn dark-white p-x-md" data-dismiss="modal">No</button>
		   <button type="submit" class="btn danger p-x-md" name="delete_product">Yes</button>
		  </div>
		</form>
		</div>
		</div>
		</div>
	   </div>
	  </div>
<!--delete popup-->

<div id="switcher">
 <div class="switcher dark-white" id="sw-theme">
  <a href="#" data-ui-toggle-class="active" data-ui-target="#sw-theme" class="dark-white sw-btn">
   <i class="fa fa-gear text-muted"></i></a><div class="box-header">
	 <strong>Customize your screen</strong></div>
	  <div class="box-divider"></div>
      <div class="box-body">
						  <p>Select Skins</p>
				    <div data-target="bg" class="clearfix">
						  <label class="radio radio-inline m-a-0 ui-check ui-check-lg">
						   <input type="radio" name="theme" value=""> <i class="light"></i>
						  </label>
                        <label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
						 <input type="radio" name="theme" value="grey"> <i class="grey"></i>
						</label>
						<label class="radio radio-inline m-a-0 ui-check ui-check-color ui-check-lg">
						 <input type="radio" name="theme" value="dark"> <i class="dark"></i></label>
						  
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