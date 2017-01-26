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
<title>Hydrostress T.O.S.</title>
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
        <div class="logo animate0 bounceIn"><font color="white"><font size="5">Hydrostress T.O.S.</font></font>  
       
<div class="inputwrapper animate3 bounceIn">
                <button >Teile deinen Account nicht mit Freunden</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Hite/Stresse nur deine eigenen Server oder IPs für Testzwecke.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Verkaufe deinen Account nicht weiter.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Denial of Service Angriffe sind nicht Erlaubt.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Deine Attacken werden mitgeschrieben von Hydrostress.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Mach keine Illegalen Sachen.</button>              
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Alle käufe sind entgültig und können nicht rückgängig gemacht werden.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Wenn wir aufgefordert werden dürfen wir / müssen wir deine Informationen Preisgeben.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Wir haften nicht für deine Aktionen oder Missbrauch.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Werbe nicht als Illegalen Stresser für Hydrostress.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Wir können unsere "terms of service" jederzeit ÄNDERN.</button>
</div>
<div class="inputwrapper animate3 bounceIn">
                <button >Du kannst einen Bann bekommen wenn du dich nicht an unsere Regeln hällst.</button>
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