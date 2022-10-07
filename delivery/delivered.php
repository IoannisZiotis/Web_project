<?php	
	 include "data_connect.php";
	 mysqli_set_charset( $conn,'utf8');
	session_start();
	if( isset( $_SESSION['currentdeliver'] ) )
	{
		$store = array("X"=>0,"Y"=>0);
		$coordinates = array("X"=>0,"Y"=>0);
		$address=array("Address"=>"0","Number"=>"0","City"=>"0");
		$name= $_POST['user_name'];
		
		$sql="SELECT customer.Address,customer.Address_number,customer.City FROM customer INNER JOIN orders ON customer.email=orders.Customer where orders.Deliver='$name'";
		$query=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($query))
		{
			$address['Address']=$row['Address'];
			$address['Number']=$row['Address_number'];
			$address['City']=$row['City'];
		}

		$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($address['Address']) .'+'.urlencode($address['Number']).'+'.urlencode($address['City']). '&key=AIzaSyCNUZ_YMZEz1CJK-QJprZtTM3jpQWn95b4');
		$json = json_decode($json, true);

		$lat = $json['results'][0]['geometry']['location']['lat'];

		$lon = $json['results'][0]['geometry']['location']['lng'];
		
		$latlng = $json['results'][0]['geometry']['location']['lat']. " " . $json['results'][0]['geometry']['location']['lng'];
		//echo $latlng;
		$sql = "SELECT X(Location),Y(Location) FROM delivery WHERE Username ='$name'";
		$query=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($query))
		{
			$coordinates['X'] = $row['X(Location)'] ;
			$coordinates['Y'] = $row['Y(Location)'] ;

		}
		echo $coordinates['X'] . " " . $coordinates['Y'] . '<br>';
		$ltlng = explode(" ", $latlng);
		$lat = $ltlng[0];
		$lng = $ltlng[1];
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$coordinates['X'].",".$coordinates['Y']."&destinations=".$lat.",".$lng."&key=AIzaSyCKeLIlgJ6RmiJ0nTi0kZb4Oixc5MN9MpQ";

    //fetch json response from googleapis.com:
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);
	    //If google responds with a status of OK
	    //Extract the distance text:
	    if($response['status'] == "OK"){
	        $dist = $response['rows'][0]['elements'][0]['distance']['text'];
	       echo $dist;
	    }
		$sql = "SELECT X(Location),Y(Location) FROM store INNER JOIN orders ON store.Store_name=orders.Store WHERE orders.Deliver='$name' ";

		$query=mysqli_query($conn,$sql);
		while($row = mysqli_fetch_array($query))
		{
			$store['X'] = $row['X(Location)'] ;
			$store['Y'] = $row['Y(Location)'] ;

		}
		echo $store['X'] . " " . $store['Y'] . '<br>';
		$url = "https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$coordinates['X'].",".$coordinates['Y']."&destinations=".$store['X'].",".$store['Y']."&key=AIzaSyCKeLIlgJ6RmiJ0nTi0kZb4Oixc5MN9MpQ";
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$response = json_decode(curl_exec($ch), true);
		echo $response['rows'][0]['elements'][0]['distance']['text'];
	    //If google responds with a status of OK
	    //Extract the distance text:
	    if($response['status'] == "OK"){
	        $dist1 = $response['rows'][0]['elements'][0]['distance']['text'];
	       echo $dist1;
	    }
	    	if (Strpos($dist,"km")!=FALSE && Strpos($dist1,"km")!=FALSE)
	    	{
				$dist=floatval($dist)+floatval($dist1);
				mysqli_query($conn," UPDATE orders SET Km = ".$dist." WHERE Deliver = '".$_POST['user_name']."' AND delivered='0'");
			}
			elseif(Strpos($dist,"m")!=FALSE && Strpos($dist1,"km")!=FALSE){
				$dist=(floatval($dist)*0.001)+floatval($dist1);
				mysqli_query($conn," UPDATE orders SET Km =  ".$dist." WHERE Deliver = '".$_POST['user_name']."' AND delivered='0'");
			}
			elseif(Strpos($dist1,"m")!=FALSE && Strpos($dist,"km")!=FALSE){
				$dist=(floatval($dist1)*0.001)+floatval($dist);
				mysqli_query($conn," UPDATE orders SET Km =  ".$dist." WHERE Deliver = '".$_POST['user_name']."' AND delivered='0'");
			}
			else{
				$dist=(floatval($dist1)*0.001)+(floatval($dist)*0.001);
				mysqli_query($conn," UPDATE orders SET Km = ".$dist." WHERE Deliver = '".$_POST['user_name']."' AND delivered='0'");
			}
			$date=getdate();
			$month=$date['mon'];
			$day=$date['mday'];
			$year=$date['year'];
			mysqli_query($conn," UPDATE work_hours SET Routes = Routes + 1 WHERE Deliver = '".$_POST['user_name']."' AND Day='$day' AND Month='$month' AND Year='$year'");
			$sql = "UPDATE delivery SET Location=GeomFromText('POINT($latlng)') WHERE Username='" .$_SESSION['currentdeliver']. "'";
			$query= mysqli_query($conn,$sql);
			$sql = "UPDATE delivery SET available='yes' WHERE Username='" .$_SESSION['currentdeliver']. "'";
			$query= mysqli_query($conn,$sql);
			$sql="UPDATE orders SET delivered='1' where Deliver = '$name'";
			$query=mysqli_query($conn,$sql);
			mysqli_close($conn);
			}
		
?>
