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
	header('location: ../login.php');
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
                <section class="content-header no-margin">
                    <h1 class="text-center">
                        ==(Ticket Center)== <?
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
$SQLupdate = $odb -> prepare("UPDATE `tickets` SET `stavtus` = :status WHERE `id` = :id");
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
                                            <div style="margin-top: 15px;">
                                                <ul class="nav nav-pills nav-stacked">
                                                    <li class="header">Folders</li>
                                                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox (<?php echo $stats -> totalusertickets($odb, $_SESSION['username']); ?>)</a></li>
                                                    <li><a href="#"><i name="closeBtn" class="fa fa-unlink"></i> Close Ticket</a></li>
  <li><a href="#"><i class="fa fa-pencil-square-o"></i> Drafts</a></li>
                                                    <li><a href="#"><i class="fa fa-mail-forward"></i> Sent</a></li>
                                                    <li><a href="#"><i class="fa fa-star"></i> Starred</a></li>
                                                    <li><a href="#"><i class="fa fa-folder"></i> Junk</a></li>
                                            
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
                                            <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i></button>                                            
                                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
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
                                        <img src="../img/avatar5.png" alt="user image" class="online"/>
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
             

        <!-- COMPOSE MESSAGE MODAL -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-envelope-o"></i> Compose New Ticket</h4>
                    </div>
                    <form action="" method="post">
                    <?php 
	   if (isset($_POST['updateBtn1']))
	  
			$subject = ($_POST['subject']);
			$content = ($_POST['content1']);
			$errors = array();
			if (empty($subject) || empty($content))
			{
				$errors[] = '';
			}
			if (empty($errors))
			{
				$SQLinsert = $odb -> prepare("INSERT INTO `tickets` VALUES(NULL, :subject, :content, :status, :username)");
				$SQLinsert -> execute(array(':subject' => $subject, ':content' => $content, ':status' => 'Waiting for admin response', ':username' => $_SESSION['username']));
				echo '<div class="alert alert-error"p><strong><font color="black">SUCCESS: </font></strong><font color="black">Ticket has been created.  Redirecting....</font></p></div><meta http-equiv="refresh" content="3;url=support.php">';
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
		
	
	   ?>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Subject:</span>
                                    <input name="subject" type="email" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <textarea name="content1" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
                            </div>
                            <div class="form-group">                                
                                <div class="btn btn-success btn-file">
                                    <i class="fa fa-paperclip"></i> Attachment
                                    <input type="file" name="attachment"/>
                                </div>
                                <p class="help-block">Max. 32MB</p>
                            </div>

                        </div>
                        <div class="modal-footer clearfix">

                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Discard</button>

                            <button type="submit" name="updateBtn1" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      
          
    </body>
</html>