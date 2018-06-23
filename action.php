<?php
include "db.php";
session_start();
$uid=$_SESSION['data']['uid'];
$date=date("Y-m-d");
if(isset($_POST["product_name"]))
{
	$product_id=$_POST["product_name"];
	$product_price=$_POST["product_price"];
	$qty=$_POST["qty"];
	$tax=$_POST["tax"];
	
	if(empty($product_id) || empty($product_price) || empty($qty)){
		
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please Fill all fields..!</b>
			</div>
		";
		exit();
	}else{
		
		//check stock in our database
	$checkqty=mysqli_query($con,"select p_stock from t_product WHERE p_id = '$product_id' and uid='$uid' ");
	$count_stock =mysqli_fetch_array($checkqty);
	$count_stock=$count_stock[0];
	if($count_stock < $qty){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>Insufficient Quantity</b>
			</div>
		";
		exit();
	}else{
	/* 	
		$less_qty=$count_stock-$qty;
		
		$updateqty=mysqli_query($con,"update t_product set p_stock='$less_qty' WHERE p_id = '$product_id'"); */
		
			//same product qty update
		$update_qty=mysqli_query($con,"select p_id,p_qty from  t_temp_bill WHERE p_id = '$product_id' and uid='$uid' ");
		$qtyval =mysqli_fetch_array($update_qty);
		$addqty=$qtyval["p_qty"]+$qty;
		$update_qtyRow = mysqli_num_rows($update_qty);
		if($update_qtyRow ==1){
			$invoice_update=mysqli_query($con,"update t_temp_bill set p_qty='$addqty' where p_id = '$product_id' and uid='$uid' ");
		}else{
			$run_query=mysqli_query($con,"insert into t_temp_bill (p_id,p_price,p_qty,tax,uid) values ('$product_id','$product_price','$qty','$tax','$uid')");
		
		if(!$run_query){
			echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Something went wrong!</b>
			</div>
		";
		exit();
		}
		}
		
		
		
	}
		
	}

}
if(isset($_POST["get_seleted_product"]))
{
 $pid=$_POST["p_id"];
   $getprice_and_tax=mysqli_query($con,"select p_price,p_tax from t_product where p_id='$pid' and uid='$uid' ");
   $getdata=mysqli_fetch_assoc($getprice_and_tax);
   $price=$getdata["p_price"];
   $ptax=$getdata["p_tax"];
   echo "<input type='text' class='form-control' placeholder='Product Price' name='product_price' id='product_price' value='$price'>";
   echo "<input type='hidden' name='tax' id='tax' value='$ptax'/>";
   
}

if(isset($_POST["id"]))
{
	
	$id=$_POST["id"];
	$delete=mysqli_query($con,"delete from t_temp_bill where id='$id' and uid='$uid'");
}

if(isset($_POST["get_customer_name"]))
{
	$cname=$_POST["cname"];
   $get_cus_name=mysqli_query($con,"select * from t_contact where name='$cname' and uid='$uid'");
   $getdata=mysqli_fetch_assoc($get_cus_name);
   $cus_id=$getdata["cus_id"];
   $cus_mob=$getdata["mobile"];
   $cus_email=$getdata["email"];
   if($cus_id==""){
	   $cus_id=0;
   }
   echo "
	<div class='form-group'>
      <input type='number' class='form-control' id='mobile' placeholder='Customer mobile' name='mobile' value='$cus_mob' autofocus>
    </div>
	<div class='form-group'>
      <input type='email' class='form-control' id='email' placeholder='Customer Email' name='email' value='$cus_email'>
      <input type='hidden' id='cus_id' name='cus_id' value='$cus_id'>	  
    </div>
   ";
}

if(isset($_POST["add_product"]))
{
	
	if(!empty($_POST["name"]) ||  !empty($_POST["price"])){
		$check_product=mysqli_query($con,"select p_name from t_product where p_name='$_POST[name]' and uid='$uid'");
		$product_count=mysqli_num_rows($check_product);
		if($product_count==0){
			$add_product=mysqli_query($con,"insert into t_product (uid,p_name,p_price,p_tax) values ('$uid','$_POST[name]','$_POST[price]','$_POST[tax]') ");
			if($add_product){
				echo 1;
				exit();
			}else{
			echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Something went wrong!</b>
					</div>
				";
				exit();
			}
		}else
		{
			echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This product already exist !</b>
					</div>
				";
				exit();
		}
	}else{
		echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields!</b>
					</div>
				";
				exit();
	}
		
}
	
if(isset($_POST["stock"]))
{
	echo "Success";
$stock_val=$_POST["stock"];
$pid=$_POST["pid"];
$update_qty=mysqli_query($con,"update t_product set p_stock=p_stock+'$stock_val' where p_id='$pid' and uid='$uid' ");
header("location:view_product.php");
}

if(isset($_POST["update_product"]))
{
	
	$update_product=mysqli_query($con,"update t_product set p_name='$_POST[update_p_name]',p_price='$_POST[update_p_price]',p_tax='$_POST[update_p_tax]' where p_id='$_POST[update_p_id]' and uid='$uid' ");
	header("location:view_product.php");
}

if(isset($_POST["delete_product"]))
{	
	$id=$_POST["del_id"];
	$delete=mysqli_query($con,"delete from t_product where p_id='$id' and uid='$uid' ");
	header("location:view_product.php");
}


if(isset($_POST['add_new_contact']) )
{
	
	if(!empty($_POST["contact_name"]) ||  !empty($_POST["contact_mobile"])||  !empty($_POST["contact_email"])){
		$name=$_POST["contact_name"];
	$mobile=$_POST["contact_mobile"];
	$email=$_POST["contact_email"];
	$select_tag=$_POST["select_tag"];
	$created_by=$_SESSION["data"]["f_name"];
   $check_contact=mysqli_query($con,"select email from t_contact where email='$email' and uid='$uid' ");
   $count_contact=mysqli_num_rows($check_contact);
	   if($count_contact > 0)
   {
	  echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>This Email already exist !</b>
					</div>
				";
	   exit();
   }else{
	   $insert_contact=mysqli_query($con,"insert into t_contact (tag_id,uid,name,mobile,email,created_by,updated_by,created_on,updated_on) values('$select_tag','$uid','$name','$mobile','$email','$created_by','$created_by','$date','$date') ");
	   if($insert_contact){
		   echo 1;
	   }
   }
		
	}else{
		echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields!</b>
					</div>
				";
				exit();
	}
	
   
}

if(isset($_POST['Updatecontact']) )
{
	if(!empty($_POST["edit_name"]) ||  !empty($_POST["edit_mobile"])||  !empty($_POST["edit_email"])){
		$cid=$_POST["cus_id"];
		$name=$_POST["edit_name"];
		$mobile=$_POST["edit_mobile"];
		$email=$_POST["edit_email"];

	   $update_contact=mysqli_query($con,"update t_contact set name='$name', mobile='$mobile', email='$email' where cus_id='$cid' and uid='$uid'");
	   if($update_contact){
		   echo 1;
		   header("location:app.contact.php");
	   }

		
	}else{
		echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please fill all fields!</b>
					</div>
				";
		header("location:app.contact.php");
	}	  
}

if(isset($_POST["delete_contact"]))
{
	
	$id=$_POST["del_id"];
	$delete=mysqli_query($con,"delete from t_contact where cus_id='$id' and uid='$uid' ");
	header("location:app.contact.php");
}

if(isset($_POST["update_user_profile"]))
{
	$f_name=$_POST["f_name"];
	$l_name=$_POST["l_name"];
	$mobile=$_POST["mobile"];
	$location=$_POST["location"];
	$uid=$_POST["user_id"];
	
	$uploadedFile = '';
    if(!empty($_FILES["file"]["type"])){
        $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "uploads/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
				
				 //insert form data in the database
		        $update_profile=mysqli_query($con,"update t_user set f_name='$f_name',l_name='$l_name',mobile='$mobile',location='$location',profile_img='$uploadedFile' where uid='$uid'");
				if($update_profile)
				{
				echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Record updated:)</b>
					</div>
				";
				}
            }
        }
    }else{
		
		$update_profile=mysqli_query($con,"update t_user set f_name='$f_name',l_name='$l_name',mobile='$mobile',location='$location' where uid='$uid'");
				if($update_profile)
				{
				
					echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Record updated:)</b>
					</div>
				";
				}
	}
}

if(isset($_POST["update_company_profile"]))
{
	$cname=$_POST["cname"];
	$address_one=$_POST["address_one"];
	$address_two=$_POST["address_two"];
	$phone=$_POST["phone"];
	$mobile=$_POST["mobile"];
	$email=$_POST["email"];
	$web=$_POST["web"];
	$uid=$_POST["uid"];
	
	$uploadedFile = '';
    if(!empty($_FILES["file"]["type"])){	
        $fileName = time().'_'.$_FILES['file']['name'];
        $valid_extensions = array("jpeg", "jpg", "png");
        $temporary = explode(".", $_FILES["file"]["name"]);
        $file_extension = end($temporary);
        if((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions)){
            $sourcePath = $_FILES['file']['tmp_name'];
            $targetPath = "uploads/".$fileName;
            if(move_uploaded_file($sourcePath,$targetPath)){
                $uploadedFile = $fileName;
				
				 //insert form data in the database
		        $update_company_profile=mysqli_query($con,"update t_company_info set c_name='$cname',address_one='$address_one',address_two='$address_two',phone='$phone',mobile='$mobile',email='$email',web='$web',logo='$uploadedFile' where uid='$uid'");
				if($update_company_profile)
				{
				
					echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Record updated:)</b>
					</div>
				";
				}
            }
        }
    }else{
		
		 $update_company_profile=mysqli_query($con,"update t_company_info set c_name='$cname',address_one='$address_one',address_two='$address_two',phone='$phone',mobile='$mobile',email='$email',web='$web' where uid='$uid'");
				if($update_company_profile)
				{
				
					echo "
					<div class='alert alert-success'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Record updated:)</b>
					</div>
				";
				}
	}
}

if(isset($_POST["get_currency_type"]))
{
	$uid=$_POST["uid"];
	$currency=$_POST["currency"];
	
	$currency=mysqli_query($con,"update  t_settings set currency_type='$currency' where uid='$uid' ");
}

if(isset($_POST["get_tax_type"]))
{
	$uid=$_POST["uid"];
	$tax=$_POST["tax"];
	
	$currency=mysqli_query($con,"update  t_settings set tax_type='$tax' where uid='$uid' ");
}

if(isset($_POST["post_tax_value"]))
{
	$uid=$_POST["uid"];
	$tax_value=$_POST["tax_value"];	
	$currency=mysqli_query($con,"update  t_settings set tax_value='$tax_value' where uid='$uid' ");
}
if(isset($_POST["change_password"]))
{
  $check_pwd=mysqli_query($con,"select password from t_user where password='$_POST[old_password]' and uid='$uid'");
  $pwd_count=mysqli_num_rows($check_pwd);
  if($pwd_count ==1){
     if($_POST["new_password"]!=$_POST["confirm_password"]){
		 echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Password and confirm password doesn't match : (</b>
					</div>
				";
	 }else{
	 
	  $change_password=mysqli_query($con,"update t_user set password='$_POST[new_password]' where  uid='$uid'");
	  if($change_password){
		 echo 1;
	  }
	 }
  }else{
         echo "
					<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Please check your old password :(</b>
					</div>
				";
  
  }
  
}
if(isset($_POST["del_invoice"]))
{
	$del_invoice=mysqli_query($con,"delete from t_invoice where bill_no='$_POST[del_id]'");
	header("location:viewinvoice.php");
}


if(isset($_POST["add_new_tag"]))
{
	$created_by=$_SESSION['data']['f_name'];
	$check=mysqli_query($con,"select tag_name from t_tag where tag_name='$_POST[tag_name]' and uid='$uid'");
	$tag_count=mysqli_num_rows($check);
	if($tag_count > 0){
		echo "
					<div class='alert alert-danger'>
						<b>This already exist :(</b>
					</div>
				";
	}else{
		$add_tag=mysqli_query($con,"insert into t_tag (tag_name,uid,created_on,created_by) values ('$_POST[tag_name]','$uid','$date','$created_by')");
	if($add_tag)
	{
		echo 1;
	}else{
		echo "Error";
	}
	}
	
	
}

if(isset($_POST["edituser"]))
{
$id = $_POST["uid"];
$fn = $_POST["fname"];
$ln = $_POST["lname"];
$ue = $_POST["uemail"];

	$eduser=mysqli_query($con,"update t_user set f_name='$fn',
l_name='$ln', email='$ue' where uid='$id'");
	header("location:index.php");
}

if(isset($_POST["deleteuser"]))
{
$id = $_POST["uid"];
$fn = $_POST["fname"];
$ln = $_POST["lname"];
$ue = $_POST["uemail"];

	$eduser=mysqli_query($con,"delete from t_user where uid='$id'");
	header("location:index.php");
}


if(isset($_POST["addtask"]))
{
$tn = $_POST["taskname"];
$fn = $_SESSION["f_name"];
$ln = $_SESSION["l_name"];
$td = $_POST["targetdate"];

	$astsk=mysqli_query($con,"insert into t_tasks (f_name,l_name,task_name,target_date) values ('$fn','$ln','$tn','$td')");
	header("location:tasks.php");
}


?>