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
                        <small>Api Settings</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Api Settings</li>
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

$skype = $_POST['skypeChange'];
$ip2skype = $_POST['ip2skypeChange'];
$phone = $_POST['phoneChange'];
$gmail = $_POST['gmailChange'];


                		       
                        		$errors = array();
                        		if (empty($skype))
                        		{
                        		        $errors[] = 'Please verify all fields';
                        		}
                        		if (empty($errors))
                        		{
 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `skypeapi` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $skype));

 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `ip2skypeapi` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $ip2skype));

 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `phoneapi` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $phone));

 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `gmailapi` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $gmail));



                        		        
                        		        echo '<p class="alert alert-success">Settings have been updated !</p>';
                        		}
                        		else
                        		{
                        		        echo '<p class="alert alert-danger">Please fill in all fields</p>';
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
<center>
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-cogs"></i>
                                    <h3 class="box-title">Manage Api</h3>
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
    														<label class="control-label" for="input01">Skype Resolver Api</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" name="skypeChange" value="<?php echo $odb->query("SELECT `skypeapi` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" type="text" placeholder="http://resolveme.org/api.php?key=<APIKEY>&skypePseudo="/>
<br>
<br>
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">IP 2 SKYPE Api</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" class="simple_field"  value="<?php echo $odb->query("SELECT `ip2skypeapi` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" name="ip2skypeChange" type="text" placeholder="http://resolveme.org/api.php?key=<APIKEY>&skypePseudo="/>
<br>
<br>
                                                 
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">PhoneNumber Lookup Api</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `phoneapi` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="phoneChange" placeholder="PhoneNumber LookUp Api"/>
                                                            </div>
													</div>

<br>
                                          
												
														</div>
<label class="control-label" for="input01">Trick Gmail Generator Api </label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px"  value="<?php echo $odb->query("SELECT `gmailapi` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>" class="simple_field" type="text" name="gmailChange" placeholder="Gmail Generator Api"/>
                                                            </div>
													</div>

<br>
                                                   
													
<br>
              
													</div>
<div class="form-actions">
															<input type="submit" name="changeBtn" value="Update" class="btn btn-primary" />
<br>

                                                   
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