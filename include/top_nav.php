<div class="app-header white bg b-b">
  <div class="navbar" data-pjax="">
     <a data-toggle="modal" data-target="#list" data-ui-modal class="navbar-item pull-left hidden-md-up">
			    <span class="btn btn-sm btn-icon white"><i class="fa fa-list"></i></span>
			</a>
     <div class="navbar-item pull-left h5" id="pageTitle"><a href="addinvoice.php">
	<strong> <?php
	 if(isset($_GET["header_msg"])){
		echo $_GET["header_msg"];	 
	 }else{
		 echo "Dashboard";
	 }	 
	 ?></strong>
	 </a>
	 </div>
       <ul class="nav navbar-nav pull-right">
		 <li class="nav-item dropdown">
			<a class="nav-link clear" data-toggle="dropdown">
		  <span class="avatar w-32"> 
		  <img src="uploads/default_user_image.png" width="100px" class="w-full rounded" alt="..."></span>
		  </a>
  
		  <div class="dropdown-menu w dropdown-menu-scale pull-right">
		  <a class="dropdown-item" href="settings.php?header_msg=Settings"><span>Change Password</span></a> 
		  <a class="dropdown-item" href="logout.php">Sign out</a></div></li>
	   </ul>	   
  </div>
 
</div>