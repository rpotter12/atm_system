<?php
$servername="localhost";
$username="root";
$password="";
$dbname="atm";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
	die("connection failed" .$conn->connect_error);
}
$Enter_the_card_number=$_POST["Enter_the_card_number"];
$PIN=$_POST["PIN"];
$mysql="INSERT INTO home(Enter_the_card_number,PIN) VALUES($Enter_the_card_number,$PIN)";
$conn->query($mysql);
include 'options.html';
$conn->close();
?>
