<?php
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
<title>EMO STRESSER T.O.S.</title>
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
        <div class="logo animate0 bounceIn"><font color="white"><font size="5">EMO STRESSER T.O.S.</font></font>  
       
<div class="inputwrapper animate3 bounceIn">
                <button >Do not share your accounts</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Do not hit government websites.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Do not re-sell your account.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >DDoS services are not allowed.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Do not attempt to exploit EMO STRESSER.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Do not complain.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >All sales are final.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Charging back will cause scam reports will be opened.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Charging back may cause a release of your information.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >We are not responsible for your actions.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Do not advertise anything.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >We may change our terms of service any time.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >We may ban you at any time for any reason.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >By logging in you agree to our T.O.S</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >By Registering you agree to our T.O.S</button>
</div>
           </form>
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
</div><!--loginpanel-->
</body>
</html>