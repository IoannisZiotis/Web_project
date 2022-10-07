<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include "data_connect.php";

// $_SESSION["first_time"] = 

$x=$_SESSION["currentmanager"];

$query = "SELECT Store_name FROM Manager where username='$x'";
$res = mysqli_query($conn,$query);
$store_name="a";
while ($row = mysqli_fetch_row($res)) {
	$store_name= $row[0];

}

$quantities = array();
$query = "SELECT * FROM Quantities where Store_name='$store_name'";
$res = mysqli_query($conn,$query);
while ($row = mysqli_fetch_array($res)) {
  $quantity = array(
    "χορτόπιτα" => $row['χορτόπιτα'],
    "τυρόπιτα" => $row['τυρόπιτα'],
    "κέικ" => $row['κέικ'],
    "τοστ"=>$row['τοστ'],
    "κουλούρι" => $row['κουλούρι']
);
  $quantities[] = $quantity;
}

echo json_encode($quantities);
mysqli_close($conn);
?>