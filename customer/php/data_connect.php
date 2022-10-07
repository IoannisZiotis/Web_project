<?php
   $conn = mysqli_connect("localhost","root","","web");
   mysqli_set_charset( $conn,'utf8');
   if(!$conn){
       die("Connection Failed: ".mysqli_connect_error());
   }
   
?>
