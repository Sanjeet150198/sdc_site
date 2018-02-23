<?php require_once("../classes/Controller.php");
$obj=new Controller;

?>

<?php include ("header.php");?>
<style>
#result{ padding-top:50px; background-color:#fff;}
</style>
<link rel="stylesheet" type="text/css" href="../assets/css/style.css">
<!--<link rel="stylesheet" type="text/css" href="../assets/css/pannel.css">-->
<div class="clear"></div>

<div class="container">
<h1 align="center" style="font-family:lobster; font-size:36px; font-variant:small-caps;">Students In SDC</h1>
        <div class="row">
        <!--result coding-->
         
            <!-- ... Your content goes here ... -->
            			<?php $res=$obj->fetch_data("batch",array("id","name"));
						if(isset($res)){
							foreach($res as $row){?>
                            <div class="col-md-12">
                              <div class="panel-group" id="accordion">
                               <div class="panel panel-default">
                                    <div class="panel-heading"><h3><a data-toggle="collapse" data-parent="#accordion" href="#<?=$row->id?>">Batch <?=$row->name?></a></h3></div>
                                  <div id="<?=$row->id?>" class="panel-collapse collapse">
                                    <div class="panel-body">
                                    <?php $res=$obj->fetch_student("students",array("name","image","link"),$row->id);
						if(isset($res)){?>
                          <div class="row">
							<?php foreach($res as $srow){?>
                                <div class="col-md-3">
                                <div class="well img-responsive">
                                <img src="../assets/uploads/<?=$srow->image?>" class="img-responsive img-circle" style="width:200px !important; height:200px !important;">
                                <h3><?=$srow->name?></h3>
                                <h4><a href="<?= $srow->link?>" target="new">Profile Link</a></h4>
                                </div>
                                </div>
                    		
                            <?php }?> 
								</div>
							<?php }?>
                                    </div>
                                   </div>
                                </div>
                               </div>
                            </div>    
								<?php }
							}
						?>
                     
            <!--/Content End--> 
        
        <!--/result coding-->
        </div>
    </div> 

<?php include ("footer.php");?>