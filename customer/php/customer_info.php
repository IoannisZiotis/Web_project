<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include "data_connect.php";


$email = $_SESSION['currentuser'];



$query = "SELECT phone_number FROM Customer WHERE email='$email' ";
$res = mysqli_query($conn,$query);
while ($row = mysqli_fetch_array($res)) {
	$phone = intval($row['phone_number']);
	// $prices[] = $price;
}

echo json_encode($phone);
// echo json_encode(array_combine($prod, $prices));
mysqli_close($conn);
?>