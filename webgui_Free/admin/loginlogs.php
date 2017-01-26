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
                     Login Logs
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Login Logs</li>
                    </ol>
                </section>
		
				

				<div class="content-block" role="main">
		
					<?php 
		if (isset($_POST['clearBtn']))
		{
			$SQL = $odb -> query("TRUNCATE `loginlogs`");
			echo '<div class="nNote nSuccess hideit"><p><strong>SUCCESS: </strong>Logs have been cleared</p></div>';
		}
		?>
					
								<table class="table table-striped table-bordered" id="sample_2">
									<thead>
										<tr>
											<th class="hidden-phone">User</th>
											<th class="hidden-phone">IP</th>
											<th class="hidden-phone">Date</th>
										</tr>
									</thead>
									<tbody>
				<?php
				$SQLGetLogs = $odb -> query("SELECT * FROM `loginlogs` ORDER BY `date` DESC");
				while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
				{
					$user = $getInfo['username'];
					$IP = $getInfo['ip'];
					$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
					echo '<tr class="odd gradeX"><td>'.$user.'</td><td>'.$IP.'<br></td><td>'.$date.'</td></tr>';
				}
					
				?>
									</tbody>
								</table>
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