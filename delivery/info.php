<?php
	include "data_connect.php";
	mysqli_set_charset( $conn,'utf8');
	session_start();
	if( isset( $_SESSION['currentdeliver'] ) )
	{
		$date=getdate();
		$month=$date['mon'];
		$day=$date['mday'];
		$year=$date['year'];
		$info=array("Routes"=>"0","Kilometers"=>"0");
		$name=$_SESSION['currentdeliver'];
		$selectdata = "SELECT Routes FROM work_hours WHERE Deliver = '$name' AND Day='$day' AND Month='$month' AND Year='$year'";
		$query=mysqli_query($conn,$selectdata);
		while($row = mysqli_fetch_array($query))
		{
			$info['Routes'] = $row['Routes'];
		}
		
		$query5 = "SELECT SUM(Km) AS dists FROM Orders WHERE Day='$day' AND Month='$month' AND Year='$year' AND Deliver='$name'";
		$result5 = mysqli_query($conn,$query5);
		while($row = mysqli_fetch_array($result5)){
			// $delivers[$row['Deliver']]->hours = $row['wp'];
			$km = $row['dists'];
		}

		$query6 ="SELECT Hours FROM work_hours WHERE Day='$day' AND Month='$month' AND Year='$year' AND Deliver='$name'"; 
		$result6 = mysqli_query($conn,$query6);
		while($row = mysqli_fetch_array($result6)){
			// $delivers[$row['Deliver']]->hours = $row['wp'];
			$hours = $row['Hours']/60;
		}
		$salary=round(5*$hours + 0.1*$km,2);
		$selectdata = "SELECT SUM(Km) as KM FROM orders WHERE Deliver = '$name' and Day='$day' and Month='$month' and Year='$year'";
		$query=mysqli_query($conn,$selectdata);
		if (mysqli_num_rows($query)!=0){
			while($row = mysqli_fetch_array($query))
			{
				$info['Kilometers'] = $row['KM'];
				echo '<h3>Διαδρομές σήμερα</h3>';
				echo '<p>'. $info['Routes']. '</p>';
				echo '<h3>Χιλιόμετρα σήμερα</h3>';
				echo '<p>'. $info['Kilometers']. '</p>';
				echo '<h3>Μισθός</h3>';
				echo '<p>'.$salary.'</p>';
			}
		}
		else{
				echo "no orders where delivered";
		}
		
	}
	mysqli_close($conn);
?>