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
<title>Hydrostress - Login Page</title>
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
        <div class="logo animate0 bounceIn"><font color="white"><font size="5">Hydrostress</font>
        <form id="login" method="post">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" class="mws-login-username mws-textinput required" placeholder="username" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
            <input type="password" name="password" class="mws-login-password mws-textinput required" placeholder="password" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button type="submit" value="Login" name='loginBtn' class="mws-button green mws-login-button">Log In</button></form>
            </div>
            <form action="register.php" method="get">
            <div class="inputwrapper animate3 bounceIn">
		<button type="submit" value="Register" class="mws-button blue mws-login-button" id="frm1_submit">Register Now</button></form>
		</div>
<!-- <form action="forgotpassword.php" method="get">
            <div class="inputwrapper animate3 bounceIn">
		<button type="submit" value="Register" class="mws-button blue mws-login-button" id="frm1_submit">Reset Password</button></form> -->
		</div>
<br>
<form action="TOS.php" method="get">
            <div class="inputwrapper animate3 bounceIn">
		<button type="submit" value="Register" class="mws-button blue mws-login-button" id="frm1_submit">By Logging In You Agree To our T.O.S.</button></form>
		</div>
            <div class="inputwrapper animate4 bounceIn">

<br>
                <center><p><font color="white"> <?php 
 $ip =$_SERVER['REMOTE_ADDR'];  
                            Echo "Your IP is " . $ip;
 ?> </font></p></center> 
            </div>
           
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
</div><!--loginpanel-->

  <?php
		if ($user -> LoggedIn())
		{
			echo '<div class="alert alert-success"><p><strong><font color="black">User is already logged in.  Redirecting....</font></p></center></div>';
	echo "<meta http-equiv=\"refresh\" content=\"3;url=index.php\">";
	die();
		}
	if (isset($_POST['loginBtn']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$errors = array();
		if (!ctype_alnum($username) || strlen($username) < 4 || strlen($username) > 15)
		{
			$errors[] = 'Username Must Be  Alphanumberic And 4-15 characters in length';
		}
		
		if (empty($username) || empty($password))
		{
			$errors[] = 'Please fill in all fields';
		}
		
		if (empty($errors))
		{
			$SQLCheckLogin = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username AND `password` = :password");
			$SQLCheckLogin -> execute(array(':username' => $username, ':password' => SHA1($password)));
			$countLogin = $SQLCheckLogin -> fetchColumn(0);
			if ($countLogin == 1)
			{
				$SQLGetInfo = $odb -> prepare("SELECT `username`, `ID`, `status` FROM `users` WHERE `username` = :username AND `password` = :password");
				$SQLGetInfo -> execute(array(':username' => $username, ':password' => SHA1($password)));
				$userInfo = $SQLGetInfo -> fetch(PDO::FETCH_ASSOC);
				if ($userInfo['status'] == "0")
				{
					$_SESSION['username'] = $userInfo['username'];
					$_SESSION['ID'] = $userInfo['ID'];

					$ip = getRealIpAddr();
						$SQL = $odb -> prepare('INSERT INTO `loginlogs` VALUES(:username, :ip, UNIX_TIMESTAMP(), "")');
						$SQL -> execute(array(':ip' => $ip, ':username' => $username));
						echo '<div class="alert alert-success"><center><p><font color=\'black\'>Login Succeed.  Redirecting....</font></p></center></div><meta http-equiv="refresh" content="3;url=index.php">';
						die();


				}
				else
				{
					echo '<div class="alert alert-error"><center><p><font color=\'black\'>You are banned: '.$userInfo['status'].'</font></p></center></div>';
				}
			}
			else
			{
				echo '<center><div class="alert alert-error"><p><font color=\'black\'>Login Failed</font></p></center></div>';
			}
		}
		else
		{
			echo '<div class="alert alert-error"><center><p><strong>ERROR:</strong><br />';
			foreach($errors as $error)
			{
				echo '-'.$error.'<br />';
			}
			echo '</center></div>';
		}
	}
	
		?>



</body>
</html>