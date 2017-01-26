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
                        Payments
                        <small>Logs</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Payments</li>
                    </ol>
                </section>
			
		
				

			
					 <?php 
				if (isset($_POST['clearBtn']))
				{
					$SQL = $odb -> prepare("DELETE FROM `payments`");
					$SQL -> execute(array(':id' => $_SESSION['ID']));
					echo '<div class="alert alert-success">Payment logs have been cleared</div>';
				}
				?>
			              
                    <div class="row-fluid">
    							<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-2">
									    <header>
									        

                                        </header>
									    <!-- wrap div -->
									    <div>
									    
									        <div class="jarviswidget-editbox">
                                            
									        </div>
            
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
											<table class="table table-bordered table-striped responsive" id="s-table">
                <thead>
                    <tr>
                                                <th>User</td>
                                                <th>Plan</td>
                                                <th>Email</td>
                                                <th>Transaction ID</td>
                                                <th>Amount</td>
                                                <th>Date</td>
                    </tr>
                </thead>
                <tbody>
                                <?php
                                $SQLGetLogs = $odb -> query("SELECT `payments`.* , `plans`.`name` AS `planname`, `users`.`username` FROM `payments` LEFT JOIN `plans` ON `payments`.`plan` = `plans`.`ID` LEFT JOIN `users` ON `payments`.`user` = `users`.`ID` ORDER BY `ID` DESC");
                                while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
                                {
                                        $user = $getInfo['username'];
                                        $plan = $getInfo['planname'];
                                        $email = $getInfo['email'];
                                        $tid = $getInfo['tid'];
                                        $amount = $getInfo['paid'];
                                        $date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
                                        echo '<tr><td><center>'.$user.'</center></td><td><center>'.$plan.'</center></td><td><center>'.$email.'</center></td><td><center>'.$tid.'</center></td><td><center>$'.$amount.'</center></td><td><center>'.$date.'</center></td></tr>';
                                }

                                ?>
                </tbody>
						</table>
					</div>
				</div>
			</div>
		</div>




		
</form></fieldset></center>
							
					
		
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