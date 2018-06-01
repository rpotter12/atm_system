<?php

$card=$_POST['card'];
$pin=$_POST['pin'];


if (!empty($card) || !empty($pin) )
{

$host="localhost";
$dbUsername ="root";
$dbPassword ="";
$dbname="atm";

$conn = new mysqli($host , $dbUsername , $dbPassword , $dbname);

if(mysqli_connect_error())
{

die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());

}else
{

$SELECT ="SELECT card From atm where card = ? Limit 1";
$SELECT= "SELECT pin From atm where pin = ? Limit 1";
$INSERT ="INSERT Into atm(card,pin) values(?,?)";

$stmt =$conn->prepare($SELECT);
$stmt->bind_param("i",$card);
$stmt->bind_param("i",$pin);
$stmt->execute();
$stmt->bind_result($card);
$stmt->bind_result($pin);
$stmt->store_result();
$rnum =$stmt->num_rows;

if($rnum!=0)
{
	$stmt->close();
	$stmt=$conn->prepare($INSERT);
	$stmt->bind_param("ii",$card,$pin);
	$stmt->execute();
include 'options.html';
	//echo "<font size='18' face='Arial' color='darkblue'><center><br><br><br><br>Thanks We Will Contact You Shortly</center>";
}else
{

	echo "<font size='18' face='Arial' color='red'><center><br><br><br><br>No Account Found & Invalid Pin</center>";
}
$stmt->close();
$conn->close();

}

}else
{

echo "All Fields are Required";
die();

}

?>
