<?php require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>

<?php include ("header.php");?>
<?php
$name_err=$course_err=$year_err=$img_err=$email_err=$link_err=$bt_err="";
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
	$course=$obj->cleaner($_POST['course']);
	$email=$obj->cleaner($_POST['email']);
	$fl=$_FILES["data"]["name"];
	$year=$obj->cleaner($_POST['year']);
	$batch=$obj->cleaner($_POST['batch']);
	$link=$obj->cleaner($_POST['link']);
	
	
	if($error>0){
		die("something error");
		}
	else{
		$path="../assets/uploads/".$fl;
		if(file_exists($path)){
			echo "<script>alert('image already exists')</script>"; 
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
				}
				else
				{echo "file type error occurred<br>";
				return false;}
			}
	}
		if(!preg_match("/^[a-z A-Z]+$/",$name)){
				$name_err= "*only alphabetic letters allowed";
		}
		/*if(!preg_match("/^[a-z A-Z][0-9]+$/",$year)){
			    $year_err="write as an example";
			}*/
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$email_err="Enter correct Email Id";
		 }
		//insert data
		if(empty($name_err) && empty($img_err) && empty($email_err) && empty($course_err) && empty($year_err) && empty($link_err)){
			if($obj->user_existance("students",$email)){
				if($obj->bind_insert("students",array("",$name,$fl,$course,$year,$email,$batch,$link))){
					echo '<div class="alert alert-success">
                   		<span><b>Added Successfully!</b></span>
                        <a href="add_student.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
				}
				}
			else{
				$email_err="User already exists";
				 echo '<div class="alert alert-warning">
                   		<span><b>Already Exist!</b></span>
                        <a href="add_student.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
				}	
			}
	
}
?>

<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">
<div class="clear"></div>
<br>
<div class="container-fluid">

    <!--Add Student-->
    <div class="row">
        <div class="col-md-6" style="margin-left:2% !important;">
       
            <form method="post" role="form" autocomplete="off" action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" enctype="multipart/form-data">
             
             <div class="form-header">
                <h3 class="form-title"><i class="fa fa-user-plus"></i> Add Student</h3><hr>
             </div>
                      
             <div class="form-body">
                                 
                  <div class="form-group">
                       <div class="input-group">
                       <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                      <input name="name" type="text" class="form-control" required placeholder="Student Name">
                       </div>
                       <span class="help-block" id="error" style="color:#FF0004;"><?= $name_err?></span>
                  </div>
                            
                  <div class="form-group">
                       <div class="input-group">
                       <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                       <input name="email" type="email" class="form-control" required placeholder="Student Email-Id(example@domain.com)">
                       </div> 
                       <span class="help-block" id="error" style="color:#FF0004;"><?= $email_err?></span>                     
                  </div>
                  
                  <div class="form-group">
                       <div class="input-group">
                       <div class="input-group-addon"><span class="glyphicon glyphicon-certificate"></span></div>
                       <input name="course" type="text" required class="form-control" placeholder="Course Name">
                       </div> 
                       <span class="help-block" id="error" style="color:#FF0004;"><?= $course_err?></span>                     
                  </div>
                  
                  <div class="form-group">
                  <label for="data">Upload Image:</label>
                       <div class="input-group">
                       <div class="input-group-addon"><span class="glyphicon glyphicon-picture"></span></div>
                       <input name="data" type="file" required class="form-control">
                       </div> 
                       <span class="help-block" id="error" style="color:#FF0004;"><?= $img_err?></span>                     
                  </div> 
                  
                  <div class="form-group">
                       <div class="input-group">
                       <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                       <input name="year" type="text" required class="form-control" placeholder="Year eg.(1st Year)">
                       </div> 
                       <span class="help-block" id="error" style="color:#FF0004;"><?= $year_err?></span>                     
                  </div>
                  
                  <div class="form-group">
                       <div class="input-group">
                       <div class="input-group-addon"><span class="glyphicon glyphicon-link"></span></div>
                       <input name="link" type="url" required class="form-control" placeholder="Enter student profile url">
                       </div> 
                       <span class="help-block" id="error" style="color:#FF0004;"><?= $link_err?></span>                     
                  </div>
                  
                  <div class="form-group">
                    <label for="batch">Select Batch:</label>
                   <select class="form-control" name="batch">
                  <?php $res=$obj->fetch_data("batch",array("id","name"));
                            if(isset($res)){
                                foreach($res as $row){?>
                       <option value="<?= $row->id?>"><?=$row->name?></option>
                      <?php } }?> 
                       </select>           
                  </div>                       
                            
                </div>
                
                <div class="form-footer">
                     <button type="submit" class="btn btn-info">
                     <span class="glyphicon glyphicon-send"> </span> Submit
                     </button>
                </div>
    
    
                </form>
        </div>

    <!--/Add Student-->
    
    <!--Add New Batch-->
    	<div class="col-md-5" style="margin-left:3% !important;">
    
	            <form action="add_batch.php" method="post" role="form" autocomplete="off" enctype="multipart/form-data">
                   <div class="form-header">
                        <h3 class="form-title"><i class="fa fa-plus"></i> Add New Batch</h3><hr>
                    </div>
                              
                     <div class="form-body">
                                         
                          <div class="form-group">
                             <div class="input-group">
                               <div class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></div>
                              <input type="tel" maxlength="4" required class="form-control" name="bt" placeholder="Enter New Batch">
                               </div>
                               <span class="help-block" id="error" style="color:#FF0004;"><?= $bt_err?></span>
                          </div>
                    	
                    </div>
                    <div class="form-footer">
                         <button type="submit" class="btn btn-info">
                         <span class="glyphicon glyphicon-send"> </span> Submit
                         </button>
                    </div>
                </form>
         </div>
	</div>
</div>
<div class="clear"></div>
<?php include ("footer.php");?>