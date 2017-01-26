<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: login.php');
	die();
}
if (!($user->hasMembership($odb)))
{
	header('location: nomembership.php');
	die();                           
    
}
if (!($user -> notBanned($odb)))
{
	header('location: login.php');
	die();
}
include("header.php");
?>


          

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Friends And Enemies
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Friends And Enemies</li>
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
					$ipAdd = $_POST['ipAdd'];
					$noteAdd = $_POST['noteAdd'];
					$type = $_POST['type'];
					if (empty($ipAdd) || empty($type))
					{
						echo '<div class="alert alert-danger">Please fill in all fields</div>';
					}
					else
					{
						if (!filter_var($ipAdd, FILTER_VALIDATE_IP))
						{
							echo '<div class="alert alert-danger">IP is invalid</div>';
						}
						else
						{
							$SQLinsert = $odb -> prepare("INSERT INTO `fe` VALUES(NULL, :userID, :type, :ip, :note)");
							$SQLinsert -> execute(array(':userID' => $_SESSION['ID'], ':type' => $type, ':ip' => $ipAdd, ':note' => $noteAdd));
							echo '<div class="alert alert-success">IP has been added</div>';
						}
					}
				}
				?>

<?php
						if (isset($_POST['deleteBtn']))
						{
							$deletes = $_POST['id'];
							if (!empty($deletes))
							{
									$SQL = $odb -> prepare("DELETE FROM `fe` WHERE `ID` = :id AND `userID` = :uid LIMIT 1");
									$SQL -> execute(array(':id' => $deletes, ':uid' => $_SESSION['ID']));
								echo '<div class="alert alert-success">IP(s) Have been removed</div>';
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
                                    <i class="fa fa-heart"></i>
                                    <h3 class="box-title">Friends And Enemies</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				

<form class="form-horizontal themed" method="post" />
    												<fieldset>
                                                     <div class="row-fluid">
                        		<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-1">
									    
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<form class="form-horizontal themed" method="post" />
    												<fieldset>
                                                    <div class="control-group">
    														<label class="control-label" for="input01">IP Address</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" name="ipAdd" maxlength="15" placeholder="127.0.0.1" type="text"/>
                                                            </div>
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">Note</label>
															<div class="controls">
																<textarea class="simple_field" name="noteAdd" style="width:400px; text-align:center; height:80px"></textarea>
                                                            </div>
													</div>
													</div>
 <div class="control-group">
        													<label class="control-label" for="input01">Type</label>
															<div class="controls">
																<select  style="width:250px; text-align:center; height:30px" class="simple_field" name="type">
                                									<option value="f" selected="selected" />Friend
                                									<option value="e" />Enemy
                                								</select>
                                                            </div>
													</div>
<br>
                                                    <div class="form-actions">
															<input type="submit" name="addBtn" value="Add" class="btn btn-primary" />
														</div>
                                                   
                                                        
                                                    </fieldset>
        										</form>
										    </div>
										    <!-- end content-->
									    </div>
									    <!-- end wrap div -->
									</div>
									<!-- end widget -->
								</article>
                               
						</div>
                                
                
		
				<div class="row-fluid">
    							<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-1">
									    <header>
									        <h2>IP Info</h2>                           
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<table class="table table-bordered" id="s-table-bordered">
								<thead>
									<tr>
                                        <th>Delete</th>
									    <th>IP</th>
										<th>Type</th>
										<th>Note</th>
									</tr>
								</thead>
								<tbody>
									<?php
									  $SQLSelect = $odb -> prepare("SELECT * FROM `fe` WHERE `userID` = :user ORDER BY `ID` DESC");
									  $SQLSelect -> execute(array(':user' => $_SESSION['ID']));
									  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
									  {
										$ipShow = $show['ip'];
										$noteShow = $show['note'];
										$rowID = $show['ID'];
										$type = ($show['type'] == 'f') ? 'Friend' : 'Enemy';
										echo '<tr><td><form method="post"><button class="btn btn-danger btn-mini" name="deleteBtn"><i class="fa fa-trash-o"></i></button><input type="hidden" name="id" value="'.$rowID.'" /></form></td><td>'.$ipShow.'</td><td>'.$type.'</td><td>'.htmlentities($noteShow).'</td></tr>';
									  }
									  ?>							
</form></fieldset></center>
							
					


                                                        
                                                    </fieldset>
        										</form>
										    </div>
										    <!-- end content-->
									    </div>
									    <!-- end wrap div -->
									</div>
									<!-- end widget -->
								</article>
                               
						</div>
			
			</div>
		</div>
      
    </body>
</html>