<?php require_once("main-function.php");
$cobj=new mn;
//$cobj->identify();
?>

<?php include ("header.php");?>

<div class="main">
<?php 
$res=$cobj->fetch_active_project("projects");

if(!empty($res)){?>
<h1 align="center"><u>Active Project</u></h1>
<table border="1">
<tr>
<td>Project Name</td>
<td>Students Involved</td>
<td>Status</td>
</tr>

<?php 	foreach($res as $item){
	?>
	<tr>
    <td><?= $item->name?></td>
     <td><?=$item->students?></td>
      <td><a href="edit_project.php">Edit</a> | <a href="delete_project.php">delete</a> | <a href="change_status1.php?status=1&id=<?php echo base64_encode($item->id)?>">completed</a></td>
    </tr>
	<?php }?>
    </table>
<?php 	}
?>
</div>
<?php include ("footer.php");?>