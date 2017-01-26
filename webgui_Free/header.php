<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
   <title>  <?php echo $odb->query("SELECT `Tab` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?> </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons --> 
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]> 
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

<?php
            $plansql = $odb -> prepare("SELECT `users`.`expire`, `plans`.`name`, `plans`.`mbt` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id");
            $plansql -> execute(array(":id" => $_SESSION['ID']));
            $row = $plansql -> fetch(); 
            if ($row['name'] == "")
            {
            $row['name'] = "None";
            }
            if ($row['mbt'] == "")
            {$row['mbt'] = "None";}
            ?>
<style>

p {
    color: #F8F8FF;
}
</style>

  <style>
            body {
                background-color: #fff;
                margin: 0px;
                overflow: hidden;
                font-family:arial;
                color:#fff;
            }
            h1{
                margin:0;
            }

            a {
                color:#0078ff;
            }
            #canvas{
                width:100%;
                height:1050px;
                overflow: hidden;
                position:absolute;
                top:0;
                left:0;
                background-color: #1a1724;               
            }
            .canvas-wrap{
                position:relative;
                
            }
            div.canvas-content{
                position:relative;
                z-index:2000;
                color:#fff;
                text-align:center;
                padding-top:30px;
            }
        </style>

    <body  >
	
	
	<section class="canvas-wrap">
            <div id="canvas" class="gradient"></div>
            
     </section>
        
        <!-- Main library -->
        <script src="js/three.min.js"></script>
      
        <!-- Helpers -->
        <script src="js/projector.js"></script>
        <script src="js/canvas-renderer.js"></script>

        <!-- Visualitzation adjustments -->
        <script src="js/3d-lines-animation.js"></script>

        <!-- Animated background color -->
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script src="js/color.js"></script>

        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
             <?php echo $odb->query("SELECT `Header` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
				
        <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>


				
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><?php echo $_SESSION['username']; ?> Status</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-check-square-o "></i> Plan Name: <?php echo $row['name']; ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning danger"></i> Plan Expiry Date: <?php echo date("m-d-Y, h:i:s a", $row['expire']); ?>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-clock-o warning"></i> Boot Time Limit: <td><strong><?php echo $row['mbt']; ?></strong> Seconds</td>
                                            </a>
                                        </li>
 <li>
                                            <a href="#">
                                                <i class="fa fa-hdd-o info"></i> Your Total Attacks: <?php echo $stats -> totalBootsForUser($odb, $_SESSION['username']); ?>
                                            </a>
                                        </li>
                                  
                                       
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                  <li class="footer"><a href="buy.php">Purchase Membership</a></li>
                            </ul>
                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                  
                  
                                  
                                  <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-danger">5</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Error Codes (4)</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
     <li>
                                            <a href="#">
                                                <i class="fa fa-warning warning"></i> Error 404: Page Doesn't Exist 
<div class="control-group">
 
                                            </a>
                                        </li>
   <li>
                                            <a href="#">
                                                <i class="fa fa-warning warning"></i> Error 502: You Dont Have MemberShip
<div class="control-group">
 
                                            </a>
                                        </li>
   <li>
                                            <a href="#">
                                                <i class="fa fa-warning warning"></i> Error 503: Your Not An Admin
<div class="control-group">
 
                                            </a>
                                        </li>
   <li>
                                            <a href="#">
                                                <i class="fa fa-warning warning"></i> Error 504: Your Not An A Staff Member
<div class="control-group">
 
                                            </a>
                                        </li>
                                        <li>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Error Codes</a></li>
                            </ul>
                        </li>
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span> <?php echo $_SESSION['username']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-blue">
              <?
			  function random_string() {
 if(function_exists('random_bytes')) {
 $bytes = random_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('openssl_random_pseudo_bytes')) {
 $bytes = openssl_random_pseudo_bytes(16);
 $str = bin2hex($bytes); 
 } else if(function_exists('mcrypt_create_iv')) {
 $bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
 $str = bin2hex($bytes); 
 } else {
 //Bitte euer_geheim_string durch einen zufälligen String mit >12 Zeichen austauschen
 $str = md5(uniqid('euer_geheimer_string', true));
 } 
 return $str;
}
			  ?>
                                    <img src="<? echo "images/" .$_SESSION['username']. ".gif?".random_string();?>"class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['username']; ?> - Hydrostress Member
                                        <small><?php 
 $ip = $_SERVER['REMOTE_ADDR'];  
                            Echo "Your IP is " . $ip;
 ?> </small>
                                    </p>
                                </li>
                                        <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="col-xs-4 text-center">
                                   

                                    </div>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="unset.php" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">                
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                          <img src="<? echo "images/" .$_SESSION['username']. ".gif?".random_string();?>"class="img-circle" alt="User Image"/>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $_SESSION['username']; ?> </p>
<a href="#"><i class="fa fa-circle text-success"></i> Online</a>


</div>
</div>
<center>
<?php 
 $ip = $_SERVER['REMOTE_ADDR'];  
                                 Echo "<p>Your IP is " . $ip;
 ?> 
</center>
                    <!-- search form -->
        <style>
.jumbotron{
    position: relative;
    padding:0 !important;
    margin-top:70px !important;
    background: #eee;
    margin-top: 23px;
    text-align:center;
    margin-bottom: 0 !important;
	opacity: 0.5;
	border-radius: 25px;
}
.container-fluid{
    padding:0 !important;
}
.col-xs-4{
    background:rgba(157,52,99,0.7);    
}
		</style>
		<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu" >
					
<div class="jumbotron">
					
                        <li>
                            <a href="index.php">
                                <i style="color:black;" class="fa fa-bookmark-o"></i> <span style="color:black;">Dashboard</span>
                            </a>
                        </li>
<?php
			if ($user->hasMembership($odb))
			{
			?>
                        <li>
                            <a style="color:black;" href="stresser.php">
                                <i class="fa fa-hdd-o"></i> <span>Stresser</span> <small class="badge pull-right bg-yellow">  <?php echo $stats -> runningBoots($odb); ?></small>
                            </a>
                        </li>
                        <li style="color:black;" class="treeview">
                            <a href="#">
                                <i class="fa fa-wrench"></i>
                                <span>Tools</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">              
                                <li><a href="http.php"><i class="fa fa-angle-double-right"></i> Http Resolver</a></li>
								<li><a href="CloudFlare.php"><i class="fa fa-angle-double-right"></i> CloudFlare Resolver</a></li>
								<li><a href="iplogger.php"><i class="fa fa-angle-double-right"></i> IP Logger</a></li>
								<li><a href="f&e.php"><i class="fa fa-angle-double-right"></i> Friends And Enemies</a></li>
								<li><a href="geolocation.php"><i class="fa fa-angle-double-right"></i> Geo Location</a></li>
                            </ul>
                        </li>
<?php
			}
			?>
 <li>
                            <a style="color:black;"href="support.php">
                                <i class="fa fa-ticket"></i> <span>Support</span> 
                            </a>
                        </li>

           <li>
                            <a style="color:black;" href="buy.php">
                                <i class="fa fa-shopping-cart"></i> <span>Purchase</span>
                            </a>
                        </li>
						
<?php
			if ($user->hasMembership($odb))
			{
			?>
                         <li>
                            <a style="color:black;" href="attacklogs.php">
                                <i class="fa fa-bar-chart-o"></i> <span>Attack Logs</span> <small class="badge pull-right bg-green"><?php echo $stats -> totalBootsForUser($odb, $_SESSION['username']); ?></small>
                            </a>
                        </li>
<?php
			}else{
		
		?>
					<li>
                            <a style="color:black;" href="freestress.php">
                                <i class="fa fa-times-circle"></i> <span>Test Hydrostress</span>
                            </a>
                        </li>			<?php
						}
			if ($user->hasMembership($odb))
			{
			?>
		<!--		<li>
               <a href="servers.php">
                                <i class="fa fa-sitemap"></i> <span>Servers Status</span>
                            </a>
                        </li> -->
<?php
			}
			?>
 <?php global $odb; global $user; if($user->isAdmin($odb)) { ?>
		<li>
                            <a style="color:black;" href="admin/index.php">
                                <i class="fa fa-user"></i> <span>Admin Panel</span>
                                <small class="badge pull-right bg-purple"><?php echo $stats -> totalUsers($odb); ?></small>
                            </a>
                        </li>
				<?php } ?>	
				<?php global $odb; global $user; if($user->isReseller($odb)) { ?>
		<li>
                            <a style="color:black;" href="staff/index.php">
                                <i class="fa fa-user"></i> <span>Staff Panel</span>
                                <small class="badge pull-right bg-purple"><?php echo $stats -> totalUsers($odb); ?></small>
                            </a>
                        </li>
				<?php } ?>
			</ul>
		
                    </ul>
                </section>                                 
                <!-- /.sidebar -->
            </aside>


   <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>




       
    </body>
</html>