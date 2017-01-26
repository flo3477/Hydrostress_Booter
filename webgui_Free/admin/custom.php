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
                        <small>Custom Message</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Custom Message</li>
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

$custom= $_POST['customChange'];



                		       
                        		$errors = array();
                        		if (empty($custom))
                        		{
                        		        $errors[] = 'Please verify all fields';
                        		}
                        		if (empty($errors))
                        		{
 $SQLinsert = $odb -> prepare("UPDATE `SiteConfig` SET `custom` = :newemail");
                        		        $SQLinsert -> execute(array(':newemail' => $custom));



                        		        
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

                    <div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Manage Custom Message <small></small></h3>
<form action="" method="POST">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                       <input type="submit" name="changeBtn" value="Update" class="btn btn-info" />
                                  
<br>


                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
                                    <form>
                                        <textarea id="editor1" name="customChange" rows="10" cols="80">
                                            <?php echo $odb->query("SELECT `custom` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>
                                        </textarea>                        
                                    </form>
                                </div>
                            </div><!-- /.box -->
              
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
      
  <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- CK Editor -->
        <script src="../../js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>


    </body>
</html>