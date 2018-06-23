<?php
 
// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 

				$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container  col-md-offset-4 col-md-10">
  
    <div style="width:30%;" class="panel panel-primary">
      <div class="panel-heading"><h4 style="text-align:center;">Email recovery password </h4></div>
      <div style="background-color:#dfe6e9;" class="panel-body">
	  <h5> Dear Customer, </h5>
      <p>&nbsp;&nbsp;  Your email recovery password is: $password </p>
   <p>
       Thanks & Regards, </br>
       The Team,</br>
       ProDesk Technology., </br>
       Web:www.prodesk.in. </p></div>
    </div>
</body>
</html>
';

?>











