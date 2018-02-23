<?php include ("../classes/Controller.php");
$obj=new Controller;
$obj->login_check();
?>

<?php include ("header.php");?>

<div class="clear"></div>

	<div class="container-fluid">
<h1 align="center" style="font-family:lobster; font-variant:small-caps;">Students In SDC</h1>
<div class="col-md-3">
<a href="add_student.php" style="font-size:18px; font-weight:500;">Click Here </a><font style="font-size:18px; font-weight:500;">to add student</font><hr></div>
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
                                <th>Image</th>
                                <th>Course</th>
                                <th>Email Id</th>
                                <th>Year</th>
                                <th>Profile Link</th>
                                <th>Action</th>                                     
                               </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $result=$obj->fetch_all_data("students");
                            if(isset($result)){
                            $i=1;
                            foreach($result as $row){?>
                                <tr>
                                    <td><?=$i++?></td>
                                    <td><?=$row->name?></td>
                                    <td><img src="../assets/uploads/<?= $row->image?>" width="40px" height="40px" class="img-responsive"></td>
                                    <td><?=$row->course?></td>
                                    <td><?=$row->email?></td>
                                    <td><?=$row->year?></td>
                                    <td><a href="<?= $row->link?>" target="new"><?=$row->name?></a></td>
                                    <td align="left"><a href="edit_profile.php?id=<?php echo base64_encode($row->id)?>">Edit</a> | <a href="delete_user.php?id=<?php echo base64_encode($row->id)?>">delete</a>
      </td>
                                </tr>
                             <?php }}else{?>
                                 <tr>
                                    <th colspan="8">Data not available !!!</th>
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