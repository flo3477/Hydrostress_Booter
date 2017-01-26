<?php

if(isset($_GET['id']) && Is_Numeric($_GET['id']))
{
session_start();
require_once("includes/db.php");
require_once("includes/init.php");
require_once("header.php");
$id = (int)$_GET['id'];
$paypalemail = $odb -> query("SELECT `email` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
$plansql = $odb -> prepare("SELECT * FROM `plans` WHERE `ID` = :id");
$plansql -> execute(array(":id" => $id));
$row = $plansql -> fetch();
if($row === NULL) { die("Bad ID"); }
$paypalurl = "https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_xclick&amount=".urlencode($row['price'])."&business=".urlencode($paypalemail)."&item_name=".
urlencode($row['name'])."&item_number=".urlencode($row['ID']."_".$_SESSION['ID'])."&return=http://cannon.hydroclub.info/buy.php"."&rm=2&notify_url=http://cannon.hydroclub.info/gateway/paypalipn.php"."&cancel_return=http://cannon.hydroclub.info/buy.php"."&no_note=1&currency_code=USD";
//header("Location: ".$paypalurl);

//echo $row['price'] . " Bezhalen in:<br>" .$row['name'] . $row['mbt'];
}
$priceOfYourItemUSD = $row['price'];

$oneUSDbtcValue = file_get_contents("https://blockchain.info/tobtc?currency=USD&value=1");

$priceOfyourItemBTC = ($oneUSDbtcValue * $priceOfYourItemUSD);

?>

<div id="page-content">
<div class="content-header">
<div class="row">
<div class="col-sm-6">
<div class="header-section">

</div>
</div>
<div class="col-sm-6 hidden-xs">
<div class="header-section">
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-10 col-sm-offset-1 col-lg-8 col-lg-offset-2">
<div class="block">
<div class="block-title">
<div class="block-options pull-right">
<a href="javascript:void(0)" class="btn btn-effect-ripple btn-default" onclick="App.pagePrint();"><i class="fa fa-print"></i> Print</a>
</div>
<h2><?php echo $row['name']; ?></h2>
</div>
<div style="color:black;" class="table-responsive">
<table class="table table-striped table-hover table-bordered table-vcenter">
<thead>
<tr>
<th class="text-center"></th>
<th style="width: 50%;">Package</th>
<th class="text-center">Boot</th>
<th class="text-center">Length</th>
<th class="text-right">Amount</th>
</tr>
</thead>
<tbody>
<tr>
<td class="text-center"></td>
<td>
<h4><strong><?php echo $row['name']; ?></strong></h4>
</td>
<td class="text-center"><?php echo $row['mbt']; ?> seconds </td>
<td class="text-center"><?php echo $row['length']; ?> <?php echo $row['unit']; ?></td>
<td class="text-right">$<?php echo $row['price']; ?></td>
</tr>
<tr>
<td colspan="4" class="text-right"><span class="h4"><strong>Total Due</strong></span></td>
<td class="text-right"><span class="h4"><strong>$<?php echo $row['price']; ?></strong></span></td>
</tr>
</tbody>
</table>
</div>
<div class="alert alert-success text-center">
<h3><strong>Send <? echo $priceOfyourItemBTC; ?> to <i class="fa fa-smile-o"></i> 1JdsYA3Ww1zdo1f37X4YVjzYypfvK5JbVN </strong> </h3>
<p>If you bought it Open Ticket and put BTC Transaction HASH, Amount, Package Name and picture.</p>
</div>
</div>
</div>
</div>