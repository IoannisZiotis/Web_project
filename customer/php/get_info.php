<?php
session_start();
// header('Content-Type: text/html; charset=utf-8');
include "data_connect.php";

// $_SESSION["first_time"] = 

//$x=$_SESSION["currentuser"];

// $query = "SELECT Store_name FROM Manager where username='$x'";
// $res = mysqli_query($conn,$query);
// $store_name="a";
// while ($row = mysqli_fetch_row($res)) {
// 	$store_name= $row[0];

// }



$prod = array("tiropita","Xortopita","keik","tost","koulouri","Ellinikos","frape","espresso","Kapoutsino","filtrou");
$i=0;
$prices = array();
$query = "SELECT * FROM prices ";
$res = mysqli_query($conn,$query);
while ($row = mysqli_fetch_array($res)) {
	$prices[$prod[$i]] = $row['price'];
  	$i+=1;
	// $prices[] = $price;
}

// echo json_encode($prices);
echo json_encode(array_combine($prod, $prices));
mysqli_close($conn);
?>