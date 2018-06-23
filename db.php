

    <?php

    /* Attempt MySQL server connection. Assuming you are running MySQL

    server with default setting (user 'root' with no password) */

    $con = mysqli_connect("localhost", "root", "", "ud");

     

    // Check connection

    if($con === false){

        die("ERROR: Could not connect. " . mysqli_connect_error());

    } else{
		

	}
	

    // Close connection

    //mysqli_close($con);

    ?>

