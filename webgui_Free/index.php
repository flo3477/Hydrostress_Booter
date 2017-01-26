<?php
	$page = 'Home';
	$pageIcon = 'home';
	ob_start();
	require_once('includes/db.php');
	require_once('includes/init.php');
	if(!($user->LoggedIn())){
		if(isset($_GET['referral'])){
			$_SESSION['referral'] = preg_replace("/[^A-Za-z0-9-]/","", $_GET['referral']);
			header('Location: register.php');
			die();
		}
		header('location: login.php');
		die();
	}
	if(!($user->notBanned($odb))){
		header('location: logout.php');
		die();
	}
	require_once('header.php');
?>



<div class="content-block" role="main">

<style>
h2 { color: #000000; font-family: 'Raleway',sans-serif; font-size: 30px; font-weight: 800; line-height: 36px; margin: 0 0 24px; text-align: center; }
</style>

<button type="button" class="btn btn-primary btn-block" id="modal" style="display:none" data-toggle="modal" data-target="#compose-modal">Upgrade</button>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
    

  
		<!-- Main page header -->
		<header style="background-color:#0da1ea" class="navbar">
			
			<!-- Navbar style -->
			<div class="navbar-inner">
				
			<marquee style="background-color:#0b0303" </marquee> 																			
		<h2> <?php echo $odb->query("SELECT `custom` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>   </marquee>
		

			</div>
			<!-- /Navbar style -->
		
		</header>



                  <!-- Main content -->
                <section class="content">

				
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
					
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
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
                                    Updated 1Min Ago <i class="fa fa-refresh fa-spin"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                   <h3>
                                    <?php echo $stats -> totalBoots($odb); ?>
                                    </h3>
                                    <p>
                                       Total Attacks
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion-bug"></i>
                                </div>
                             <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-refresh fa-spin"></i>
                                </a>
                            </div>
                    
 </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                               <h3>
                                       <?php echo $stats -> runningBoots($odb); ?>
                                    </h3>
                                    <p>
                                      Running Attacks
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-flash"></i>
                                </div>
                               <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-refresh fa-spin"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        2
                                    </h3>
                                    <p>
                                        Servers Online
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-social-freebsd-devil"></i>
                                </div>
                                 <a href="#" class="small-box-footer">
                                    Updated 1Min Ago <i class="fa fa-refresh fa-spin"></i>
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

                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-6 connectedSortable"> 
                            <!-- Box (with bar chart) -->
                            <div class="box box-danger" id="loading-example">
                                <div class="box-header">
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh fa-spin"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->
                                    <i class="fa fa-cloud"></i>

                                    <h3 class="box-title">Server Load</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                    <div class="row">									
                                        <div class="col-sm-7">
                                            <!-- bar chart -->
                                            <div class="chart" id="bar-chart" style="height: 250px;"></div>
                                        </div>
										
                                        <div class="col-sm-5">
                                            <div style="color:black;" class="pad">
										
                                                <!-- Progress bars -->
                                                <div class="clearfix">
												     
                                                    <span class="pull-left">Bandwidth</span>
                                                    <span class="pull"><br>API Status Online</span>
                                                    <small class="pull-right">9.4/10 TB</small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-green" style="width: 95%;"></div>
                                                </div>

                                                <div class="clearfix">
                                                    <span class="pull-left">Transfered</span>
                                                    <small class="pull-right">Heute: 4 TB </small>
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-red" style="width: 100%;"></div>
                                                </div>

                                         <!--      <div class="clearfix">
                                                    <span class="pull-left">Meine Bandbreite:</span>
													   <span class="pull"><br>Unterstütze uns und erhalte Zusätzlich Bandbreite nur für deine Boots</span>
                                                    <small class="pull-right">In dev 10%</small>
                                                </div> 
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-light-blue" style="width: 0%;"></div>
                                                </div> -->

                                                <div class="clearfix">
                                                    <span class="pull-left">Online time</span>
                                                    <small class="pull-right"> 78 % *Sry in Dev</small> 
                                                </div>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 70%;"></div>
                                                </div>
                                                <!-- Buttons -->
                                                <p>
                             
                                                </p>
                                            </div><!-- /.pad -->
                                        </div><!-- /.col -->
                                    </div><!-- /.row - inside box -->
                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="row">
                                  
                                        </div><!-- ./col -->
                                    </div><!-- /.row -->
                                </div><!-- /.box-footer -->
                            </div><!-- /.box -->        
                            


                            

            </div><!-- /.modal-dialog -->
			
        </div><!-- /.modal -->

    </body>
</html>