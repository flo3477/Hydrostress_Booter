<?php
ob_start();
require_once '../includes/db.php';
require_once '../includes/init.php';
if (!($user -> LoggedIn()))
{
	header('location: ../logbackin.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: ../login.php');
	die();
}
?>
				
				
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title> <?php echo $odb->query("SELECT `Tab` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?> </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons --> 
        <link href="../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../css/AdminLTE.css" rel="stylesheet" type="text/css" />
        
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



    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../index.php" class="logo">
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
                                  <li class="footer"><a href="../purchase.php">Purchase Membership</a></li>
                            </ul>

                        </li>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bullhorn"></i>
                                <span class="label label-warning"><?php echo $stats -> totalnews($odb); ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                
          
                    
                                  <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-warning"></i>
                                <span class="label label-danger">5</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">News (<?php echo $stats -> totalnews($odb); ?>)</li>
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
                                <li class="user-header bg-black">
                                    <img src="../img/avatar08.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $_SESSION['username']; ?>
 <small> <?php echo $odb->query("SELECT `Header` FROM `SiteConfig` LIMIT 1")->fetchColumn(0); ?> </small>
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
                                        <a href="../profile.php" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../unset.php" class="btn btn-default btn-flat">Sign out</a>
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
                 
                        <div class="pull-left info">
                            <p>Hello, <?php echo $_SESSION['username']; ?> </p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                   
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li>
                            <a href="index.php">
                                <i class="fa fa-bookmark-o"></i> <span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="users.php">
                                <i class="fa fa-users"></i> <span>Members</span> 
                            </a>
                        </li>
 <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cogs"></i>
                                <span>Seiten Einstellungen</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="Coreapplicationsettings.php"><i class="fa fa-angle-double-right"></i> Main Settings</a></li>
 <li><a href="apisettings.php"><i class="fa fa-angle-double-right"></i> Manage Api</a></li>
<li><a href="custom.php"><i class="fa fa-angle-double-right"></i> Custom Message</a></li>
                               
                            </ul>
                        </li>
  <li>
                            <a href="payments.php">
                                <i class="fa fa-money"></i> <span>Payments</span>
                            </a>
                        </li>
  <li>
                            <a href="plans.php">
                                <i class="fa fa-bars"></i> <span>Plans</span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-ban"></i>
                                <span>BlackList</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="skypeblacklist.php"><i class="fa fa-angle-double-right"></i> Skype Resolver BlackList</a></li>
                                <li><a href="blacklist.php"><i class="fa fa-angle-double-right"></i> IP BlackList</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i>
                                <span>Logs</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="logs.php"><i class="fa fa-angle-double-right"></i> Attack Logs</a></li>
								<li><a href="loginlogs.php"><i class="fa fa-angle-double-right"></i> Login Logs</a></li>
                                <li><a href="forgotlogs.php"><i class="fa fa-angle-double-right"></i> Forgot Password Logs</a></li>
                               
                            </ul>
                        </li>
 <li>
                            <a href="ticketcenter.php">
                                <i class="fa fa-ticket"></i> <span>Ticket Center</span> <small class="badge pull-right bg-green"><?php echo $stats -> totaltickets($odb); ?></small>
                            </a>
                        </li>

                      
			</ul>
			                                    
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

   <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../js/AdminLTE/app.js" type="text/javascript"></script>


     

    </body>
</html>