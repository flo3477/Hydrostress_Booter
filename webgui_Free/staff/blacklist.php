<?php
ob_start();
require_once '../includes/db.php';
require_once '../includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: ../logbackin.php');
	die();
}
if (!($user->isReseller($odb)))
{
	header('location: ../notstaff.php');
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
                        BlackList
                        <small>IP BlackList</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">IP BlackList</li>
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
		if (isset($_POST['addBtn']))
		{
			$ipAdd = $_POST['ipAdd'];
			$noteAdd = $_POST['noteAdd'];
			

				if (empty($ipAdd) || empty($noteAdd))
					{
						echo '<div class="alert alert-danger"><p><strong>FAILURE: </strong>Fill In All Fields</p></div>';
					}
					else
					{
						$SQLinsert = $odb -> prepare("INSERT INTO `blacklist` VALUES(NULL, :ip, :note)");
				$SQLinsert -> execute(array(':ip' => $ipAdd, ':note' => $noteAdd));
				echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Updated</p></div>';
					}
				}
				?>
    <?php
		if (isset($_POST['deleteBtn']))
						{
							$deletes = $_POST['id'];
							
								$SQL = $odb -> prepare("DELETE FROM `blacklist` WHERE `ID` = :id LIMIT 1");
								$SQL -> execute(array(':id' => $deletes));
									echo '<div class="alert alert-success"><p><strong>SUCCESS: </strong>Removed</p></div>';
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
                                    <i class="fa fa-ban"></i>
                                    <h3 class="box-title">IP BlackList</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				

					<input style="width:210px; text-align:center;  height:30px" placeholder="IP Address" name="ipAdd" type="text"/>
<br>
<br>					
		
									<input style="width:210px; text-align:center;  height:30px" placeholder="Note" name="noteAdd" type="text"/>
<br>
<br>

					<div class="control-group">
						<div class="controls">

                    <br> <button class="btn btn-info" name="addBtn" type="submit"><i class="icon-fire"></i> Add</button></form>
</div>
<br>
				</form></fieldset></center>
				</div>
			
                 </div></div> 



        </div>


			
		
				

				<div class="content-block" role="main">
				
				
				<!-- Grid row -->
				<div class="row-fluid">

		<center><br><br><br>
<center><fieldset>
					
       
                                           

		<form action="" class = "form" method="POST">
		<div class="widget">
			<br>
                 <div class="row-fluid">
    							<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-1">
									    <header>
									        <h2>Logs</h2>                           
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<table class="table table-bordered" id="s-table-bordered">
				  <thead>
					  <tr>
 <tr>
						 
</th>
<th>Delete</th>
						  <th>Username</th>
						  <th>Note</th>
					  </tr>
				  </thead>
				  <tbody>
				  <?php
				  $SQLSelect = $odb -> query("SELECT * FROM `blacklist` ORDER BY `ID` DESC");
				  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
				  {
					$ipShow = $show['IP'];
					$noteShow = $show['note'];
					$rowID = $show['ID'];
												echo '<tr><td><form method="post"><button class="btn btn-danger " name="deleteBtn"><i class="fa fa-trash-o"></i></button><input type="hidden" name="id" value="'.$rowID.'" /></form></td><td>'.htmlentities($ipShow).'</td><td>'.htmlentities($noteShow).'</td></tr>';
								  }
								  ?>
				  </tbody>
			  </table>

        </div>
	</form>
						
						
						
						
						
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