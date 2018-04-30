<?php
session_start();
if(! $_SESSION['current_user4'] && ! $_SESSION['u_id3']){
    header("location:../index.php");
    exit();
}
if(isset($_SESSION['current_user4']) && isset($_SESSION['u_id3'])){
    $user = $_SESSION['current_user4'];
    $user_id = $_SESSION['u_id3'];
}
include_once '../common/config.php'; 
$pa = isset($_GET['p']) ? $_GET['p']:'';

if($pa=="printrecipt"){

	$p_name=$_POST['pa_name'];
	$p_id=$_POST['pa_id'];
	echo $p_name."<br>".$p_id."<br>".$user;

}