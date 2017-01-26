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
            <aside style="color:black;" class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Attack Logs
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Attack Logs</li>
                    </ol>
                </section>

<div class="content-block" role="main">
<div class="portlet box light-grey">
							<div class="portlet-title">
						
							</div>
							<div class="portlet-body">
							<form action = "" method="post">
								<table class="table table-striped table-bordered" id="sample_2">
									<thead>
										<tr>
											<th class="hidden-phone">User</th>
											<th class="hidden-phone">IP</th>
											<th class="hidden-phone">Port</th>
											<th class="hidden-phone">Time</th>
											<th class="hidden-phone">Method</th>
											<th class="hidden-phone">Date</th>
										</tr>
									</thead>
									<tbody>
				<?PHP
														$SQLGetLogs = $odb -> prepare("SELECT * FROM `logs` WHERE `user` = :username ORDER BY `date` DESC");
														$SQLGetLogs -> execute(array(':username' => $_SESSION['username']));
														while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
														{
															$user = $getInfo['user'];
															$IP = $getInfo['ip'];
															$port = $getInfo['port'];
															$time = $getInfo['time'];
													
															$method = $getInfo['method'];
															$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
															echo '<tr><td>'.$user.'</td><td>'.$IP.'</td><td>'.$port.'</td><td>'.$time.'</td><td>'.$method.'</td><td>'.$date.'</td></tr>';
														}
													?>
									</tbody>
								</table>
							</div>
						</div>