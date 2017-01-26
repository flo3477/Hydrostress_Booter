<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: logbackin.php');
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
                        Profile
                        <small>Change Password or Email</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Profile</li>
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
                                      
                                      
 <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         <input class="btn btn-primary" type = "submit"/>
			<br>
			<br>
			Stats:
			<br>
			<br>
         <ul>
            <li class="btn btn-primary" disabled>Sent file: <?php echo $_FILES['image']['name'];  ?><br>
            <li class="btn btn-primary" disabled>File size: <?php echo $_FILES['image']['size'];  ?><br>
            <li class="btn btn-primary" disabled>File type: <?php echo $_FILES['image']['type'] ?><br>
         </ul>


			
      </form>
<?php 
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"images/".$_SESSION['username'].".gif");
         echo "Success";
      }else{
         print_r($errors);
      }
   }









		if (isset($_POST['updatePassBtn']))
		{
			$cpassword = $_POST['cpassword'];
			$npassword = $_POST['npassword'];
			$rpassword = $_POST['rpassword'];
			if (!empty($cpassword) && !empty($npassword) && !empty($rpassword))
			{
				if ($npassword == $rpassword)
				{
					$SQLCheckCurrent = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
					$SQLCheckCurrent -> execute(array(':username' => $_SESSION['username'], ':password' => SHA1($cpassword)));
					$countCurrent = $SQLCheckCurrent -> fetchColumn(0);
					if ($countCurrent == 1)
					{
						$SQLUpdate = $odb -> prepare("UPDATE `users` SET `password` = :password WHERE `username` = :username AND `ID` = :id");
						$SQLUpdate -> execute(array(':password' => SHA1($npassword),':username' => $_SESSION['username'], ':id' => $_SESSION['ID']));
				                               echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Password Has Been Updated</p></div>';
					}
					else
					{
						echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>Current Password is incorrect.</p></div>';
					}
				}
				else
				{
					echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>New Passwords Did Not Match.</p></div>';
				}
			}
			else
			{
				echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>Please fill in all fields</p></div>';
			}
		}
		?>
<?php 
		if (isset($_POST['updateEmailBtn']))
		{
			$cpassword = $_POST['cpassword'];
			$nemail = $_POST['nemail'];
			if (!empty($cpassword) && !empty($nemail))
			{
				if (filter_var($nemail, FILTER_VALIDATE_EMAIL))
				{
					$SQLCheckCurrent = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
					$SQLCheckCurrent -> execute(array(':username' => $_SESSION['username'], ':password' => SHA1($cpassword)));
					$countCurrent = $SQLCheckCurrent -> fetchColumn(0);
					if ($countCurrent == 1)
					{
						$SQLUpdate = $odb -> prepare("UPDATE `users` SET `email` = :email WHERE `username` = :username AND `ID` = :id");
						$SQLUpdate -> execute(array(':email' => $nemail,':username' => $_SESSION['username'], ':id' => $_SESSION['ID']));
						echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Email Has Been Updated</p></div>';
					}
					else
					{
						echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>Current Password is Incorrect.</p></div>';
					}
				}
				else
				{
					echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>Email is not valid</p></div>';
				}
			}
			else
			{
				echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>Please fill in all fields</p></div>';
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
                                    <i class="fa fa-cloud-upload"></i>
                                    <h3 class="box-title">Profile</h3>
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
									        <h2>Update Password</h2>                           
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<form class="form-horizontal themed" method="post" />
    												<fieldset>
                                                    <div class="control-group">
    														<label class="control-label" for="input01">Current Password</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" name="cpassword" type="password" placeholder="Current Password"/>
                                                            </div>
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">New Password</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" class="simple_field" name="npassword" type="password" placeholder="New Password"/>
                                                            </div>
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">Repeat Password</label>
															<div class="controls">
																<input  style="width:400px; text-align:center; height:30px" class="simple_field" type="password" name="rpassword" placeholder="Repeat New Password"/>
                                                            </div>
													</div>
<br>
                                                    <div class="form-actions">
															<input type="submit" name="updatePassBtn" value="Update" class="btn btn-primary" />
														</div>
</br>
                                                   
                                                        
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
									        <h2>Update Email</h2>                           
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<form class="form-horizontal themed" method="post" />
    												<fieldset>
                                                    <div class="control-group">
    														<label class="control-label" for="input01">Current Password</label>
															<div class="controls">
																<input style="width:400px; text-align:center; height:30px" class="simple_field" name="cpassword" type="password" placeholder="Current Password " />
                                                            </div>
													</div>
                                                     <div class="control-group">
        													<label class="control-label" for="input01">New Email</label>
															<div class="controls">
																<input style="width:400px; text-align:center; height:30px" type="text" placeholder="New Email" name="nemail"><br>
                                                            </div>
													</div>
<br>
                                                    
                                                    <div class="form-actions">
															<input type="submit" name="updateEmailBtn" value="Update" class="btn btn-primary" />
														</div>
</br>
                                                   
                                                        
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