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

<div class="content-block" role="main">



              <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

<?php
                $overall = 0;
                $today = 0;
                $week = 0;
                $month = 0;
                $SQLGetLogs = $odb -> query("SELECT `payments`.* , `plans`.`name` AS `planname`, `users`.`username` FROM `payments` LEFT JOIN `plans` ON `payments`.`plan` = `plans`.`ID` LEFT JOIN `users` ON `payments`.`user` = `users`.`ID` ORDER BY `ID` DESC");
                while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
                {
                    if (date('d') == date('d', $getInfo['date'])) {
                        $today = $getInfo['paid'] + $today;
                    }
                    if (date('W') == date('W', $getInfo['date'])) {
                        $week = $getInfo['paid'] + $week;
                    }
                    if (date('m') == date('m', $getInfo['date'])) {
                        $month = $getInfo['paid'] + $month;
                    }
                    $overall = $getInfo['paid'] + $overall;
                }
        ?>

                  <!-- Main content -->
                <section class="content">

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        $<? echo $today; ?>
                                    </h3>
                                    <p>
                                        Revenues Today
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-chatbubble"></i>
                                </div>
 <a href="#" class="small-box-footer">
                                    
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                   <h3>
                                   $<? echo $week; ?>
                                    </h3>
                                    <p>
                                       Revenues This week
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-cart"></i>
                                </div>
                             <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                    
 </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                               <h3>
                                    $<? echo $month; ?>
                                    </h3>
                                    <p>
                                     Revenues This Month
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                               <a href="#" class="small-box-footer">
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       $<? echo $overall; ?>
                                    </h3>
                                    <p>
                                     Revenues Overall
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                 <a href="#" class="small-box-footer">
                                   
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->




  <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $stats -> totalUsers($odb); ?>
                                    </h3>
                                    <p>
                                        Total Members
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
 <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                   <h3>
                                    <?php echo $stats -> totalBoots($odb); ?>
                                    </h3>
                                    <p>
                                       Total Attacks
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                             <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                    
 </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                               <h3>
                                       <?php echo $stats -> runningBoots($odb); ?>
                                    </h3>
                                    <p>
                                      Running Attacks
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-ios7-speedometer-outline"></i>
                                </div>
                               <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        6
                                    </h3>
                                    <p>
                                        Servers Online
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-cloud"></i>
                                </div>
                                 <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->

                    <!-- top row -->
                    <div class="row">
                        <div class="col-xs-12 connectedSortable">
                            
                        </div><!-- /.col -->
                    </div>
                    <!-- /.row -->



				<!-- Grid row -->
<div class="row-fluid">


 <div class="row"> 
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Tickets </h3>
                                    <div class="box-tools">
                                        <div class="input-group">

                                            <input type="text" name="username" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>

                            <div id="dashboard">
					<div class="clearfix"></div>
					<div class="row-fluid">
						<div class="span6">
						<!-- BEGIN Portlet PORTLET-->
						<div class="">
							<div class="portlet-title">
										</div> 
							<div class="portlet-body">
								<table class="table table-striped table-bordered" id="sample_2">
									<thead>
										<tr>
											<th class="hidden-phone">Username</th>
											<th class="hidden-phone">Subject</th>
											<th class="hidden-phone">Status</th>

										</tr>
									</thead>
									<tbody>

			<?php 
			$SQLGetTickets = $odb -> prepare("SELECT * FROM `tickets` WHERE `status` = :status ORDER BY `id` DESC");
			$SQLGetTickets -> execute(array(':status' => 'Waiting for admin response'));
			while ($getInfo = $SQLGetTickets -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['id'];
				$username = $getInfo['username'];
				$subject = $getInfo['subject'];
				echo '<tr><td>'.$username.'</td><td>'.htmlspecialchars($subject).'</td><td width="50px"><a href="/ticket.php?id='.$id.'"><button class="btn btn-warning">New Ticket</button></a></td></tr>';
			}
			?>
									</tbody>
								</table>
							</div>
						</div>
	</div>
						</div>
	</div>
						


<!-- STATISTICS  USER-->
		
		<!-- Grid row -->
<div class="row-fluid">


 <div class="row">
<form action="" method="post" style="margin-top:0px;" >  
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Check Total User Attacks</h3>
                                    <div class="box-tools">
                                        <div class="input-group">

                                            <input type="text" name="username" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>
		
		
							
							
							
					

</div>
						
						
<div class="portlet-body">
<center>
<div class="widget">
            <table class="table table-hover">
                <tbody>
				    <tr>
						<td><strong>User Boots:</strong></td>
						<td><?php echo $stats -> totalBootsForUser($odb, $_POST['username']); ?></td>
                    </tr>
			
			
                </tbody>
            </table>
        </div>			
		
</center>			
			</div></div>
							
							
							
							
		
		</div></div></div></div></div></div>
		<!-- END STATISTICS USER -->
		<!-- OPEN TICKETS -->



    </body>
</html>