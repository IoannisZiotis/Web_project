<?php

    include 'data_connect.php';
    
    $username=$_POST['username'];
    $password=$_POST['password'];
	
    $sql="SELECT * FROM store_employee where username='$username' AND password='$password'";
    $result=mysqli_query($conn,$sql);
    if (mysqli_num_rows($result) == 0)
    {
		echo'
		<script type="text/javascript">
		alert("Wrong username or password"); 
		window.location.href = "Store.html";
		</script>';
    }
    else
	{	
		session_start();
		$_SESSION['currentmanager'] = $username;
		header('Location:Home.php');
	}

       
?>
