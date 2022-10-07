<?php
  
    include 'data_connect.php';
    mysqli_set_charset( $conn,'utf8');
    session_start();
    $username=$_POST['username'];
    $password=$_POST['password'];
	
    $sql="SELECT * FROM delivery where Username='$username' AND Password='$password'";
    $result=mysqli_query($conn,$sql);
    $suc = 0;
    $message = "success";
    if (mysqli_num_rows($result) == 0)
    {
		$message = "Wrong username or password";
    }
    else
	{	
		$suc=1;
		$_SESSION['currentdeliver'] = $username;
		$message = $_SESSION['currentdeliver'];
	}
	$res = array(
		"message" => $message,
		"status" => $suc,
		 );
	$json =  json_encode($res);
	echo $json;
 
?>
