<?php
include "data_connect.php";
mysqli_set_charset( $conn,'utf8');
session_start();
if( isset( $_POST['user_name'] ) )
	{
		$name= $_POST['user_name']; 

		$selectdata = "SELECT address,Number,City FROM orders WHERE Deliver = '$name'";
		$address = array("address"=>"0","Number"=>"0","City"=>"0");
		$query = mysqli_query($conn,$selectdata);
		while($row = mysqli_fetch_array($query))
		{
			$address["address"]=$row['address'];
			$address["Number"]=$row['Number'];
			$address["City"]=$row['City'];
		}
		$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address['address']) .'+'.urlencode($address['Number']).'+'.urlencode($address['City']). '&key=AIzaSyCKeLIlgJ6RmiJ0nTi0kZb4Oixc5MN9MpQ');
		$json = json_decode($json, true);

		//echo $json['status'];
		$lat = $json['results'][0]['geometry']['location']['lat'];

		$lon = $json['results'][0]['geometry']['location']['lng'];
		
		$latlng = $json['results'][0]['geometry']['location']['lat']. " " . $json['results'][0]['geometry']['location']['lng'];
		echo $latlng;
		mysqli_close($conn);
	}

?>