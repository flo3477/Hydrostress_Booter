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
                        Charge Backs
                        <small>Add or Manage</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Charge Backs</li>
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
					$usernameAdd = $_POST['usernameAdd'];
					$ipaddressAdd = $_POST['ipaddressAdd'];
                                        $skypeAdd = $_POST['skypeAdd'];
                                        $emailAdd = $_POST['emailAdd'];
					$addressAdd = $_POST['addressAdd'];
					if (!empty($usernameAdd) && !empty($skypeAdd))
					{
						$SQLinsert = $odb -> prepare("INSERT INTO `chargebacks` VALUES(NULL, :username, :ip, :skype, :email, :address, UNIX_TIMESTAMP())");
						$SQLinsert -> execute(array(':username' => $usernameAdd, ':ip' => $ipaddressAdd, ':skype' => $skypeAdd, ':email' => $emailAdd, ':address' => $addressAdd));
						echo '<div class="alert alert-success">ChargeBack has been posted</div>';
					}
					else
					{
						echo '<div class="alert alert-danger">Please fill in all fields</div>';
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
                                    <i class="fa fa-male"></i>
                                    <h3 class="box-title">Post New ChargeBacks</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				

				<input style="width:400px; text-align:center;  height:30px" name="usernameAdd" placeholder="Username"  maxlength="40" type="text" />
<br>
<br>
				<input style="width:400px; text-align:center;  height:30px" name="ipaddressAdd" placeholder="IP Address"  maxlength="30" type="text" />
<br>
<br>	
				<input style="width:400px; text-align:center;  height:30px" name="skypeAdd" placeholder="Skype Username"  maxlength="50" type="text" />
<br>
<br>	
				<input style="width:400px; text-align:center;  height:30px" name="emailAdd" placeholder="Email Address"  maxlength="300" type="text" />
<br>
<br>	
									<textarea class="simple_field" placeholder="Home Address" name="addressAdd" style="width:400px; text-align:center;  height:40px"></textarea>
<br>
<br>					
		

					<div class="control-group">
						<div class="controls">

                    <br> <button class="btn btn-info" name="addBtn" type="submit"><i class="fa fa-bullhorn"></i> Add</button></form>
</div>
<br>
				</form></fieldset></center>
				</div>
			
                 </div></div> 



        </div>


			
		
				

				<div class="content-block" role="main">
				
				
				<!-- Grid row -->
				<div class="row-fluid">

		<center><br><br><br>
<center><fieldset>
					
       
                                           

		<?php
						if (isset($_POST['deleteBtn']))
						{
							$deletes = $_POST['id'];
							
								$SQL = $odb -> prepare("DELETE FROM `chargebacks` WHERE `ID` = :id LIMIT 1");
								$SQL -> execute(array(':id' => $deletes));
							echo '<div class="alert alert-success">New(s) Have been removed</div>';
						}
						?>
				    <div class="row-fluid">
    							<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-1">
									    <header>
									        <h2>News</h2>                           
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<table class="table table-bordered" id="s-table-bordered">
								<thead>
									<tr>
										<th>
											Delete
										</th>
										<th>Username</th>
										<th>IP Address</th>
	<th>Skype</th>
	<th>Email</th>
	<th>Address</th>
									</tr>
								</thead>
								<tbody>
								<?php
								  $SQLSelect = $odb -> query("SELECT * FROM `chargebacks` ORDER BY `id` DESC");
								  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
								  {
									$uShow = $show['username'];
									$iShow = $show['ip'];
                                                                        $sShow = $show['skype'];
                                                                        $eShow = $show['email'];
									$aShow = $show['address'];
									$rowID = $show['ID'];
									echo '<tr><td><form method="post"><button class="btn btn-danger " name="deleteBtn"><i class="fa fa-trash-o"></i></button><input type="hidden" name="id" value="'.$rowID.'" /></form></td><td>'.htmlentities($uShow).'</td><td>'.htmlentities($iShow).'</td><td>'.htmlentities($sShow).'</td><td>'.htmlentities($eShow).'</td><td>'.htmlentities($aShow).'</td></tr>';
								  }
								  ?>
								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>

		
	</body>
</html>