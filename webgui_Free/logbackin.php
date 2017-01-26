<?php
include_once 'captcha/securimage.php';
$securimage = new Securimage();
require 'includes/db.php';
require 'includes/init.php';

?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Iluminati own US ps Hydrostress</title>
<link rel="stylesheet" href="assetsz/css/style.default.css" type="text/css" />
<link rel="stylesheet" href="assetsz/css/style.shinyblue.css" type="text/css" />

<script type="text/javascript" src="assetsz/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="assetsz/js/jquery-migrate-1.1.1.min.js"></script>
<script type="text/javascript" src="assetsz/js/jquery-ui-1.9.2.min.js"></script>
<script type="text/javascript" src="assetsz/js/modernizr.min.js"></script>
<script type="text/javascript" src="assetsz/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assetsz/js/jquery.cookie.js"></script>
<script type="text/javascript" src="assetsz/js/custom.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('#login').submit(function(){
            var u = jQuery('#username').val();
            var p = jQuery('#password').val();
            if(u == '' && p == '') {
                jQuery('.login-alert').fadeIn();
                return false;
            }
        });
    });
</script>
</head>






             
<body class="loginpage">
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><font color="white"><font size="5">Horizon Stresser</font>
        <form id="login" method="post">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button type="submit" class="mws-button green mws-login-button">Please Login To Access  <br> You Have Been Idle For More Than 40Min</button></form>
            </div>

           
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
</div><!--loginpanel-->

<div class="alert alert-error"><center><p><font color="black">You Have Been Idle For Too Long. Redirecting....</font></p></center></div><meta http-equiv="refresh" content="3;url=login.php">

</body>
</html>