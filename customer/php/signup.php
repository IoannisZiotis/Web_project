<?php
include "data_connect.php";

$password = $_POST["password"];
$mail = $_POST["email"];
$phone = $_POST["phone"];

$query = "SELECT email FROM Customer WHERE email='$mail'";
$result = mysqli_query($conn,$query);
if (mysqli_num_rows($result)==0)
{
    $query = "INSERT  INTO  Customer(phone_number,email,password)  VALUES ('$phone','$mail','$password')";
    $result = mysqli_query($conn,$query);
    session_start();
    $_SESSION['currentuser'] = $mail;
    echo "Account Created";
}
else
    echo "Account already exists";

mysqli_close($conn);    
?>