<?php 
if(!isset($_GET['id']) || empty($_GET['id'])){
	die("Programe error try<br><a href='view_projects.php'>try again</a>");
	}
	
require_once("../classes/Controller.php");
$cobj=new Controller;
$cobj->login_check();
	
$decode_id=base64_decode($_GET['id']);	
$cobj->delete_project('projects',$decode_id);
?>