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
	header('unset.php');
	die();
}
include("header.php");
?>

	 
				 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        IP Address To Skype 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">IP Address To Skype </li>
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
if (isset($_POST['registerBtn']))
{
	
						

$message = $_POST['message'];
$Subject = $_POST['Subject'];
$name3 = $odb -> query("SELECT `email` FROM `users` LIMIT 1") -> fetchColumn(0);

$from = $_POST["from"]; // sender
$subject = "$Subject";
$message = $message = "Hello This Is A Daily News Letter From Horizon Stresser


$message




Thank You!";
// message lines should not exceed 70 characters (PHP rule), so wrap it
$message = wordwrap($message, 70);
// send mail
mail($name3, $subject, $message, "From: Horizon Stresser<horiizonstresser@gmail.com>\n
Horizon Stresser/" . phpversion());


echo '<div class="alert alert-success"><center><p><font color=\'black\'>Sent Successfully A Copy of This Was Sent To Your Email. Redirecting....</font></p></center></div><meta http-equiv="refresh" content="3;url=index.php">';
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
                                    <i class="fa fa-sitemap"></i>
                                    <h3 class="box-title">Resolve</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				
<div class="control-group">
				<p></p>
					<div class="form-group">
					<input id="username" style="width:480px; text-align:center; height:30px" type="text" name="Subject" placeholder="Subject" "/>
				</div>
					<div class="form-group">

<span  class="add-on"><i class="awe-comment  icon-green"></i></span><textarea name="message" cols="55" rows="8" class="inputbox" placeholder="Message" style="height: 100px; width: 480px;"></textarea>


					</select>

					<br><br>
					 <div class="box-footer clearfix">
                                    <button class="pull-right btn btn-info" id="registerBtn" name="registerBtn" type="submit">Send <i class="fa fa-arrow-circle-right"></i></button>
                                </div>
               
</div>
<br>
				</form></fieldset></center>
				</div>
			
                 </div></div> 



        </div>
    </div>
</div>
                </div>
            </div>
							
				
		
		
		
	</body>
</html>