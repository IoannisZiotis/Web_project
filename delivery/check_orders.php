<?php
    include "data_connect.php";
	session_start();
	if( isset( $_SESSION['currentdeliver'] ) )
	{
		$name= $_SESSION['currentdeliver'];
		$selectdata = "SELECT id FROM orders WHERE Deliver='$name' AND delivered='0'";
        $query=mysqli_query($conn,$selectdata);
		if(mysqli_num_rows($query)!=0){
			$sql = "UPDATE delivery SET Available='no' where Username='$name'";
			$query= mysqli_query($conn,$sql);
            echo true;
			
        }
        else
            echo false;
    }
?>