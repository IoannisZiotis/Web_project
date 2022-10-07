<?php

session_start();

include "data_connect.php";

$data = json_decode(file_get_contents("php://input"));

// $store_name = $_POST['store_name'];
// $del_name = $_POST['del_name'];


// echo $data;

foreach($data as $key=>$value)
{
	echo $key , " ";
}

$customer = $_SESSION['currentuser'];
$store = $data->store_name;
$del = $data->del_name;
$phone =$data->phone;
$r_num = $data->r_num;
$r_name = $data->r_name;
$r_city = $data->r_city;
$price = $data->price;
// $list = $data->list;
// $id = $_POST['order_id'];
$products = array("τυρόπιτα"=>"τυρόπιτα","χορτόπιτα"=>"χορτόπιτα","τόστ"=>"τοστ","κέικ"=>"κέικ","κουλούρι"=>"κουλούρι");

$test = "";
$time = getdate();
$month = $time['mon'];
$year = $time['year'];
$day = $time['mday'];
$query = "INSERT  INTO  Orders (Store,Deliver,Customer,price,Day,Month,Year)  VALUES ('$store','$del','$customer','$price','$day','$month','$year'
    )";

$result=mysqli_query($conn,$query);

foreach($data as $key=>$value)
{
	if ($key!='store_name' && $key!='del_name' && $key!='phone' && $key!='r_num' && $key!='r_name' && $key!='r_city' && $key!='price')
	{
		$key = mb_strtolower($key) ;
		echo $key , " , ";
		$query = "UPDATE Orders SET $key='" .$value. "' WHERE Customer='" .$customer. "'";
		$result = mysqli_query($conn,$query);
		if($key!='φραπέ' && $key!='ελληνικός' && $key!='εσπρέσο' && $key!='καπουτσίνο' && $key!='φίλτρου'){
		$query = "UPDATE quantities SET $products[$key]= $products[$key] -'" .$value. "' WHERE Store_name='" .$store. "'";
		$result1 = mysqli_query($conn,$query);
		}
	}
}
$up_customer_query = "UPDATE Customer SET phone_number='" .$phone. "',Address='". $r_name. "',Address_number='" .$r_num. "',City='" .$r_city. "' WHERE email='" .$customer. "'";
$result2 = mysqli_query($conn,$up_customer_query);

if($result){
        //echo "<p class='opvallend'>Successfully saves changes.</p>";
		echo "good";
    }
else{
		echo "shit";
	//echo "Something bad happened.";
  // "<p class='opvallend'>Something bad happened.</p>"
}


mysqli_close($conn);
?>
