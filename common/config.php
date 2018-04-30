<?php 
$conn = new mysqli("localhost","root","","pharmacy");
if($conn){
	
}else{
	die("Error, While connecting ".$conn->connect_erorr);
}

?>