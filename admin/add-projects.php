<?php require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>
<?php 
$err_name="";
if($_SERVER['REQUEST_METHOD']=="POST")
   {     
	$name=$obj->cleaner($_POST['name']);
	//$duration=$obj->clean($_POST['duration']);
	//$amount=$obj->clean($_POST['amount']);
	if(!preg_match("/^[a-z A-Z]+$/",$name)){
				$err_name= "*only alphabetic letters allowed";
		}
	   
	if(empty($err_name)){
	if($obj->project_exits('projects',$name)){
		if($obj->bind_insert("projects",array("",$name,'','','','2'))){
					
					echo '<div class="alert alert-success">
                   		<span><b>Project Added Successfully!</b></span>
                        <a href="add-projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
					//header("Location:add-projects.php");
				}
	}
	else{
		 echo '<div class="alert alert-warning">
                   		<span><b>Project Already Exist!</b></span>
                        <a href="add-projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
	   	 }		
	}
	else
	{ echo '<div class="alert alert-warning">
                   		<span><b>Please Fill Correctly!</b></span>
                        <a href="add-projects.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
		}
}

?>

<?php include ("header.php");?>

<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">
<div class="clear"></div>

<div class="container-fluid">
        <div class="row">
        <br>
        <div class="col-md-2" style="margin-left:3%;">
         <a href="view_projects.php"><font size="+1" color="#0075C0"><strong>View Projects</strong></font></a><hr></div>
        <div class="col-md-2" style="margin-left:3%;">
         <a href="projects_progress.php"><font size="+1" color="#0075C0"><strong>Active Projects</strong></font></a><hr></div>
        <div class="col-md-2" style="margin-left:3%;">
          <a href="project_completed.php"><font size="+1" color="#0075C0"><strong>Completed Projects</strong></font></a><hr></div>
        <div class="col-md-2" style="margin-left:3%;">
          <a href="projects_upcoming.php"><font size="+1" color="#0075C0"><strong>Upcoming Projects</strong></font></a><hr></div>
          
        	<div class="col-md-5" style="margin-top:15px; margin-left:25px;">
            <h3>Add Project</h3>
            <hr>
	            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                	<div class="form-group">
                    	<input type="text" class="form-control" name="name" placeholder="Enter Project Name">
                        <span class="has-error" style="color:#FF0004; font-size:15px; font-weight:400;"><?= $err_name?></span>
                    </div>
                    <div class="form-group has-success">
                    	<input type="submit" class="btn btn-primary">
                    </div>
                </form>
                </div>
            </div>
        </div>    
    </div>
<div class="clear"></div>
<?php include ("footer.php");?>