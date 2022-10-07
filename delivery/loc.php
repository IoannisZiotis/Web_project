

<?php
include "data_connect.php";
mysqli_set_charset( $conn,'utf8');
session_start();
$address= $_POST['text']; 
$address = str_replace(" ", "+", $address);
$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address) . '&key=AIzaSyCKeLIlgJ6RmiJ0nTi0kZb4Oixc5MN9MpQ');
$json = json_decode($json, true);

//echo $json['status'];
$lat = $json['results'][0]['geometry']['location']['lat'];

$lon = $json['results'][0]['geometry']['location']['lng'];

$latlng = $json['results'][0]['geometry']['location']['lat']. " " . $json['results'][0]['geometry']['location']['lng'];


$sql = "UPDATE delivery SET Location=GeomFromText('POINT($latlng)') WHERE Username='" .$_SESSION['currentdeliver']. "'";
$query= mysqli_query($conn,$sql);	
$sql = "UPDATE delivery SET Available='yes' WHERE Username='" .$_SESSION['currentdeliver']. "'";
$query= mysqli_query($conn,$sql);
$time=date('G:i:s');
$time = explode(":", $time);
$time=($time[0]+1).":".$time[1].":".$time[2];
echo $time;
$sql = "UPDATE delivery SET Time_start='$time' WHERE Username='" .$_SESSION['currentdeliver']. "'";
$query= mysqli_query($conn,$sql);
mysqli_close($conn);
?>