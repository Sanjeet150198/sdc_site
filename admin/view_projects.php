<?php include ("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>

<?php include ("header.php");?>
<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">
<div class="clear"></div>

<div class="container-fluid">
<h1 align="center" style="font-family:lobster; font-variant:small-caps;">List Of Projects</h1>
<div class="col-md-3">
<a href="add-projects.php" style="font-size:18px; font-weight:500;">Click Here </a><font style="font-size:18px; font-weight:500;">to add project</font></div>
        <div class="col-md-4">
        	<font style="font-size:18px; font-weight:600; font-family:lobster;">Note:</font><br>
	<font style="font-family:lobster; font-size:17px; font-weight:500; color:#3878AC;">Status: 1-> In Progress | 2-> UpComing | 0->Completed</font>
        </div>
    <div id="result" style="margin-left:3%;">
        <div class="row">
        <!--result coding-->
        <div class="col-md-12 col-sm-12 table-responsive" style="border-radius:3%;">
         
            <!-- ... Your content goes here ... -->
                        <table class="display nowrap" id="example">
                            <thead>
                              <tr>
                                <th>S.No.</th>
                                <th>Project Name</th>
                                <!--<th>Image</th>-->
                                <th>Students Involved</th>
                                <th>Project Url</th>
                                <th>Status</th>
                                <th>Action</th>                                     
                               </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $result=$obj->fetch_all_data("projects");
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->name?></td>
                                    <!--<td><img src="../assets/project upload/<?= $row->image?>" width="50px" height="50px" class="img-responsive"></td>-->
                                    <td><?=$row->students?></td>
                                    <td><a target="new" href="<?=$row->url?>"><?=$row->name?></a></td>
                                    <td><?=$row->status?></td>
                                    <td><a href="edit_project.php?id=<?php echo base64_encode($row->id)?>">Edit</a> | <a href="delete_project.php?id=<?php echo base64_encode($row->id)?>">delete</a>
      </td>
                                </tr>
                             <?php }}else{?>
                                 <tr>
                                    <th colspan="7">Data not available !!!</th>
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