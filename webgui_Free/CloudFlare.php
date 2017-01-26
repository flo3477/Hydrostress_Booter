<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: login.php');
	die();
}
if (!($user->hasMembership($odb)))
{
	header('location: nomembership.php');
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
                      CloudFlare Resolver 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">CloudFlare Resolver</li>
                    </ol>
                </section>

               <!-- Main content -->
                <section class="content">
				

                   

<!-- Main content -->
                <section style="color:black;" class="content">
              
                    <!-- START ALERTS AND CALLOUTS -->
   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-cloud"></i>
                                    <h3 class="box-title">Resolve</h3>
<form action="" method="POST">
<br><br><br>
					
<center>

<script language=JavaScript>
var txt=" [Cloudflare]Resolver[HydroCompany] " ;
var espera=100;
var refresco=null;
function rotulo_title() {document.title=txt;
    txt=txt.substring(1,txt.length)+txt.charAt(0);
    refresco=setTimeout("rotulo_title()",espera);}
rotulo_title();
function MM_displayStatusMsg(msgStr) { //v1.0
status=msgStr;
document.MM_returnValue = true;}
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);}
</script>

<form method=post>
<label color=red><h2>.:Resolve CloudFlare Servers:.<br></h2></label>  <br> www.<input type="text" name="find" size="21"><br><br>
<input class="btn btn-danger" type="submit" value="GET IP">
</form>

</center>
<br>
<br>
<br>
<br>

				</div>
			
                 </div></div> 



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
if (!isset($argv[1]) && !isset($_POST['find']))
{
    die("<center> Kein Eintrag</center>");
}

$lookupArr = array("mail.", "direct.", "direct-connect.", "cpanel.", "ftp.");

foreach ($lookupArr as $lookupKey)
{

    if (isset($_POST['find']))
    {
        $newline = "<br />";
        $lookupHost = $lookupKey . $_POST['find'];
    }
    else
    {
        $newline = "\n";
        $lookupHost = $lookupKey . $argv[1];
    }

    $foundHost = gethostbyname($lookupHost);

    if ($foundHost == $lookupHost)
    {
        echo "{$lookupHost} has no DNS record.{$newline}";
    }
    else
    {
        echo "{$lookupHost} = {$foundHost}{$newline}";
    }
}

?>   
</center>					

</center>
                                    </div>
                                    
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                       
                    <!-- END ALERTS AND CALLOUTS -->

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