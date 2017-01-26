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
            <aside  style="color:black;" class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                     Geo Location
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Geo Location</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <!-- START ALERTS AND CALLOUTS -->
 <h2 class="page-header"></h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box box-danger">
                                <div class="box-header">
                                    <i class="fa fa-world"></i>
                                    <h3 class="box-title">IP Address Lookup</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                 
                      


<?php 
		$ip = '';
		if(isset($_POST['lookupBtn']))
		{
			$ip = $_POST['ipAddress'];
			$ip = (filter_var($ip, FILTER_VALIDATE_IP)) ? $ip : $_SERVER['REMOTE_ADDR'];
$name3 = $odb -> query("SELECT `ip2skypeapi` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
		}
		else 
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$xml = simplexml_load_file('http://ip-api.com/xml/'.$ip);

		$ip = $xml->query;
		$isp = $xml->isp;
		$org = $xml->org;
		$country = $xml->country;
		$country_code = $xml->countryCode;
		$region = $xml->region;
		$flag = 'http://api2.ipv4.cf/f442w6uq/?format=png&size=28&ip='.$ip;
		$city = $xml->city;
		$latitude = $xml->lat;
		$longitude = $xml->lon;
		$timezone = $xml->timezone;
		?>
<?php
if (isset($_POST['submit'])) {
$name = $_POST['username'];
$blacklist = array("cinema4dize","purplemonkeydishwasher19");

// BLACKLISTS
// Thanks to Pillows and CarrotMilk for better blacklisting
if(in_array($name,$blacklist))
{
die("Sorry! $name IP Is 555-555-555");
}

// BLACKLISTS

else
{
$api1 = file_get_contents("http://api.speedresolve.com/skype.php?key=NY3ZxVCdcfHCRLaW4xEp&name=$name}");
echo"<h3><center>$name's IP is</center></h3><div>";
echo "<h1><center>$api1</center></h1>";

}

}
?>	

		
		<form action="" class="form" method="POST">
            <fieldset>
                    <div class="formRow">
                        <div class="formRight">
						<input type="text" placeholder="IP Address" name="ipAddress" style="height:24px;"/>
						<span class="help-inline"></span>
						<input type="submit" value="Lookup" name="lookupBtn" class="btn btn-primary" style="margin-top:-5px;"/>
						</div>
                        <div class="clear"></div>
                    </div>
					
            </fieldset>
        </form> 

		<br /><br />
		<div class="widget" style="width: 100%;">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td><strong>IP Address:</strong></td>
						<td><?php echo $ip;?></td>
                    </tr>
                    <tr>
						<td><strong>Isp:</strong></td>
						<td><?php echo $isp;?></td>
                    </tr>
					<tr>
						<td><strong>Organization:</strong></td>
						<td><?php echo $org;?></td>
                    </tr>
                    <tr>
                        <td><strong>Country:</strong></td>
						<td><?php echo $country;?></td>
                    </tr>
					 <tr>
                        <td><strong>Country Code:</strong></td>
						<td><?php echo $country_code;?></td>
                    </tr>
					 <tr>
                        <td><strong>Flag:</strong></td>
						<td><?php echo "<img src=".$flag." >" ; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Region:</strong></td>
						<td><?php echo $region;?></td>
                    </tr><tr>
                        <td><strong>City:</strong></td>
						<td><?php echo $city;?></td>
                    </tr><tr>
                        <td><strong>Latitude:</strong></td>
						<td><?php echo $latitude;?></td>
                    </tr><tr>
                        <td><strong>Longitude:</strong></td>
						<td><?php echo $longitude;?></td>
                    </tr><tr>
                        <td><strong>Timezone:</strong></td>
						<td><?php echo $timezone;?></td>
                    </tr>

                </tbody>
            </table>
			<br />
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
                            <div class="box box-info">
                                <div class="box-header">
                                    <i class="fa fa-map-marker"></i>
                                    <h3 class="box-title">Location Of IP Address</h3>
<form action="" method="POST">
<br><br><br>
					
<center><fieldset>
				

<head>								
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
function loadMap(){
if (1==1){
	var lat = <?php echo $latitude;?>;
	var lon = <?php echo $longitude;?>;
	var city = '<?php echo $city;?>';
	var myLatlng = new google.maps.LatLng(lat,lon);
	var myOptions ={zoom: 13,center: myLatlng,mapTypeId: google.maps.MapTypeId.HYBRID}
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	var marker = new google.maps.Marker({position: myLatlng,map: map,title: city});   
	var circleOptions ={strokeColor: "#FF0000",strokeOpacity: 0.4,strokeWeight: 2,fillColor: "#FF0000",fillOpacity: 0,map: map,center: myLatlng,radius: 20000};
	var cityCircle = new google.maps.Circle(circleOptions);
}
else{
	var lat = "0";
	var lon = "-10";
	var myLatlng = new google.maps.LatLng(lat,lon);
	var myOptions ={zoom: 1,center: myLatlng,mapTypeId: google.maps.MapTypeId.HYBRID}
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
}

if ("<?php echo $ip;?>"=="<?php echo $ip;?>"){
var osName="Unknown OS";
if (navigator.appVersion.indexOf("Windows NT 6.1")!=-1) osName="Windows 7";
else if (navigator.appVersion.indexOf("Windows NT 6.2")!=-1) osName="Windows 8";
else if (navigator.appVersion.indexOf("Windows NT 6.0")!=-1) osName="Windows Vista";
else if (navigator.appVersion.indexOf("Windows NT 5")!=-1) osName="Windows XP";
else if (navigator.appVersion.indexOf("Mac")!=-1) osName="MacOS";
else if (navigator.appVersion.indexOf("X11")!=-1) osName="UNIX";
else if (navigator.appVersion.indexOf("Linux")!=-1) osName="Linux";
document.getElementById('Navigator').innerHTML="<table style='width:100%'><tr><td style='width:22%;vertical-align:top;text-align:right'>Operating System:&nbsp;</td><td style='width:79%'>" + osName + "</td></tr><tr><td style='text-align:right'>Browser:&nbsp;</td><td>" + navigator.appName + "</td></tr><tr><td style='text-align:right'>Cookies Enabled:&nbsp;</td><td>" + navigator.cookieEnabled + "</td></tr><tr><td style='text-align:right'>Java Enabled:&nbsp;</td><td>" + navigator.javaEnabled() + "</td></tr></table>";}
}
</script>

<script type="text/javascript">
function showLoading()
{document.getElementById('loading').style.visibility = "visible";
document.getElementById('loading2').style.visibility = "visible";}
</script>
</head>
<body onload="loadMap()">
	
<table style="width: 100%;">
<div id="map_canvas" style="width: 100%; height: 349px"></div>	
</table>	
</body>
				</div>
			
                 </div></div> 



        </div>
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