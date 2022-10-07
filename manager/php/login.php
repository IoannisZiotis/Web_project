<?php

    include 'data_connect.php';
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];
	
    $sql="SELECT * FROM Manager where username='$username' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    $suc = 0;
    $message = "success";
    if (mysqli_num_rows($result) == 0)
    {
		/*echo'
		<script type="text/javascript">
		window.location.href = "admin_nlogin.html";
		</script>';*/
		// die(header("location:admin.php?loginFailed=true&reason=password"));
		$message = "Wrong username or password";

    // header("location: admin_nlogin.php");
    }
    else
	{	

		$suc=1;
		//session_start();
		$_SESSION['currentmanager'] = $username;
		//header('Location:admin_welcome.html');
		//header('Location:final_admin.php'); //Was Welcome_admin.php
	}
	$res = array(
		"message" => $message,
		"status" => $suc,
		 );
	$json =  json_encode($res);
	echo $json;
 
?>
