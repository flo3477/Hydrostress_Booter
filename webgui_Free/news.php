<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: /logbackin.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: /login.php');
	die();
}
include("header.php");
?>



      <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                       News Overview
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">News Overview</li>
                    </ol>
                </section>

	</center>


<div class="content-block" role="main">
<div class="portlet box light-grey">
							<div class="portlet-title">
						
							</div>
							<div class="portlet-body">
							<form action = "" method="post">
								<table class="table table-striped table-bordered" id="sample_2">
									<thead>
										<tr>
											<th class="hidden-phone">Subject</th>
											<th class="hidden-phone">Detail</th>
											<th class="hidden-phone">Date</th>
										
										</tr>
									</thead>
									</tbody>

									<?php 
						$SQLNews = $odb -> query("SELECT `title`,`detail`,`date` FROM `news` ORDER BY `date` DESC LIMIT 5");
						while ($newsInfo = $SQLNews -> fetch(PDO::FETCH_ASSOC))
						{
						?>


														
								
				
			


															<tr><td><?php echo htmlentities($newsInfo['detail']); ?></td><td><?php echo htmlentities($newsInfo['title']); ?></td><td><?php echo date('m-d-Y', $newsInfo['date']); ?></td></tr>
													<?php
                        }
						?>
									</tbody>
								</table>
							</div>
						</div>