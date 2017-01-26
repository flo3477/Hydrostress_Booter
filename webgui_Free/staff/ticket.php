<?php
ob_start();
require_once '../includes/db.php';
require_once '../includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: ../login.php');
	die();
}
if (!($user->isAdmin($odb)))
{
	header('unset.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: ../login.php');
	die();
}
$page = "Ticket";
$id = ($_GET['id']);
if(is_numeric($id) == false) {
echo "lol";
exit;

}
?>			
		
			
					
				<?php
ob_start();
require_once '../includes/db.php';
require_once '../includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: /logbackin.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: /login.php');
	die();
}
$page = "Ticket";
$id = ($_GET['id']);
if(is_numeric($id) == false) {
echo "lol";
exit;
}
include("header.php");
?>


          

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Ticket Center
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Ticket Center</li>
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
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>Ticket Status:</b> 
<?
	   $SQLGetTickets = $odb -> query("SELECT * FROM `tickets` WHERE `id` = $id");
	   while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
	   {
		$username = $getInfo['username'];
		$subject = $getInfo['subject'];
		$status = $getInfo['status'];
		$original = $getInfo['content'];
		}
	   if (isset($_POST['closeBtn']))
	   {
$SQLupdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
$SQLupdate -> execute(array(':status' => 'Closed', ':id' => $id));
echo '<div class="alert alert-warning"><p><strong><font color="black">SUCCESS: </font></strong><font color="black">Ticket has been closed.  Redirecting....</font></p></div><meta http-equiv="refresh" content="3;url=ticketcenter.php">';
 	   }
	   if (isset($_POST['updateBtn']))
	   {
	   	$updatecontent = $_POST['content'];

			$errors = array();
			if (empty($updatecontent))
			{
				$errors[] = 'Fill in all fields';
			}
			if (empty($errors))
			{
				$SQLinsert = $odb -> prepare("INSERT INTO `messages` VALUES(NULL, :ticketid, :content, :sender)");
				$SQLinsert -> execute(array(':sender' => 'Admin: ', ':content' => $updatecontent, ':ticketid' => $id));
			{
				$SQLUpdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
				$SQLUpdate -> execute(array(':status' => 'Waiting for user response', ':id' => $id));
				echo '<div class="alert alert-success"><p><strong><font color="black">SUCCESS: </font></strong><font color="black">Ticket has been updated.  Redirecting....</font></p></div><meta http-equiv="refresh" content="3;url=ticketcenter.php">';
			}
			}
			else
			{
				echo '<div class="nNote nFailure hideit"><p><strong>ERROR:</strong><br />';
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
                            <div class="box box-warning">
                                <div class="box-header">
                                    <i class="fa fa-ticket"></i>
                                    <h3 class="box-title">Ticket Center</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				

<div class="message">
													<span class="arrow"></span>
													<a href="#" class="name"><?php echo $username; ?></a>
													<span class="body">
													<?php echo htmlspecialchars($original); ?>
													</span>
												</div>
											</li>
	<?php 
			$SQLGetMessages = $odb -> prepare("SELECT * FROM `messages` WHERE `ticketid` = :ticketid ORDER BY `messageid` ASC");
			$SQLGetMessages -> execute(array(':ticketid' => $id));
			while ($getInfo = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC))
			{
				$sender = $getInfo['sender'];
				$content = $getInfo['content'];
				if ($sender != "Admin") { $li = "in"; } else { $li = "out"; }
				echo '<li class="'.$li.'"><div class="message"><span class="arrow"></span><a href="#" class="name">'.$sender.'</a><span class="body">'.htmlspecialchars($content).'</span></div></li>';
			}
			?>
										</ul>
									</div>
									<div class="chat-form">
<form action="" method="POST">
<div class="control-group">
										<div class="input-cont"> 
<center>  
<br>
											<input class="m-wrap" style="width:420px; text-align:center; height:30px"  type="text" name="content" placeholder="Type a message here..." />
										</div>
</center>
										<div class="btn-cont"> 
											<span class="arrow"></span>
<br>
<div class="control-group">
<center>
											<input type="submit" name="updateBtn" class="btn btn-primary" value="Send"/>
<input type="submit" align="right" name="closeBtn" class="btn btn-danger" value="Close Ticket" /></h4></form>
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
            
      
	
<br>
<br>
<br>				
                   

 
    </body>
</html>