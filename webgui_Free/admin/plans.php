<?php
ob_start();
require_once '../includes/db.php';
require_once '../includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: ../logbackin.php');
	die();
}
if (!($user->isAdmin($odb)))
{
	header('location: ../notadmin.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: ../unset.php');
	die();
}
include("header.php");
?>
				  <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Plans
                        <small>OverView</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Plans</li>
                    </ol>
                </section>
	
   <!-- Main content -->
                <section class="content">
                    <!-- START ALERTS AND CALLOUTS -->
 <h2 class="page-header">Alerts and Callouts</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-warning"></i>
                                    <h3 class="box-title">Alerts</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
 <div class="">
                                        <i class=""></i>
<?php
				if (isset($_POST['addBtn']))
				{
					$nameAdd = $_POST['nameAdd'];
					$descriptionAdd = $_POST['descriptionAdd'];
					$unitAdd = $_POST['unit'];
					$lengthAdd = $_POST['lengthAdd'];
					$mbtAdd = intval($_POST['mbt']);
					$priceAdd = floatval($_POST['price']);
					
					if (empty($priceAdd) || empty($nameAdd) || empty($descriptionAdd) || empty($unitAdd) || empty($lengthAdd) || empty($mbtAdd))
					{
						echo '<p class="error small">Please fill in all fields</p>';
					}
					else
					{
						$SQLinsert = $odb -> prepare("INSERT INTO `plans` VALUES(NULL, :name, :description, :mbt, :unit, :length, :price)");
						$SQLinsert -> execute(array(':name' => $nameAdd, ':description' => $descriptionAdd, ':mbt' => $mbtAdd, ':unit' => $unitAdd, ':length' => $lengthAdd, ':price' => $priceAdd));
						echo '<p class="success small">Plan has been created!</p>';
					}
				}
				?>

</center>
                                    </div>
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                       
                    <!-- END ALERTS AND CALLOUTS -->


<!-- Main content -->
                <section class="content">
                    <!-- START ALERTS AND CALLOUTS -->
   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-bars"></i>
                                    <h3 class="box-title">Create A Plan</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				
<input placeholder="Plan Name" style="width:210px; text-align:center;  height:30px" name="nameAdd" maxlength="50" type="text"/>
<br>
<br>
<textarea class="simple_field" placeholder="Description" name="descriptionAdd" style="width:210px; text-align:center;  height:30px"></textarea>
<br>
<br>
					<input style="width:210px; text-align:center;  height:30px" placeholder="Max Boot Time" name="mbt" type="text"/>
<br>
<br>					
		
					<select  style="width:210px; text-align:center;  height:30px" name="unit">
<option value="Days">Days</option>
									<option value="Weeks">Weeks</option>
									<option value="Months">Months</option>
									<option value="Years">Years</option>

					</select>
<br>
<br>					<input style="width:210px; text-align:center;  height:30px" placeholder="Length" name="lengthAdd" type="text"/>
<br>
<br>
				<input style="width:210px; text-align:center;  height:30px" placeholder="Price" name="price" type="text"/>
<br>

					<div class="control-group">
						<div class="controls">

                    <br> <button class="btn btn-info" name="addBtn" type="submit"><i class="icon-fire"></i> Create</button></form>
</div>
<br>
				</form></fieldset></center>
				</div>
			
                 </div></div> 



        </div>

				<div class="g_12 separator"><span></span></div>

<?php
if (isset($_POST['deleteBtn']))
{
$deletes = $_POST['id'];

$SQL = $odb -> prepare("DELETE FROM `plans` WHERE `ID` = :id LIMIT 1");
$SQL -> execute(array(':id' => $deletes));
echo '<div class="alert alert-success">New(s) Have been removed</div>';
}
?>

<form action="" class = "form" method="POST">
<div class="widget">
<br>
<div class="row-fluid">
<article class="span12">
<!-- new widget -->
<div class="jarviswidget" id="widget-id-1">
<header>
<h2>Plans</h2>
</header>
<!-- wrap div -->
<div>
<div class="inner-spacer">
<!-- content goes here -->
<table class="table table-bordered" id="s-table-bordered">
<thead>
<tr>
<tr>

</th>
<th>Delete</th>
<th>Title</th>
<th>Max Boot Time</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<?php
  $SQLSelect = $odb -> query("SELECT * FROM `plans` ORDER BY `price` ASC");
				  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))

{
$planName = $show['name'];
					$noteShow = $show['description'];
					$mbtShow = $show['mbt'];
					$rowID = $show['ID'];

echo '<tr><td><form method="post"><button class="btn btn-danger " name="deleteBtn"><i class="fa fa-trash-o"></i></button><input type="hidden" name="id" value="'.$rowID.'"/></td><td><center><a href="editplan.php?id='.$rowID.'">'.htmlentities($planName).'</a></center></td><td>'.$mbtShow.'</td><td>'.htmlentities($noteShow).'</td></tr>';
}
?>
</tbody>
</table>

</div>
</form>





</div>
</div>


</div>
</div>





</form></fieldset></center>



</body>
</html>