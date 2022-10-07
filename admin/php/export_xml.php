<?php
session_start();
include "data_connect.php";
include "class_emp.php";

$month = intval($_POST["month"]);
$year = intval($_POST["year"]);

$query = "SELECT username,name,surname,AFM,AMKA,IBAN,Store_name FROM Manager";
$result = mysqli_query($conn,$query);

$managers = array();
while($row = mysqli_fetch_array($result)){
	$managers[$row['username']] = new manager($row['name'],$row['surname'],$row['AFM'],$row['AMKA'],$row['IBAN'],$row['Store_name']);
}

$query2 = "SELECT Username,name,surname,AFM,AMKA,IBAN FROM delivery";
$result2 = mysqli_query($conn,$query2);

$delivers = array();
while($row = mysqli_fetch_array($result2)){
	$delivers[$row['Username']] = new deliver($row['name'],$row['surname'],$row['AFM'],$row['AMKA'],$row['IBAN']);
}

$query3 = "SELECT Store_name FROM Store";
$result3 = mysqli_query($conn,$query3);

$stores = array();
while($row = mysqli_fetch_array($result3)){
	$stores[$row['Store_name']] = 0;
}

// foreach($stores as $store){
$query4 = "SELECT Store,SUM(price) AS wp FROM Orders WHERE Month='$month' AND Year='$year' GROUP BY Store ";

$result4 = mysqli_query($conn,$query4);

while($row = mysqli_fetch_array($result4)){
	$stores[$row['Store']] = $row['wp'];
}
// }

$query5 = "SELECT Deliver,SUM(Km) AS dist FROM Orders WHERE Month='$month' AND Year='$year' GROUP BY  Deliver";
$result5 = mysqli_query($conn,$query5);

while($row = mysqli_fetch_array($result5)){
	// $delivers[$row['Deliver']]->hours = $row['wp'];
	$delivers[$row['Deliver']]->km = $row['dist'];
}

$query6 ="SELECT Deliver,SUM(Hours) AS wh FROM work_hours WHERE Month='$month' AND Year='$year' GROUP BY  Deliver"; 
$result6 = mysqli_query($conn,$query6);

while($row = mysqli_fetch_array($result6)){
	// $delivers[$row['Deliver']]->hours = $row['wp'];
	$delivers[$row['Deliver']]->hours = $row['wh']/60;
}
foreach($delivers as $deliver){
	$deliver->calc_slr($deliver->hours,$deliver->km);
	
}

foreach($managers as $manager){
	$manager->calc_slr($stores[$manager->store],0);
	
}

// print_r($managers);
$myfile = fopen("Μισθοδοσία_".$month."-".$year.".xml", "w") or die("Unable to open file!");
$xml = new SimpleXMLElement('<xml/>');

$header = $xml->addChild('header');
$transaction=$header->addChild('transaction');
$period = $transaction->addChild('period');
$period->addAttribute('month',$month);
$period->addAttribute('year',$year);
$body = $xml->addChild('body');
$employees = $body->addChild('employees');

foreach($managers as $manager) {
	$track = $employees->addChild('employee');
	$track->addChild('firstname', $manager->fname);
	$track->addChild('lastname', $manager->lname);
	$track->addChild('amka', $manager->amka);
	$track->addChild('afm', $manager->afm);
	$track->addChild('iban', $manager->iban);
	$track->addChild('ammount', $manager->salary);
}

foreach($delivers as $deliver) {
	$track = $employees->addChild('employee');
	$track->addChild('firstname', $deliver->fname);
	$track->addChild('lastname', $deliver->lname);
	$track->addChild('amka', $deliver->amka);
	$track->addChild('afm', $deliver->afm);
	$track->addChild('iban', $deliver->iban);
	$track->addChild('ammount', $deliver->salary);
}
Header('Content-type: text/xml');
fwrite($myfile,$xml->asXML());
fclose($myfile);
print($xml->asXML());

?>