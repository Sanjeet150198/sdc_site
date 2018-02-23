<?php require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();

?>

<?php include ("header.php");?>
<!--<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">-->
<div class="clear"></div>

<div class="container-fluid">
<h1 align="center" style="font-family:lobster; font-size:36px; font-variant:small-caps;">Projects UpComing</h1>
    <div id="result" style="margin-left:3%;">
        <div class="row">
        <!--result coding-->
        <div class="col-md-12 col-sm-12 table-responsive" style="border-radius:3%;">
         
            <!-- ... Your content goes here ... -->
                        <table class="display nowrap" id="example">
                            <thead>
                              <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Action</th>
                             </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $result=$obj->fetch_project("projects",2);
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->name?></td>
                                    <td><a href="edit_project.php">Edit</a> | <a href="delete_project.php">Delete</a> | <a href="change_status.php?status=2&id=<?php echo base64_encode($row->id)?>">Progress</a></td>
                                </tr>
                             <?php }}
							 else{?>
                                 <tr>
                                    <th colspan="3">Data not available !!!</th>
                                 </tr>
                                 <?php }?>   
                            </tbody>
                        </table>
            <!--/Content End--> 
        
        </div>
        <!--/result coding-->
        </div>
    </div> 
</div>
<div class="clear"></div>
<?php include ("footer.php");?>