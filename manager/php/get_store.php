<?php
    session_start();

    include "data_connect.php";
    $name=$_SESSION['currentmanager'];
    $sql = "SELECT Store_name from manager where username='$name'";
    $result=mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result)){
        echo $row['Store_name'];
    }
?>