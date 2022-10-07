<?php
include "data_connect.php";
    session_start();
    mysqli_set_charset( $conn,'utf8');
    $selectdata = "SELECT Deliver FROM orders WHERE Deliver='".$_SESSION['currentuser']."'";
    $result = mysqli_query($conn,$selectdata);
    if (mysqli_num_rows($result) != 0){
        echo 0;
    }
    else{
        echo 1;
    }
?>