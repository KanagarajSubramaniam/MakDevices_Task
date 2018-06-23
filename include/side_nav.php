<div id="list" class="app-aside nav-dropdown black folded modal fade aside aside-sm b-r">
   <div class="navside dk" data-layout="column">
	  <div class="navbar no-radius">
	     <a href="index.php?header_msg=Dashboard" class="navbar-brand">
	   <div data-ui-include="'images/logo.svg'">
	   </div>
	     <img src="uploads/logo.png">
	     <span class="hidden-folded inline">User Data</span></a>
	  </div>
  
  
  
  <div data-flex-no-shrink="">
   <div class="nav-fold dropup">
     <a data-toggle="dropdown">
   <div class="pull-left">
   <div class="inline">
     <span class="avatar w-40 grey" style="text-transform: uppercase;"><?php echo substr($_SESSION['data']['f_name'],0,1) ; echo substr($_SESSION['data']['l_name'],0,1); ?></span></div>
     <img src="images/a0.jpg" alt="..." class="w-40 img-circle hide"></div>
   <div class="clear hidden-folded p-x">
      <span class="block _500 text-muted"></span>
     <div class="progress-xxs m-y-sm lt progress">
       <div class="progress-bar success" style="width: 100%"></div>
     </div>
   </div></a>
         
    </div>
   </div>
  </div>
</div>
	 <script>
$(document).ready(function(){
    $("#sidenav").click(function(){
        $("#asas").toggle(1000);
    });
});
</script>
