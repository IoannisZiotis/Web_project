<?php
	include "data_connect.php";
	mysqli_set_charset( $conn,'utf8');
	session_start();
	if( isset( $_SESSION['currentdeliver'] ) )
	{
		$name= $_SESSION['currentdeliver'];
		$address = array("Address"=>"0","Address_number"=>"0","City"=>"0","Store_name"=>"0"); 
		$selectdata = "SELECT id From orders Where Deliver='$name'";
		$query=mysqli_query($conn,$selectdata);
		if(mysqli_num_rows($query)!=0){
		
		$selectdata = "SELECT store.Address,store.Address_number,store.City,store.Store_name FROM store INNER JOIN orders ON store.Store_name=orders.Store where orders.Deliver='$name' and orders.delivered='0'";
		$query=mysqli_query($conn,$selectdata);
		while($row = mysqli_fetch_array($query))
		{
			 $address['Address']=$row['Address'];
			 $address['Address_number']=$row['Address_number'];
			 $address['City']=$row['City'];
			 $address['Store_name']=$row['Store_name'];
		}
		echo json_encode($address);
	}
	else{
		echo json_encode($address);
	}
	
}
mysqli_close($conn);
?>