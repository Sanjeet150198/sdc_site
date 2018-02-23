<?php 
if(!isset($_GET['id']) || empty($_GET['id'])){
	die("Programe error try<br><a href='students_sdc.php'>try again</a>");
	}
	
require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
$decode_id=base64_decode($_GET['id']);

$name_err=$course_err=$year_err=$img_err=$email_err="";
if($_SERVER['REQUEST_METHOD']=="POST"){
	
	$type=$_FILES["data"]['type'];
	$position=strpos($type,"/")+1;
	$tot_len=strlen($type);
	$rem_len=$tot_len-($position);
	$clean_type=substr($type,$position,$rem_len);
	
	$error=$_FILES["data"]['error'];
	$size=$_FILES["data"]['size'];
	$tmp=$_FILES["data"]['tmp_name'];
	
	$name=$obj->cleaner($_POST['name']);
	$email=$obj->cleaner($_POST['email']);
	$course=$obj->cleaner($_POST['course']);
	$year=$obj->cleaner($_POST['year']);
	$fl=$_FILES["data"]["name"];
	if($error>0){
		die("something error");
		}
	else{
		$path="../assets/uploads/".$fl;
		if(file_exists($path)){
			$img_err="image already exists";
			}
			else{
				if($clean_type=="jpg" || $clean_type=="jpeg"){
					//if($size<(1024*500)){
		if(move_uploaded_file($tmp,$path)){
			echo "file uploaded scuccessfully";
			}
				//}
				/*else{
					echo "file size below 100KB";
					return false;
					}*/
				}
				else
				{$img_err="file type error occurred";
				return false;}
			}
	}
	
	if(!preg_match("/^[a-z A-Z]+$/",$name)){
				$name_err= "*only alphabetic letters allowed";
		}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$email_err="Enter correct Email Id";
			}
		//update data
		if(empty($name_err) && empty($img_err) && empty($email_err) && empty($course_err) && empty($year_err)){
		if($obj->update("students",array("name"=>$name,"image"=>$fl,"course"=>$course,"year"=>$year,"email"=>$email),array("id"=>$decode_id))){
			echo '<div class="alert alert-success">
                   		<span><b>Profile edited Successfully!</b></span>
                        <a href="students_sdc.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
			}
		else{
			  echo '<div class="alert alert-danger">
                   		<span><b>Something Error!</b></span>
                        <a href="edit_profile.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
			}
		}
	else{
		   echo '<div class="alert alert-warning">
                   		<span><b>Please Fill Correctly!</b></span>
                        <a href="edit_profile.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
		}

}
 
?>

  <?php include ("header.php");?>

<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">
<div class="clear"></div>
<div class="col-md-6" style="margin-left:5%;">
	<div class="row">
    	<form method="post" role="form" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
         
         <div class="form-header">
         	<h3 class="form-title"><span class="glyphicon glyphicon-pencil"></span> Edit Student Details</h3><hr>
         </div>
                  
         <div class="form-body">
                  <?php 
				    $result=$obj->fetch("students",array("name","image","course","email","year"),$decode_id);
				  foreach($result as $row){ ?>        
         	  <div class="form-group">
              <label for="name">Student Name</label>
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                  <input name="name" type="text" class="form-control" required value="<?= $row->name?>" placeholder="Student Name">
                   </div>
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $name_err?></span>
              </div>
                        
              <div class="form-group">
              <label for="course">Students course</label>
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-certificate"></span></div>
                   <input name="course" type="text" class="form-control" value="<?= $row->course?>" placeholder="Students course">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $course_err?></span>                     
              </div>

              <div class="form-group">
              <label for="email">Students Email-Id</label>
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                   <input name="email" type="email" class="form-control" value="<?= $row->email?>" placeholder="Students email id">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $email_err?></span>                     
              </div>
              
              <div class="form-group">
              <label for="data">Upload Image:</label>
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                   <input name="data" type="file" value="<?= $row->image?>" class="form-control">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $img_err?></span>                     
              </div> 
              
              <div class="form-group">
              <label for="year">Students year</label>
                   <div class="input-group">
                   <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                   <input name="year" type="text" class="form-control" value="<?= $row->year?>" placeholder="Students year">
                   </div> 
                   <span class="help-block" id="error" style="color:#FF0004;"><?= $year_err?></span>                     
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