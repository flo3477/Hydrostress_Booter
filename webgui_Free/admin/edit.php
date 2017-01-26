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
if (!isset($_GET['id']))
{
	die('No ID Selected');
}
$id = $_GET['id'];
$SQLGetInfo = $odb -> prepare("SELECT * FROM `users` WHERE `ID` = :id LIMIT 1");
$SQLGetInfo -> execute(array(':id' => $_GET['id']));
$userInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
$username = $userInfo['username'];
$password = $userInfo['password'];
$email = $userInfo['email'];
$rank = $userInfo['rank'];
$membership = $userInfo['membership'];
$status = $userInfo['status'];
include("header.php");
?>
<div class="content-block" role="main">



            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Users
                        <small>Manage Users</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Members</li>
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
	   if (isset($_POST['rBtn']))
	   {
		$sql = $odb -> prepare("DELETE FROM `users` WHERE `ID` = :id");
		$sql -> execute(array(':id' => $id));
		echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>User has been removed redirecting in 2...</p></div><meta http-equiv="REFRESH" content="2;url=users.php">';
	   }
	   if (isset($_POST['updateBtn']))
	   {
		$update = false;
		$errors = array();
		if ($username!= $_POST['username'])
		{
			if (ctype_alnum($_POST['username']) && strlen($_POST['username']) >= 4 && strlen($_POST['username']) <= 15)
			{
				$SQL = $odb -> prepare("UPDATE `users` SET `username` = :username WHERE `ID` = :id");
				$SQL -> execute(array(':username' => $_POST['username'], ':id' => $id));
				$update = true;
				$username = $_POST['username'];
			}
			else
			{
				$errors[] = 'Username has to be 4-15 characters in length and alphanumeric';
			}
		}
		if (!empty($_POST['password']))
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `password` = :password WHERE `ID` = :id");
			$SQL -> execute(array(':password' => SHA1($_POST['password']), ':id' => $id));
			$update = true;
			$password = SHA1($_POST['password']);
		}
		if ($email != $_POST['email'])
		{
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			{
				$SQL = $odb -> prepare("UPDATE `users` SET `email` = :email WHERE `ID` = :id");
				$SQL -> execute(array(':email' => $_POST['email'], ':id' => $id));
				$update = true;
				$email = $_POST['email'];
			}
			else
			{
				$errors[] = 'Email is invalid';
			}
		}
		if ($rank != $_POST['rank'])
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `rank` = :rank WHERE `ID` = :id");
			$SQL -> execute(array(':rank' => $_POST['rank'], ':id' => $id));
			$update = true;
			$rank = $_POST['rank'];
		}
		if ($membership != $_POST['plan'])
		{
			if ($_POST['plan'] == 0)
			{
				$SQL = $odb -> prepare("UPDATE `users` SET `expire` = '0', `membership` = '0' WHERE `ID` = :id");
				$SQL -> execute(array(':id' => $id));
				$update = true;
				$membership = $_POST['plan'];
			}
			else
			{
				$getPlanInfo = $odb -> prepare("SELECT `unit`,`length` FROM `plans` WHERE `ID` = :plan");
				$getPlanInfo -> execute(array(':plan' => $_POST['plan']));
				$plan = $getPlanInfo -> fetch(PDO::FETCH_ASSOC);
				$unit = $plan['unit'];
				$length = $plan['length'];
				$newExpire = strtotime("+{$length} {$unit}");
				$updateSQL = $odb -> prepare("UPDATE `users` SET `expire` = :expire, `membership` = :plan WHERE `id` = :id");
				$updateSQL -> execute(array(':expire' => $newExpire, ':plan' => $_POST['plan'], ':id' => $id));
				$update = true;
				$membership = $_POST['plan'];
			}
		}
		if ($status != $_POST['status'] || $status != $_POST['banReason'])
		{
			$SQL = $odb -> prepare("UPDATE `users` SET `status` = :status WHERE `ID` = :id");
			if($_POST['status'] != "0")
			{
				$SQL -> execute(array(':status' => $_POST['banReason'], ':id' => $id));
			} else {
				$SQL -> execute(array(':status' => $_POST['status'], ':id' => $id));

			}
			$update = true;
			$status = ($_POST['status'] != "0" ? $_POST['banReason'] : $status);
		}
		if ($update == true)
		{
			echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Updated</p></div>';
		}
		else
		{
			echo '<div class="nNote nWarning hideit"><p><strong>UPDATE: </strong>Nothing updated</p></div>';
		}
		if (!empty($errors))
		{
			echo '<div class="alert alert-success"><p><strong>ERROR:</strong><br />';
			foreach($errors as $error)
			{
				echo '-'.$error.'<br />';
			}
			echo '</div>';
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
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">Manage User</h3>
<br>
<br>
<br>
<center>
        <form action="" method="POST">
            <fieldset>
                    <div class="control-group">
                        <label>Username:</label>
                        <div class="formRight"><input type="text" style="width:250px; text-align:center;  height:40px" name="username" value="<?php echo htmlentities($username);?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="control-group">
                        <label>Password:</label>
                        <div class="formRight"><input type="password" style="width:250px; text-align:center;  height:40px" name="password" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="control-group">
                        <label>Email:</label>
                        <div class="formRight"><input type="text" style="width:250px; text-align:center;  height:40px" name="email" value="<?php echo htmlentities($email);?>" /></div>
                        <div class="clear"></div>
                    </div>
                    <div class="control-group">
                        <label>Rank:</label>
                        <div class="formRight">
                            <select  style="width:250px; text-align:center;  height:40px" name="rank" >
							<?php
							function selectedR($check, $rank)
							{
								if ($check == $rank)
								{
									return 'selected="selected"';
								}
							}
							?>
                                <option value="0" <?php echo selectedR(0, $rank); ?> >User</option>
                                <option value="1" <?php echo selectedR(1, $rank); ?> >Staff</option>
                                <option value="2" <?php echo selectedR(2, $rank); ?> >Admin</option>
                            </select>   
							</div>
                        <div class="clear"></div>
                    </div>
                    <div class="control-group">
                        <label>Membership:</label>
                        <div class="formRight">
                            <select  style="width:250px; text-align:center;  height:40px" name="plan" >
							<option value="0">No Membership</option>
							<?php 
								$SQLGetMembership = $odb -> query("SELECT * FROM `plans`");
								while($memberships = $SQLGetMembership -> fetch(PDO::FETCH_ASSOC))
								{
									$mi = $memberships['ID'];
									$mn = $memberships['name'];
									$selectedM = ($mi == $membership) ? 'selected="selected"' : '';
									echo '<option value="'.$mi.'" '.$selectedM.'>'.$mn.'</option>';
								}
							?>
                            </select>   
							</div>
                        <div class="clear"></div>
                    </div>
                    <div class="control-group">
                        <label>Status:</label>
                        <div style="width:250px; text-align:center;  height:40px"  class="formRight">
                            <select style="width:250px; text-align:center;  height:40px"  name="status" >
							<?php
							function selectedS($check, $rank)
							{
								if ($check == $rank)
								{
									return 'selected="selected"';
								}
							}
							?>
                                <option value="0" <?php echo selectedS(0, $status); ?>>Active</option>
                                <option value="1" <?php echo ($status != "0" ? "selected=\"selected\"" : ""); ?>>Banned</option>
                            </select>
							<br />
							<input type="text" style="width:250px; text-align:center;  height:40px"  name="banReason" id="banReason" value="<?php echo ($status != "0" ? $status : ""); ?>" placeholder="Ban Reason..." />
							</div>
                        <div class="clear"></div>
                    </div>
<br>
<br>
<br>
					<div class="control-group">
						<input type="submit" value="Update!" name="updateBtn" class="btn btn-info" />
						<form action="" method="post"><input type="submit" value="Remove User" name="rBtn" class="btn btn-danger" /></form>
						 <div class="clear"></div>
                    </div>
            </fieldset>
		</form>
				</form></fieldset></center>
				</div>
			
                 </div></div> 



        </div>
    </div>
</div>
                </div>
            </div>
							
					
		
		<!-- Scripts -->
		<script src="js/navigation.js"></script>
	
		<!-- Bootstrap scripts -->
		<!--
		<script src="js/bootstrap/bootstrap-tooltip.js"></script>
		<script src="js/bootstrap/bootstrap-dropdown.js"></script>
		<script src="js/bootstrap/bootstrap-button.js"></script>
		<script src="js/bootstrap/bootstrap-alert.js"></script>
		<script src="js/bootstrap/bootstrap-popover.js"></script>
		<script src="js/bootstrap/bootstrap-collapse.js"></script>
		<script src="js/bootstrap/bootstrap-transition.js"></script>
		-->
		<script src="js/bootstrap/bootstrap.js"></script>
	
		<!-- Block TODO list -->
		<script>
			$(document).ready(function() {
				
				$('.todo-block input[type="checkbox"]').click(function(){
					$(this).closest('tr').toggleClass('done');
				});
				$('.todo-block input[type="checkbox"]:checked').closest('tr').addClass('done');
				
			});
		</script>
		
		
		<!-- jQuery Visualize -->
		<!--[if lte IE 8]>
			<script language="javascript" type="text/javascript" src="js/plugins/visualize/excanvas.js"></script>
		<![endif]-->
		<script src="js/plugins/visualize/jquery.visualize.min.js"></script>
		<script src="js/plugins/visualize/jquery.visualize.tooltip.min.js"></script>
		
		<script>
			$(document).ready(function() {
			
				$('table.demo').each(function() {
					var chartType = ''; // Set chart type
					var chartWidth = $(this).parent().width()*0.95; // Set chart width to 90% of its parent
					
					if(chartWidth < 350) {
						var chartHeight = chartWidth;
					}else{
						var chartHeight = chartWidth*0.25;
					}
					
					$(this).hide().visualize({
						type: $(this).attr('data-chart'),
						width: chartWidth,
						height: chartHeight,
						colors: ['#3a87ad','#b94a48', '#468847']
					});
				});
			
			});
		</script>
		
		<!-- jQuery SparkLines -->
		<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
		
		
		
	</body>
</html>