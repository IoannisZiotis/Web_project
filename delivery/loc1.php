<?php
include "data_connect.php";
mysqli_set_charset( $conn,'utf8');
session_start();
$address= $_POST['text']; 
$sql = "UPDATE delivery SET Location=GeomFromText('POINT($address)') WHERE Username='" .$_SESSION['currentdeliver']. "'";
$query= mysqli_query($conn,$sql);	
$sql = "UPDATE delivery SET Available='yes' WHERE Username='" .$_SESSION['currentdeliver']. "'";
$query= mysqli_query($conn,$sql);
$time=date('G:i:s');
$time = explode(":", $time);
$time=($time[0]+1).":".$time[1].":".$time[2];
$sql = "UPDATE delivery SET Time_start='$time' WHERE Username='" .$_SESSION['currentdeliver']. "'";
$query= mysqli_query($conn,$sql);
mysqli_close($conn);

?>