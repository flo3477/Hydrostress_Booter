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

<?php
			 $name3 = $odb -> query("SELECT `sitename` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
?>
		
				 <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header" style="color:black;">
                    <h1>
                        IP Logger
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                     <li class="active">IP Logger</li>
                        <li class="active"></li>
                    </ol>
             <!--   </section>
-->
				<div style="color:black;"class="content-block" role="main">
				
				
				<!-- Grid row -->
			<center style="color:black;">>	<div class="row-fluid">

								<div class="well well-small">
				<label for="enregistreur"><b>Link #1 : </b></label>
				<input type="text" style="width:345px;" class="input-xlarge" value="<?php echo $url.'images.php?id='.$_SESSION['ID'];?>" readonly="readonly" placeholder="Erreur">
				</div>
			</div>

				<div class="well well-small">
				<label for="enregistreur"><b>Link #2 : </b></label>
				<input type="text" style="width:345px;" class="input-xlarge" value="<?php echo $url.'free.php?id='.$_SESSION['ID'];?>" readonly="readonly" placeholder="Erreur">
				</div>
			</div>
<center>
				<div class="well well-small">
				<label for="enregistreur"><b>Link #3 : </b></label>
				<input type="text" style="width:345px;" class="input-xlarge" value="<?php echo $url.'referral.php?id='.$_SESSION['ID'];?>" readonly="readonly" placeholder="Erreur">
				</div>


<div class="content-block" role="main">
				
<?php 
				if (isset($_POST['clearBtn']))
				{
					$SQL = $odb -> prepare("DELETE FROM `iplogs` WHERE `userID` = :id");
					$SQL -> execute(array(':id' => $_SESSION['ID']));
					echo '<div class="alert alert-success">Adresse IP(s) supprimer.</div>';
				}
				?>

				<table class="table grid table-striped table-bordered table-condensed">
					<thead><tr><th>Address IP</th><th>Date</th></tr></thead>
							  <tbody>
<?php

								$SQLGetLogs = $odb -> prepare("SELECT * FROM `iplogs` WHERE `userID` = :id ORDER BY `date` DESC");
								$SQLGetLogs -> execute(array(':id' => $_SESSION['ID']));
								while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
								{
									$loggedIP = $getInfo['logged'];
									$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
									echo '<tr><td>'.$loggedIP.'</td><td>'.$date.'</td></tr>';
								}
									
								?>								

							  </tbody>
				</table>
<center>
<br><br><center><form action="" method="POST"><button type="submit" name="clearBtn" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete the logs</button></form></center>
			</div>

				</div>
			</div>
		</div>
					</center>
				
			
					
		
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