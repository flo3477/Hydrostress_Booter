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
                        Members
                        <small>Overview</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Members</li>
                    </ol>
                </section>

<div class="content-block" role="main">


<!-- Grid row -->
<div class="row-fluid">
<div class="well well-small">

 <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Manage Members</h3>
                                    <div class="box-tools">
                                        <div class="input-group">
                                            <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive no-padding">
                                    <table class="table table-hover">
                                        <tr>

<table class="table grid table-striped table-bordered table-condensed">
<thead><tr>
<th class="hidden-phone">Username</th>
											<th class="hidden-phone">Email</th>
											<th class="hidden-phone">Rank</th>
											<th class="hidden-phone">View</th>
</tr>
</thead>
<tbody>
<tr>
		<?php 
			$SQLGetUsers = $odb -> query("SELECT * FROM `users` ORDER BY `ID` DESC");
			while ($getInfo = $SQLGetUsers -> fetch(PDO::FETCH_ASSOC))
			{
				$id = $getInfo['ID'];
				$user = $getInfo['username'];
				$email = $getInfo['email'];
				$rank = $getInfo['rank'];

					if ($rank > 1) {
					$rank = 'Admin';
					} elseif ($rank == 1) {
					$rank = 'Staff';
					} else {
					$rank = 'Member';
					}
				echo '<tr class="gradeX"><td>'.$user.'</td><td>'.$email.'</td><td>'.$rank.'</td><td width="50px"><a href="edit.php?id='.$id.'"><button class="btn btn-info">View Account</button></a></td></tr>';
			}
			?>
</tbody>
</table>
</div>
</div>
    

</div>
</div>



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