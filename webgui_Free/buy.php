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
                        Purchase
                        <small>Membership</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Purchase</li>
                    </ol>
                </section>

<div class="content-block" role="main">

<br>
<br>

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


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Pricing</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/pricing-table.css" rel="stylesheet">
 
   </head>
 
  <body>
 <?php
$newssql = $odb -> query("SELECT * FROM `plans` ORDER BY `id` ASC");
while($row = $newssql ->fetch())
{
            
    echo '<div class="container">
    <div class="row">
        
        <div class="col-sm-3">
          <div class="panel panel-default text-center">
            <div class="panel-heading">
   <h3>'.$row['name'].'</h3>
            </div>
            <div class="panel-body">
              <h3 class="panel-title price">$'.$row['price'].'<span class="price-cents"></span><span class="price-month"></span></h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item">'.$row['mbt'].' Seconds</li>
              <li class="list-group-item">50 Gbps of Power</li>
              <li class="list-group-item">'.$row['length'].' '.$row['unit'].'</li>
              <li class="list-group-item">Tools + Features</li>
              <li class="list-group-item"><a href="order.php?id='.$row['ID'].'"><button class="btn btn-alt btn-primary btn-navbar" type="submit">
<i class="fa fa-btc"></i> Bitcoin
</button></a>
            </ul>
</div>
</div>';
}
?>
       
 
      </div>
    </div>
  </body>
</html>