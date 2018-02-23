<?php 
if(!isset($_GET['id']) || empty($_GET['id'])){
	die("Programme error try<br><a href='view_projects.php'>try again</a>");
	}
	
require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
$decode_id=base64_decode($_GET['id']);
$name_err=$stu_err=$img_err=$url_err="";
 /*update coading*/
if($_SERVER['REQUEST_METHOD']=="POST"){ 
		
/*	$type=$_FILES["data"]['type'];
	$position=strpos($type,"/")+1;
	$tot_len=strlen($type);
	$rem_len=$tot_len-($position);
	$clean_type=substr($type,$position,$rem_len);
	
	$error=$_FILES["data"]['error'];
	$size=$_FILES["data"]['size'];
	$tmp=$_FILES["data"]['tmp_name'];
	
	$fl=$_FILES["data"]["name"];
	if($error>0){
		die('<div class="alert alert-danger">
                   		<span><b>Something Error!</b></span>
                        <a href="view_projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>');
		}
	else{
		$path="../assets/project upload/".$fl;
		if(file_exists($path)){
			$img_err="image already exists"; 
			}
			else{
				if($clean_type=="png" || $clean_type=="jpg" || $clean_type=="jpeg"){
					//if($size<(1024*500)){
		if(move_uploaded_file($tmp,$path)){
			echo "file uploaded scuccessfully";
			}
				//}
				/*else{
					echo "file size below 100KB";
					return false;
					}*/
				/*}
				else
				{echo "file type error occurred<br>";
				return false;}
			}
	}*/
		
		
		$name=$obj->cleaner($_POST['name']);
		$students=$obj->cleaner($_POST['stu']);
		$url=$obj->cleaner($_POST['url']);
		$status=$obj->cleaner($_POST['stat']);
		if($obj->update("projects",array("name"=>$name,"students"=>$students,"url"=>$url,"status"=>$status),array("id"=>$decode_id))){
			echo '<div class="alert alert-success">
                   		<span><b>Project edited Successfully!</b></span>
                        <a href="view_projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
			}
		else{
			  echo '<div class="alert alert-warning">
                   		<span><b>Something Error!</b></span>
                        <a href="add-projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
			}

  }
?>

  <?php include ("header.php");?>

<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">
<div class="clear"></div>
<br>
<div class="col-md-6" style="margin-left:5%;">
	<div class="row">
    	<form method="post" role="form" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
         
         <div class="form-header">
         	<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span> Edit Project</h3><hr>
         </div>
                  
         <div class="form-body">
                  <?php 
				    $result=$obj->fetch("projects",array("name","students","url","status"),$decode_id);
				  foreach($result as $row){ ?>        
         	  <div class="form-group">
              <label for="name">Project Name</label>
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-product-hunt"></i></div>
                  <input name="name" type="text" class="form-control" required value="<?= $row->name?>" placeholder="Project Name">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $name_err?></span>
              </div>
              
              <!--<div class="form-group">
              <label for="data">Project Image</label>
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-image"></i></div>
                   <input name="data" type="file" class="form-control" value="<?= $row->image?>" placeholder="Image">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $img_err?></span>                     
              </div>-->
                        
              <div class="form-group">
              <label for="stu">Students Involved</label>
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-users"></i></div>
                   <input name="stu" type="text" class="form-control" value="<?= $row->students?>" placeholder="Students Involved">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $stu_err?></span>                     
              </div>
              
              <div class="form-group">
              <label for="url">Project URL</label>
                   <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-link"></i></div>
                   <input name="url" type="url" class="form-control" required value="<?= $row->url?>" placeholder="Project URL">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $url_err?></span>                     
              </div>
              
              <div class="form-group">
              <label for="stat">New Status</label>
                    <div class="input-group">
                   <div class="input-group-addon"><i class="fa fa-toggle-down"></i></div>
                   	   <select name="stat" class="form-control">
                         <option selected value="<?= $row->status?>"><?= $row->status?></option>   
					     <option value="0">0</option>
                         <option value="1">1</option>
                         <option value="2">2</option>
                       </select>
                    </div>
                   <span class="help-block" id="error" style="color:#FF0004;"></span>
              </div>                    
                   <?php } ?>    
            </div>
            
            <div class="form-footer">
                 <button type="submit" class="btn btn-info">
                 <span class="glyphicon glyphicon-send"> </span> Submit
                 </button>
            </div>


            </form>
    </div>
</div>
<div class="clear"></div>
<?php include ("footer.php");?>	