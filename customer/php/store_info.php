<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include "data_connect.php";

// $_SESSION["first_time"] = 

// $x=$_SESSION["currentuser"];

$query = "SELECT Store_name,X(Location),Y(Location) FROM Store ";
$query2 = "SELECT * FROM Quantities";

$res = mysqli_query($conn,$query);
$res2 = mysqli_query($conn,$query2);

$stores = array();
$quantities = array();
$map = array();

while($row=mysqli_fetch_array($res)){
	$store = array(

		"Lat"=> $row['X(Location)'],
		"Long"=> $row['Y(Location)']
	);

	$stores[$row['Store_name']] =  $store;
}

while ($row = mysqli_fetch_array($res2)) {
  $quantity = array(
    "χορτόπιτα" => $row['χορτόπιτα'],
    "τυρόπιτα" => $row['τυρόπιτα'],
    "κέικ" => $row['κέικ'],
    "τοστ"=>$row['τοστ'],
    "κουλούρι" => $row['κουλούρι']
);
  $quantities[$row['Store_name']] = $quantity;
}
$infos = array();
foreach($stores as $key=>$v)
{
	$info = array(
		"Name" =>$key,
		"Lat" =>$v['Lat'],
		"Long"=>$v['Long'],
		"Τυρόπιτα"=>$quantities[$key]['τυρόπιτα'],
		"Χορτόπιτα"=>$quantities[$key]['χορτόπιτα'],
		"Κέικ"=>$quantities[$key]['κέικ'],
		"Τοστ"=>$quantities[$key]['τοστ'],
		"Κουλούρι"=>$quantities[$key]['κουλούρι']

	);
	$infos[] = $info;
}

echo json_encode($infos);
mysqli_close($conn);
?>