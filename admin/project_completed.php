<?php require_once("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
$result=$obj->fetch_project("projects",0);
?>

<?php include("header.php");?>
<!--<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">-->
<div class="clear"></div>

<div class="container-fluid">
<h1 align="center" style="font-family:lobster; font-size:36px; font-variant:small-caps;">Projects Completed</h1>
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
                                <!--<th>Image</th>-->
                             	<th>Students</th>
                                <th>Project Url</th>
                             	<th>Action</th>
                             </tr>
                            </thead>
                            <tbody>
                            <?php 
                            
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->name?></td>
                                    <!--<td><img src="../assets/project upload/<?= $row->image?>" width="40px" height="40px" class="img-responsive"></td>-->
                                    <td><?=$row->students?></td>
                                    <td><a target="new" href="<?=$row->url?>"><?=$row->name?></a></td>
                                    <td><a href="edit_project.php">Edit</a> | <a href="delete_project.php">Delete</a></td>
                                </tr>
                             <?php }}else{?>
                                 <tr>
                                    <th colspan="6">Data not available !!!</th>
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