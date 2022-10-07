<?php

session_start();

include "data_connect.php";

$x=$_SESSION["currentmanager"];

$query = "SELECT Store_name FROM Manager where username='$x'";
$res = mysqli_query($conn,$query);
$store_name="a";
while ($row = mysqli_fetch_row($res)) {
	$store_name= $row[0];

}

$cpie = $_POST['Τυρόπιτα'];
$tost = $_POST['Τόστ'];
$xpie = $_POST['Χορτόπιτα'];
$cake = $_POST['Κέικ'];
$kl = $_POST['Κουλούρι'];

$query = "UPDATE Quantities SET τυρόπιτα='" .$cpie. "', χορτόπιτα='" .$xpie. "', τοστ='" .$tost. "', κέικ='" .$cake. "', κουλούρι='" .$kl. "' WHERE Store_name='" .$store_name. "'";

$result=mysqli_query($conn,$query);

if($result){
        echo "<p class='opvallend'>Successfully saves changes.</p>";
    }
else{
	
	echo "<p class='opvallend'>Something bad happened.</p>";
}    


mysqli_close($conn);
?>