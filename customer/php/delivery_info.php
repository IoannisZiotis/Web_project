<?php
session_start();
header('Content-Type: text/html; charset=utf-8');
include "data_connect.php";

// $_SESSION["first_time"] = 

// $x=$_SESSION["currentuser"];

$query = "SELECT Username,X(Location),Y(Location) FROM delivery WHERE Available='yes'";
// $query2 = "SELECT * FROM Quantities";

$res = mysqli_query($conn,$query);
// $res2 = mysqli_query($conn,$query2);

$infos = array();
while($row=mysqli_fetch_array($res)){
	$info = array(
		"Name" => $row['Username'],
		"Lat"=> $row['X(Location)'],
		"Long"=> $row['Y(Location)']
	);

	$infos[] =  $info;
}

echo json_encode($infos);
mysqli_close($conn);
?>