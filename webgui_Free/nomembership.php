<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: login.php');
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
                        No Membership
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">500 error</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
                    <div class="error-page">
                        <h2 class="headline">502</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Something went wrong.</h3>
                            <p>
                                Sorry You Dont Have Access To All Features  
                                Meanwhile, you may <a href='index.html'>return to dashboard</a> or Purchase A Membership.
<br>
<br>
If you bought a membership but didn't get it any time or access please submit a ticket with a screen shot of your Transaction ID 
or contact us through our email = <?php echo $odb->query("SELECT `nemail` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>
                            </p>
                            <form class='search-form'>
                                <div class='input-group'>

                                    </div>
                                </div><!-- /.input-group -->
                            </form>
                        </div>
                    </div><!-- /.error-page -->

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        

    </body>
</html>