<?php
	include "data_connect.php";
	mysqli_set_charset( $conn,'utf8');
	session_start();
	if( isset( $_SESSION['currentdeliver'] ) )
	{
		$order=array("Τυρόπιτα"=>"0","Χορτόπιτα"=>"0","Τοστ"=>"0","Κέικ"=>"0","Κουλούρι"=>"0","Ελληνικός"=>"0","Φραπέ"=>"0","espresso"=>"0","Φίλτρου"=>"0","cappuccino"=>"0",);
		$name = $_SESSION['currentdeliver'];
		$selectdata = " SELECT τυρόπιτα,χορτόπιτα,τόστ,κέικ,κουλούρι,ελληνικός,φραπέ,εσπρέσο,καπουτσίνο,φίλτρου FROM orders WHERE Deliver ='$name' AND delivered='0' ";
		$query = mysqli_query($conn,$selectdata);
		while($row = mysqli_fetch_array($query))
		{
			 $order['Τυρόπιτα']=$row['τυρόπιτα'];
			 $order['Χορτόπιτα']=$row['χορτόπιτα'];
			 $order['Τοστ']=$row['τόστ'];
			 $order['Κέικ']=$row['κέικ'];
			 $order['Κουλούρι']=$row['κουλούρι'];
			 $order['Ελληνικός']=$row['ελληνικός'];
			 $order['Φραπέ']=$row['φραπέ'];
			 $order['espresso']=$row['εσπρέσο'];
			 $order['Φίλτρου']=$row['φίλτρου'];
			 $order['cappuccino']=$row['καπουτσίνο'];
		}
		
		echo json_encode($order);
		
	}
	mysqli_close($conn);
?>