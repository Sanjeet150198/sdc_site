<?php require_once("../classes/Controller.php");
$obj=new Controller;
$result=$obj->fetch_project("projects",1);
?>

<?php include("header.php");?>
<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">
<div class="clear"></div>

<div class="container">
<h1 align="center" style="font-family:lobster; font-size:36px; font-variant:small-caps;">Projects In Progress</h1>
    <div id="result" style="margin-left:5%;">
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
                             	<th>Project Link</th>
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
                                </tr>
                             <?php }}else{?>
                                 <tr>
                                    <th colspan="4">Data not available !!!</th>
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