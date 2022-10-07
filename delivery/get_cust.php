<?php
	include "data_connect.php";
	mysqli_set_charset( $conn,'utf8');
	session_start();
	if( isset( $_SESSION['currentdeliver'] ) )
	{
		$address = array("Address"=>"0","Address_number"=>"0","City"=>"0","lnglat"=>"0");
		$name= $_SESSION['currentdeliver'];
		$selectdata = "SELECT id From orders Where Deliver='$name' and delivered='0'";
		$query=mysqli_query($conn,$selectdata);
		if(mysqli_num_rows($query)!=0){
			
			$selectdata = "SELECT customer.Address,customer.Address_number,customer.City FROM customer  INNER JOIN orders ON customer.email=orders.Customer where orders.Deliver='$name' and orders.delivered='0'";
			$query=mysqli_query($conn,$selectdata);
			
			while($row = mysqli_fetch_array($query))
			{
				$address['Address']=$row['Address'];
				$address['Address_number']=$row['Address_number'];
				$address['City']=$row['City'];
			}
			// $json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address['Address']) .'+'.urlencode($address['Address_number']).'+'.urlencode($address['City']). '&key=AIzaSyCNUZ_YMZEz1CJK-QJprZtTM3jpQWn95b4');
			// $json = json_decode($json, true);

			// //echo $json['status'];
			// $lat = $json['results'][0]['geometry']['location']['lat'];

			// $lon = $json['results'][0]['geometry']['location']['lng'];
			
			// $latlng = $json['results'][0]['geometry']['location']['lat']. " " . $json['results'][0]['geometry']['location']['lng'];
			// $address["lnglat"]=$latlng;
			echo json_encode($address);
		}
		else{
			echo json_encode($address);
		}
	}
?>