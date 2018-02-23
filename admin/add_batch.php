<?php require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>

<?php 
$bt_err="";
if($_SERVER['REQUEST_METHOD']=="POST"){
$batch_nm=$obj->cleaner($_POST['bt']);

if(empty($batch_nm)){$bt_err="*enter batch";}

if(empty($bt_err)){
	if($obj->project_exits("batch",$batch_nm)){
				if($obj->bind_insert("batch",array("",$batch_nm))){
					echo '<div class="alert alert-success">
                   		<span><b>Added Successfully!</b></span>
                        <a href="add_student.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
				}
				}
			else{
				$bt_err="Batch already exists";
				 echo '<div class="alert alert-warning">
                   		<span><b>Already Exist!</b></span>
                        <a href="add_student.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
				}
	
	}
	
}

?>