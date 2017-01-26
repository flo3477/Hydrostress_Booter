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
                        Core application settings 
                        <small>Change Settings</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Core application settings</li>
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
				if (isset($_POST['changeBtn']))
		                {

$paypalemail = $_POST['EmailChange'];
$Header = $_POST['HeaderChange'];
$Tab = $_POST['TabChange'];
$Email = $_POST['nemailChange'];
$Website = $_POST['WebsiteChange'];

                		        $paypalemail = $_POST['EmailChange'];
                        		$errors = array();
                        		if (empty($paypalemail))
                        		{
                        		        $errors[] = 'Please verify all fields';
                        		}
                        		if (empty($errors))
                        		{
 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `Header` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $Header));

 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `Tab` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $Tab));

 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `nemail` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $Email));

 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `sitename` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $Website));



                        		        $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `email` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $paypalemail));
                        		        echo '<p class="alert alert-success">Settings have been updated !</p>';
                        		}
                        		else
                        		{
                        		        echo '<p class="alert alert-danger">Please fill in all fields</p>';
                        		}
                		}
				?>

<?php
				if (isset($_POST['nchangeBtn']))
		                {

$nHeader = $_POST['nheaderChange'];
$Subject = $_POST['subjectChange'];
$nEmail = $_POST['nnemailChange'];

                		        $paypalemail = $_POST['EmailChange'];
                        		$errors = array();
                        		if (empty($paypalemail))
                        		{
                        		        $errors[] = 'Please verify all fields';
                        		}
                        		if (empty($errors))
                        		{
 $SQLinsert = $odb -> prepare("UPDATE `forgotconfig` SET `Header` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $nHeader));

 $SQLinsert = $odb -> prepare("UPDATE `forgotconfig` SET `Subject` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $Subject));

 $SQLinsert = $odb -> prepare("UPDATE `forgotconfig` SET `email` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $nEmail));
                        		        echo '<p class="alert alert-success">Reset Password settings have been updated !</p>';
                        		}
                        		else
                        		{
                        		        echo '<p class="alert alert-danger">Please fill in all fields</p>';
                        		}
                		}
				?>

<?php 
		if (isset($_POST['ForgotBtn']))
		{
			$SQL = $odb -> query("TRUNCATE `forgotlogs`");
			echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Forgot Logs have been cleared</p></div>';
		}
		?>
<?php 
		if (isset($_POST['LoginBtn']))
		{
			$SQL = $odb -> query("TRUNCATE `loginlogs`");
			echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Login Logs have been cleared</p></div>';
		}
		?>
<?php 
		if (isset($_POST['AttackBtn']))
		{
			$SQL = $odb -> query("TRUNCATE `logs`");
			echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Attack Logs have been cleared</p></div>';
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
<center>
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-cogs"></i>
                                    <h3 class="box-title">Core application settings</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				

<form class="form-horizontal themed" method="post" />
    												<fieldset>
                                                     <div class="row-fluid">
                        		<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-1">
									    <header>
									        <button class="btn btn-danger" id="loginBtn" name="AttackBtn" type="submit"><span class="fa fa-bar-chart-o"></span> Clear Attack Logs</button> 
<button class="btn btn-warning" id="loginBtn" name="LoginBtn" type="submit"><span class="fa fa-bar-chart-o"></span> Clear Login Logs</button>     
<button class="btn btn-info" id="loginBtn" name="ForgotBtn" type="submit"><span class="fa fa-bar-chart-o"></span> Clear Forgot Password Logs</button>  
<br>
<br>
            
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<form class="form-horizontal themed" method="post" />
    												<fieldset>
                                                    <div class="control-group">
    														<label class="control-label" for="input01">Header</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" name="HeaderChange" value="<?php echo $odb->query("SELECT `Header` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" type="text" placeholder="Header Name Example: Horizon Stresser"/>
<br>
<br>
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">The window's page title</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" class="simple_field"  value="<?php echo $odb->query("SELECT `Tab` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" name="TabChange" type="text" placeholder="Tab Name Example: Horizon Stresser"/>
<br>
<br>
                                                 
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">Paypal Email</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `email` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="EmailChange" placeholder="Paypal Email"/>
                                                            </div>
													</div>

<br>
                                          
												
														</div>
<label class="control-label" for="input01">This Email Will Show when they have an error</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `nemail` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="nemailChange" placeholder="Email Address"/>
                                                            </div>
													</div>

<br>
                                                   
														</div>
<label class="control-label" for="input01">Enter Your Website Must Be The Exact Same Like This = http://yoursitename.com/</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `sitename` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="WebsiteChange" placeholder="Email Address"/>
                                                            </div>
<br>
              
													</div>
<div class="form-actions">
															<input type="submit" name="changeBtn" value="Update" class="btn btn-primary" />
<br>
<title> Reset Password Config </title>
<div class="control-group">
 <header>
									        <h2>Reset Password Core</h2>                           
									    </header>
        													<label class="control-label" for="input01">Message To Receive The email from</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `email` FROM `forgotconfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="nnemailChange" placeholder="Email Address"/>
                                                            </div>
													</div>
<div class="control-group">
        													<label class="control-label" for="input01">Subject Of The Message</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `Subject` FROM `forgotconfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="subjectChange" placeholder="Your New Password"/>
                                                            </div>
</div>
<div class="control-group">
        													<label class="control-label" for="input01">Header of The Message</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `Header` FROM `forgotconfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="nheaderChange" placeholder="Example Horizon Stresser"/>
                                                            </div>
<br>
<div class="form-actions">
															<input type="submit" name="nchangeBtn" value="Update" class="btn btn-primary" />
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
                                   
					
                              
			</div>
		</div>
      
    </body>
</html>