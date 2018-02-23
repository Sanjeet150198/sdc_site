<?php 
if(!isset($_GET['id']) || empty($_GET['id'])){
	die("Programe error try<br><a href='students_sdc.php'>try again</a>");
	}
	
require_once("../classes/Controller.php");
$cobj=new Controller;
$cobj->login_check();
	
$decode_id=base64_decode($_GET['id']);	
$cobj->delete_user('students',$decode_id);
?>