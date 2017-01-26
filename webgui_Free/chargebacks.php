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
                       Charge Backs
                        <small>Only Faggot Here</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Charge Backs</li>
                    </ol>
                </section>

	</center>

<center>
<div style="width:1030px; text-align:center; height:70px" class="alert alert-info">
<button class="close" data-dismiss="alerts">×</button>
<strong><center><b>Dont want to end up on this list?</b></strong>
<br>
Then dont chargeback. Read our Terms of Service.</center>
</div>
</center>
<!-- Grid row -->
<div class="row-fluid">
<div class="well well-small">

<div class="content-block" role="main">
<div class="portlet box light-grey">
							<div class="portlet-title">
						
							</div>
							<div class="portlet-body">
							<form action = "" method="post">
								<table class="table table-striped table-bordered" id="sample_2">
									<thead>
										<tr>
											<th class="hidden-phone">Username</th>
											<th class="hidden-phone">IP Address</th>
											<th class="hidden-phone">Skype</th>
<th class="hidden-phone">Email</th>
<th class="hidden-phone">Address</th>
<th class="hidden-phone">Date</th>
										
										</tr>
									</thead>
									</tbody>

									<?php 
						$SQLNews = $odb -> query("SELECT `username`,`ip`,`skype`,`email`,`address`,`date` FROM `chargebacks` ORDER BY `id` DESC LIMIT 5");
						while ($newsInfo = $SQLNews -> fetch(PDO::FETCH_ASSOC))
						{
						?>


														
								
				
			


															<tr><td><?php echo htmlentities($newsInfo['username']); ?></td><td><?php echo htmlentities($newsInfo['ip']); ?></td><td><?php echo htmlentities($newsInfo['skype']); ?></td><td><?php echo htmlentities($newsInfo['email']); ?></td><td><?php echo htmlentities($newsInfo['address']); ?></td><td><?php echo date('m-d-Y', $newsInfo['date']); ?></td></tr>
													<?php
                        }
						?>
									</tbody>
								</table>
							</div>
						</div>