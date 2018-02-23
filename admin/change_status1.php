<?php 

if(!isset($_GET['status']) || empty($_GET['status']) || !isset($_GET['id']) || empty($_GET['id'])){
	die("something error");
	}
require_once("../classes/Controller.php");
$cobj=new Controller;
$cobj->login_check();

$decode_id=base64_decode($_GET['id']);
if($_GET['status']==1){
	if($cobj->update_status("projects",'0',$decode_id)){
		 echo '<div class="alert alert-success">
							<span><b>Changed to Completed Project!</b></span>
							<a href="view_projects.php" class="close" data-dismiss="alert">&times;</a>
					   </div>';
		}
		else{
			  echo "Something error";
			}
}
else{		  echo '<div class="alert alert-danger">
                   		<span><b>Error!</b></span>
                        <a href="view_projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
	}
?>