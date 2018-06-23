<?php
		
// To send HTML mail, the Content-type header must be set
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				 
				// Create email headers
				$headers .= 'From: '.$from."\r\n".
					'Reply-To: '.$from."\r\n" .
					'X-Mailer: PHP/' . phpversion();
				 
				// Compose a simple HTML email message
				$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"
 xmlns:v="urn:schemas-microsoft-com:vml"
 xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<head>
	 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
</head>
<body>
<div class="container  col-md-offset-4 col-md-10">
     <h4><b>Welcome To Provoice! </b></h4>
	   <p>Thanks for joining us. Here is a great way to get started:</p>
    <div style="width:35%;" class="panel panel-primary">
      <div class="panel-heading"><h4 style="text-align:center;"><b>Provoice Team Services </b></h4></div>
      <div style="background-color:#dfe6e9;" class="panel-body">
	  <p>Click the below button to activate your Provoice account:</p>
	  <a href="#" style="width:35%;" class="center-block btn btn-success"> Join Now</a>
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

