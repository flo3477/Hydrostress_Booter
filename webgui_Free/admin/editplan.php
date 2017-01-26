<?php
ob_start();
require_once '../includes/db.php';
require_once '../includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: ../login.php');
	die();
}
if (!($user -> isAdmin($odb)))
{
	die('You are not admin');
}
if (!($user -> notBanned($odb)))
{
	header('location: login.php');
	die();
}
if (!isset($_GET['id']))
{
	die('Please input an ID');
}
$SQLGetInfo = $odb -> prepare("SELECT * FROM `plans` WHERE `ID` = :id LIMIT 1");
$SQLGetInfo -> execute(array(':id' => $_GET['id']));
$planInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
$currentName = $planInfo['name'];
$currentDescription = $planInfo['description'];
$currentMbt = $planInfo['mbt'];
$currentUnit = $planInfo['unit'];
$currentPrice = $planInfo['price'];
$currentLength = $planInfo['length'];
function selectedUnit($check, $currentUnit)
{
	if ($currentUnit == $check)
	{
		return 'selected="selected"';
	}
}
include("header.php");
?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Plans
                        <small>Manage Plan</small>
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
				if (isset($_POST['updateBtn']))
				{
					$updateName = $_POST['nameAdd'];
					$updateDescription = $_POST['descriptionAdd'];
					$updateUnit = $_POST['unit'];
					$updateLength = $_POST['lengthAdd'];
					$updateMbt = intval($_POST['mbt']);
					$updatePrice = floatval($_POST['price']);
					$errors = array();
					
					if (empty($updatePrice) || empty($updateName) || empty($updateDescription) || empty($updateUnit) || empty($updateLength) || empty($updateMbt))
					{
						echo '<div class="g_12"><div class="error iDialog">Please fill in all fields</div></div>';
					}
					else
					{
						$SQLinsert = $odb -> prepare("UPDATE `plans` SET `name` = :name, `description` = :description, `mbt` = :mbt, `unit` = :unit, `length` = :length, `price` = :price WHERE `ID` = :id");
						$SQLinsert -> execute(array(':name' => $updateName, ':description' => $updateDescription, ':mbt' => $updateMbt, ':unit' => $updateUnit, ':length' => $updateLength, ':price' => $updatePrice, ':id' => $_GET['id']));
						echo '<div class="g_12"><div class="success iDialog">Plan has been updated</div></div>';
						$currentName = $updateName;
						$currentDescription = $updateDescription;
						$currentUnit = $updateUnit;
						$currentMbt = $updateMbt;
						$currentPrice = $updatePrice;
						$currentLength = $updateLength;
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
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-bars"></i>
                                    <h3 class="box-title">Manage Plan</h3>
<br>
<br>
<br>
<center>
				<div class="g_12">
					<div class="widget_contents noPadding">
					<form action="" method="POST">
						<div class="line_grid">
							<div class="g_3"><span class="label label-danger">Plan Name</span></div>
							<div class="g_9">
								<input style="width:250px; text-align:center;  height:40px" class="simple_field" name="nameAdd" maxlength="50" value="<?php echo htmlentities($currentName);?>" type="text"/>
							</div>
						</div>
						<div class="line_grid">
							<div class="g_3"><span class="label label-danger">Description</span></div>
							<div class="g_9">
								<textarea style="width:250px; text-align:center;  height:40px" class="simple_field" name="descriptionAdd" style="resize:none;"><?php echo htmlentities($currentDescription);?></textarea>
							</div>
						</div>
						<div class="line_grid">
							<div class="g_3"><span class="label label-danger">Max Boot Time</span></div>
							<div class="g_9">
								<input style="width:250px; text-align:center;  height:40px" class="simple_field" name="mbt" type="text" value="<?php echo htmlentities($currentMbt);?>"/>
							</div>
						</div>
						<div class="line_grid">
							<div class="g_3"><span class="label label-danger">Unit</span>
							</div>
							<div class="g_9">
								<select style="width:250px; text-align:center;  height:40px" class="simple_form" name="unit">
									 <option value="Days" <?php echo selectedUnit('Days',$currentUnit); ?> >Days</option>
                                <option value="Weeks" <?php echo selectedUnit('Weeks', $currentUnit); ?> >Weeks</option>
                                <option value="Months" <?php echo selectedUnit('Months', $currentUnit); ?> >Months</option>
                                <option value="Years" <?php echo selectedUnit('Years', $currentUnit); ?> >Years</option>
								</select>
							</div>
						</div>
						<div class="line_grid">
							<div class="g_3"><span class="label label-danger">Length</span></div>
							<div class="g_9">
								<input style="width:250px; text-align:center;  height:40px" class="simple_field" name="lengthAdd" type="text" value="<?php echo htmlentities($currentLength);?>"/>
							</div>
						</div>
						<div class="line_grid">
							<div class="g_3"><span class="label label-danger">Price</span></div>
							<div class="g_9">
								<input style="width:250px; text-align:center;  height:40px" class="simple_field" name="price" type="text" value="<?php echo htmlentities($currentPrice);?>"/>
							</div>
						</div>
<br>
						<div class="line_grid">
							<div class="g_9">
								<button  type="submit" name="updateBtn" class="btn btn-info">Update</button>
<button type="submit" name="rBtn" class="btn btn-danger">Remove Plan</button>
							</div>
						</div>
						</form>
					</div>
				</div>
			</div>
		</div>
</body>
</html>