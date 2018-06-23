<?php
session_start();
include "db.php";

$return_arr = array();

$sql = "SELECT * FROM t_user where uid != '$uid'"; 

if ($result = mysqli_query( $con, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
    $row_array['text'] = $row['email'];


    array_push($return_arr,$row_array);
   }
 }

mysqli_close($con);

echo json_encode($return_arr);



?>