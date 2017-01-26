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
                        Server Status 
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Server Status</li>
                    </ol>
                </section>

                <div class="content-block" role="main">

                <table class="table grid table-striped table-bordered table-condensed">
                    <thead><tr><th>Current Servers</th><th>Server Online Status</th><th>Location</th><th>Current Power Output</th><th>Attack Types</th></tr></thead>
                    <tr class="gridrow"><td>Smash :</td><td><?php
$lol = $stats -> runningBoots($odb);
if($lol != "0"){ echo "<span class='label label-danger'>(Attack currently running)</span>"; }else{ echo "<span class='label label-success'>Online + Available</span>"; }
?></td><td><span class='label label-success'>Germany</span></td><td>70.8 Gbps</td><td><span class='label label-default'>Spoofed</td>

                    </tbody>
 <tr class="gridrow"><td>Destroyer :</td><td><span class='label label-success'>Online + Available</span></td><td><span class='label label-success'>Germany</span></td><td>50.99 Gbps</td><td><span class='label label-default'>Spoofed</td>
            </div>
</div>
</div>