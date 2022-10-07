<?php
include "data_connect.php";
mysqli_set_charset( $conn,'utf8');
session_start();
if( isset( $_SESSION['currentdeliver'] ) )
	{
        $sql = "UPDATE delivery SET Available='no' WHERE Username='" .$_SESSION['currentdeliver']. "'";
        $query= mysqli_query($conn,$sql);
        $time_end=date('G:i:s');
        $time_end = explode(":", $time_end);
        $time_end=($time_end[0]+1).":".$time_end[1].":".$time_end[2];
        $sql = "SELECT Time_start FROM delivery WHERE Username='" .$_SESSION['currentdeliver']. "'";
        $query= mysqli_query($conn,$sql);
        while($row = mysqli_fetch_array($query))
		{
            $time_start=$row['Time_start'];
        }
        $time_start = explode(":", $time_start);
        $time_end = explode(":", $time_end);
        $minutes=($time_end[1]-$time_start[1])+($time_end[0]-$time_start[0])*60;
        $date=getdate();
		$month=$date['mon'];
		$day=$date['mday'];
        $year=$date['year'];
        $name=$_SESSION['currentdeliver'];
        $sql="SELECT Month,Day,Year,id FROM work_hours where Deliver='$name' and Month='$month' and Day='$day' and Year='$year'";
        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result)==0){
            $sql = "INSERT INTO work_hours (Hours,Deliver,Day,Month,Year) VALUES('$minutes','$name','$day','$month','$year') ";
            $query= mysqli_query($conn,$sql);
        }
        else{
            $id=0;
            while($row = mysqli_fetch_array($result)){
                $id=$row['id'];
            }
            $sql = "UPDATE work_hours SET Hours=Hours+'$minutes' Where id='$id'";
            $query= mysqli_query($conn,$sql);
        }
        
    }
    mysqli_close($conn);
?>