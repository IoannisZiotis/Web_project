<?php

    include 'data_connect.php';
    $email=$_POST['email'];
    $password=$_POST['password'];
	
    $sql="SELECT * FROM customer where email='$email' AND password='$password'";
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
		session_start();
		$_SESSION['currentuser'] = $email;
	}
	$res = array(
		"message" => $message,
		 );
	// echo $res["message"];	 
	$json =  json_encode($res);
	;
 
?>
