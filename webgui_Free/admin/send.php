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
if (isset($_POST['SendBtn']))
{

 $name3 = $odb -> query("SELECT `sitename` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
$name1 = $odb -> query("SELECT `email` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
$username = $_POST['username'];
$email = $_POST['email'];
$message1 = $_POST['message'];
$Subject = $_POST['Subject'];
                 

    $subject = "Important Message";

  $to   = "huzoorbux@gmail.com";
  $from = $odb -> query("SELECT `nemail` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
 
  $headers = "From: " . strip_tags($from) . "\r\n";
  $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
  $headers .= "CC: info@phpgang.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
 
$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';
 
$message .= "<tr><td><img src='http://hit4life.tk/horizon.png' alt='PHP Gang' /></td></tr>";
 
$message .= "<tr><td colspan=2>Hello $username, Important Message From The Admin.<br /><br />
<br>
$message1
<br>
<br>
<br>
This is an automated response, please do not reply!</td></tr>";

 
$message .= "<tr><td colspan=2 font='colr:#999999;'><I>$name3<br>Have A Good Day :D</I></td></tr>";
 
$message .= "</table>";
 
$message .= "</body></html>";
    
    // now lets send the email.
mail($email, $subject, $message, $headers);

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
                                    <i class="fa fa-user"></i>
                                    <h3 class="box-title">Manage User</h3>
<br>
<br>
<br>
<center>
        <form action="" method="POST">
            <fieldset>
                    <div class="control-group">
                        <label>Receiver Email:</label>
                        <div class="formRight"><input type="text" style="width:400px; text-align:center;  height:40px" name="email" value="<?php echo htmlentities($email);?>" /></div>
                        <div class="clear"></div>
                    </div>
<br>
<div class="control-group">
                        <label>Receiver Username:</label>
                        <div class="formRight"><input type="text" style="width:400px; text-align:center;  height:40px" name="username" value="<?php echo htmlentities($username);?>" /></div>
                        <div class="clear"></div>
                    </div>
<br>
<div class="control-group">
                        <label>Subject:</label>
                        <div class="formRight"><input type="text" style="width:400px; text-align:center;  height:40px" name="Subject" /></div>
                        <div class="clear"></div>
                    </div>
<div class="control-group">
                    <span  class="add-on"><i class="awe-comment  icon-green"></i></span><textarea name="message" cols="55" rows="8" class="inputbox" placeholder="Message" style="height: 100px; width: 400px;"></textarea>
</div>
					<div class="control-group">
						<input type="submit" value="Update!" name="SendBtn" class="btn btn-info" />
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