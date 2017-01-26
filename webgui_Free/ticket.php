<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
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
echo "ID Does Not Exist";
exit;
}
include("header.php");
?>


          

         <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header no-margin">
                    <h1 class="text-center">
                      <?php
	   $SQLGetTickets = $odb -> query("SELECT * FROM `tickets` WHERE `id` = $id");
	   while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
	   {
		$username = $getInfo['username'];
		$subject = $getInfo['subject'];
		$status = $getInfo['status'];
		$original = $getInfo['content'];
		}
if ($username != $_SESSION['username']) {
echo "Invalid ticket ID!";
exit;
}
if ($status == "Closed") {
echo '<span class="label label-danger">Ticket Is Closed</span>';
exit;
}
	   if (isset($_POST['closeBtn']))
	   {
$SQLupdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
$SQLupdate -> execute(array(':status' => 'Closed', ':id' => $id));
echo '<div class="alert alert-success"><p><strong><font color="black">SUCCESS: </font></strong><font color="black">Ticket has been closed.  Redirecting....</font></p></div><meta http-equiv="refresh" content="3;url=support.php">';
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
			$SQLinsert -> execute(array(':sender' => $_SESSION['username'], ':content' => $updatecontent, ':ticketid' => $id));
			{
				$SQLUpdate = $odb -> prepare("UPDATE `tickets` SET `status` = :status WHERE `id` = :id");
				$SQLUpdate -> execute(array(':status' => 'Waiting for admin response', ':id' => $id));
				echo '<div class="alert alert-success"><p><strong><font color="black">SUCCESS: </font></strong><font color="black">Ticket has been updated.  Redirecting....</font></p></div><meta http-equiv="refresh" content="3;url=support.php">';
			}
			}
			else
			{
				echo '<div class="alert alert-error"><p><strong>ERROR:</strong><br />';
				foreach($errors as $error)
				{
					echo '-'.$error.'<br />';
				}
				echo '</div>';
			}
		}
?>
                   </h1>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- MAILBOX BEGIN -->
                    <div class="mailbox row">
                        <div class="col-xs-12">
                            <div class="box box-solid">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-4">
                                            <!-- BOXES are complex enough to move the .box-header around.
                                                 This is an example of having the box header within the box body -->
                                            <div class="box-header">
                                                <i class="fa fa-inbox"></i>
                                                <h3 class="box-title">INBOX</h3>
                                            </div>
                                            <!-- compose message btn -->
                                            <a class="btn btn-block btn-primary" data-toggle="modal" data-target="#compose-modal"><i class="fa fa-pencil"></i> Compose Ticket</a>
                                            <!-- Navigation - folders-->
<form action="" method="post">
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Folders</li>
                                                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox (<?php echo $stats -> totalusertickets($odb, $_SESSION['username']); ?>)</a></li>
                                                    <li class=""><a > <button type="submit" style="width:200px; height:41px" value="Login" name='closeBtn' class="btn btn-danger"><i class="fa fa-unlink"></i>  Close Ticket</button></form></li>
                                            
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                             
                                                     <!-- Chat box -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-comments-o"></i> Chat</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">

                                        <div class="btn-group" data-toggle="btn-toggle" >
<form action="" method="POST">
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>                                            
                                            <button type="submit" name="closeBtn" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="box-body chat" id="chat-box">
                                    <!-- chat item -->
<p><blockquote><?php echo htmlspecialchars($original); ?></p>
														
														<small><i><?php echo $username; ?></li>	</i><br></small></blockquote>
<?php 
			$SQLGetMessages = $odb -> prepare("SELECT * FROM `messages` WHERE `ticketid` = :ticketid ORDER BY `messageid` ASC");
			$SQLGetMessages -> execute(array(':ticketid' => $id));
			while ($getInfo = $SQLGetMessages -> fetch(PDO::FETCH_ASSOC))
			{
				$sender = $getInfo['sender'];
				$content = $getInfo['content'];
				if ($sender != "Admin") { $li = "in"; } else { $li = "out"; }
                                  echo  '<div class="item">
                                        <img src="img/avatar5.png" alt="user image" class="online"/>
                                        <p class="message">
                                            <a href="" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
                                                '.$sender.'
                                            </a>
                                           '.htmlspecialchars($content).'
                                        </p>';
                                       }
			?>
                                   
                                    </div><!-- /.item -->
                                </div><!-- /.chat -->
<form action="" method="POST">
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input name="content" class="form-control" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button name="updateBtn" class="btn btn-success"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box (chat box) -->
             

      

      
          
    </body>
</html>