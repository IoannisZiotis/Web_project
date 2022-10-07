<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include "data_connect.php";

$x=$_SESSION["currentmanager"];
$query = "SELECT Store_name FROM Manager where username='$x'";
$res = mysqli_query($conn,$query);
$store_name="a";
while ($row = mysqli_fetch_row($res)) {
	$store_name= $row[0];
}

$orders = array();
$query = "SELECT * FROM Orders LEFT JOIN Customer ON Customer=email where Store='$store_name' and delivered='0'";
$res = mysqli_query($conn,$query);

while ($row = mysqli_fetch_array($res)) {
  $order = array(
    "χορτόπιτα" =>$row['χορτόπιτα'],
    "τυρόπιτα" => $row['τυρόπιτα'],
    "κέικ" => $row['κέικ'],
    "τοστ"=>$row['τόστ'],
    "κουλούρι" => $row['κουλούρι'],
    "φραπέ" => $row['φραπέ'],
    "εσπρέσο" => $row['εσπρέσο'],
    "φίλτρου" => $row['φίλτρου'],
    "ελληνικός"=>$row['ελληνικός'],
    "καπουτσίνο"=>$row['καπουτσίνο'],
    "address"    => $row['Address'],
    "number"  => $row['Address_number'],
    "city" => $row['City'],
    "phone"  =>$row['phone_number'],
    "delived" => $row['delivered'],
    "id" => $row['Id'],
    "price" => $row['price'],
  );
  $orders[] = $order;
}

echo json_encode($orders);
mysqli_close($conn);
?>