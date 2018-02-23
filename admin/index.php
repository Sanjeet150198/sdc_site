<?php include ("../classes/Controller.php");
$obj=new Controller;
$obj->stop_access_login();
?>
<?php 
$err_email=$err_pwd="";
if($_SERVER['REQUEST_METHOD']=="POST"){
		$email=$obj->cleaner($_POST["email"]);
		$pwd=$obj->cleaner($_POST["pwd"]);
		
		
			
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$err_email="Enter correct User Id";
			}
			
		if(strlen($pwd)<6 || strlen($pwd)>15){
			$err_pwd="Passowrd should be of 6 to 15 characters";
			}	
			
		if(empty($err_email) && empty($err_pwd)){
				$result=$obj->login($email,$pwd,"admin");
				if($result!==false){
					$obj->token_genrate($result);
					}
				else{
						echo '<div class="alert alert-warning">
                   		<span><b>Please Fill Correctly!</b></span>
                        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
					}
				}
		else{echo '<div class="alert alert-danger">
                   		<span>Something Error!</span>
                        <a href="index.php" class="close" data-dismiss="alert">&times;</a>
                   </div>';
			}	
				
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin Login</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/jquery/jquery-3.2.0.min.js"></script>
</head>

<body>
	<div class="container">
        <div class="row">
        	<div class="col-sm-6 col-sm-offset-3">
            <div class="well">
            <h3>Admin Login</h3>
	            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post">
                	<div class="form-group has-success">
                    	<input type="email" class="form-control" name="email" placeholder="Username (example@domain.com)">
                        <span class="err" style="color:#FF0004; font-size:15px; font-weight:400;"><?= $err_email?></span>
                    </div>
                    <div class="form-group has-success">
                    	<input type="password" class="form-control" name="pwd" placeholder="Enter Password">
                        <span class="err" style="color:#FF0004; font-size:15px; font-weight:400;"><?= $err_pwd?></span>
                    </div>
                    <div class="form-group has-success">
                    	<input type="submit" value="Login" class="btn btn-primary">
                        <button type="submit" class="btn btn-primary"><a href="signup.php" style="color:#fff; display:block;"><span class="glyphicon glyphicon-send"> </span>  SignUp !</a></button>
                    </div>
                </form>
                </div>
            </div>
        </div>    
    </div>
</body>
</html>