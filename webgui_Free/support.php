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
include("header.php");
?>


          

         <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header no-margin">
                    <h1 class="text-center">
                        Ticket Center                    </h1>
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
                                                    <li><a href="#"><i class="fa fa-star"></i> Read Ticket</a></li>
                                                    <li><a href="#"><i class="fa fa-star-o"></i> Unread Ticket</a></li>
                                                    <li><a href="#"><i class="fa fa-star-half-empty"></i> Closed</a></li>
                                                    <li><a href="#"><i class="fa fa-folder"></i> Junk</a></li>
                                                </ul>
                                            </div>
                                        </div><!-- /.col (LEFT) -->
                                        <div class="col-md-9 col-sm-8">
                                            <div class="row pad">
                                                <div class="col-sm-6">
                                                    <label style="margin-right: 10px;">
                                                        <input type="checkbox" id="check-all"/>
                                                    </label>
                                                    <!-- Action button -->
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-default btn-sm btn-flat dropdown-toggle" data-toggle="dropdown">
                                                            Action <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li><a href="#">Mark as read</a></li>
                                                            <li><a href="#">Mark as unread</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Move to junk</a></li>
                                                            <li class="divider"></li>
                                                            <li><a href="#">Delete</a></li>
                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-sm-6 search-form">
                                                    <form action="" class="text-right">
                                                        <div class="input-group">                                                            
                                                            <input type="text" class="form-control input-sm" placeholder="Search">
                                                            <div class="input-group-btn">
                                                                <button type="submit" name="id" class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>                                                     
                                                    </form>
                                                </div>
                                            </div><!-- /.row -->

                                            <div class="table-responsive">
                                                <!-- THE MESSAGES -->
                                                <table class="table table-mailbox">
                                                    <tr class="unread">
                                                <?php 
			$SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `username` = :username ORDER BY `id` DESC");
			$SQLGetTickets -> execute(array(':username' => $_SESSION['username']));
			while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['id'];
                                $user = $_SESSION['username'];
				$subject = $getInfo['subject'];
				$status = $getInfo['status'];

                                      	if ($status == "Closed") {
					$status1 = '<i class="fa fa-star-half-empty"></i>';
					} elseif ($status == "Waiting for admin response") {
					$status1 = '<i class="fa fa-star"></i>';
					} elseif ($status == "Waiting for user response") {
					$status1 = '<i class="fa fa-star-o"></i>';
			
					
					
					} else {
					$membership = 'Undefined';
					}
                                                   echo '<tr>
                                                        <td class="small-col"><input type="checkbox" /></td>
                                                        <td class="small-col">'.$status1.'</i></td>
                                                        <td class="name"><a href="ticket.php?id='.$id.'"> '.$user.' </a></td>
                                                        <td class="subject"><a href="ticket.php?id='.$id.'">'.htmlspecialchars($subject).'</a></td>
                                                        <td class="time"><span class="label label-warning">'.$status.'</span></td>
                                                    </tr>';
                                                    }
			?>
                                                </table>
                                            </div><!-- /.table-responsive -->
                                        </div><!-- /.col (RIGHT) -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-body -->
                                <div class="box-footer clearfix">
                                    <div class="pull-right">
                                        <small></small>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-left"></i></button>
                                        <button class="btn btn-xs btn-primary"><i class="fa fa-caret-right"></i></button>
                                    </div>
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col (MAIN) -->
                    </div>
                    <!-- MAILBOX END -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

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
	   if (isset($_POST['updateBtn']))
	  
			$subject = ($_POST['subject']);
			$content = ($_POST['content']);
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
                                    <input name="subject" type="text" class="form-control" placeholder="Subject">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <textarea name="content" id="email_message" class="form-control" placeholder="Message" style="height: 120px;"></textarea>
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

                            <button type="submit" name="updateBtn" class="btn btn-primary pull-left"><i class="fa fa-envelope"></i> Send Message</button>
                        </div>
                    </form>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

      
          
    </body>
</html>