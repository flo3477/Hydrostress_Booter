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
<title>Hydrostress - Register Page</title>
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

<center><div class="alert alert-error"><p><strong>ALERT: </strong>By Registering you agree to our <a href="TOS.php">Terms Of Service</a>.</div></center>

<?php
if (isset($_POST['registerBtn']))
{
			
	if (empty($_POST['password']))
	{
	echo '<div class="alert alert-error"><center><p><font color=\'black\'>Please Choose A Password</font></p></center></div>';
	}else
	
	$secure = isset($_POST['secure']) ? strtolower($_POST['Username']) : '';
	if ($secure == $_SESSION['username']) {
	unset($_SESSION['username']);
						
						
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$checkUsername = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `username` = :username");
	$checkUsername -> execute(array(':username' => $username));
	$countUsername = $checkUsername -> fetchColumn(0);
	$checkEmail = $odb -> prepare("SELECT COUNT(*) FROM `users` WHERE `email` = :email");
		$checkEmail -> execute(array(':email' => $email));
		$countEmail = $checkEmail -> fetchColumn(0);
		if ($countEmail > 0)
		{
			echo '<div class="alert alert-error"><p><font color=\'black\'><center>Email Already In Use</center></font></p></div>';
		}
		else
	{
	if (empty($username) || empty($password) || empty($email))
	{
			echo '<div class="alert alert-error"><center><p><font color=\'black\'>Fill In All Fields</font></p></center></div>';
	}
	else
	{
		if (!ctype_alnum($username) || strlen($username) < 4 || strlen($username) > 15)
		{
echo '<div class="alert alert-error"><center><p><font color=\'black\'>Fill in all fields!</font></p></center></div>';
echo '<div class="alert alert-error"><center><p><font color=\'black\'>Please choose a username between 4-5 characters.</font></p></center></div>';
		}
		else
		{
			if (!($countUsername == 0))
			{
echo '<div class="alert alert-error"><center><p><font color=\'black\'>Username Taken.</font></p></center></div>';
			}
			else
			{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
echo '<div class="alert alert-error"><center><p><font color=\'black\'>Invalid email address.</font></p></center></div>';
				}
				else
				{
						$insertUser = $odb -> prepare("INSERT INTO `users` VALUES(NULL, :username, :password, :email, 0, 0, 0, 0)");
						$insertUser -> execute(array(':username' => $username, ':password' => SHA1($password), ':email' => $email));
$ip = getRealIpAddr();
$SQL = $odb -> prepare('INSERT INTO `registerlogs` VALUES(:username, :ip, UNIX_TIMESTAMP(), "")');
$SQL -> execute(array(':ip' => $ip, ':username' => $username));

    //change this to your email.
 $name3 = $odb -> query("SELECT `sitename` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
 $name2 = $odb -> query("SELECT `header` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
    $subject1 = $odb -> query("SELECT `Subject` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
$subject = "Welcome To $name2";
$name1 = $odb -> query("SELECT `email` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);


  $to   = "huzoorbux@gmail.com";
  $from = $odb -> query("SELECT `email` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
 
  $headers = "From: " . strip_tags($from) . "\r\n";
  $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
  $headers .= "CC: $name1\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
 
$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';
 
$message .= "<tr><td><img src='/horizon.png' alt='Hydrostress' /></td></tr>";
 
$message .= "<tr><td colspan=2>Thank you for signing up with us. Your new account has been setup and you can now login to our client area using the details below.
Your details are as follows: 
<br>
<br>
Username: $username
<br>
Email: $email
<br>
Password: ************* 
<br>
<br>
To login, visit $name3
<br>
<br>
Thank you for choosing $name2! 
<br>
<br>
This is an automated response, please do not reply!</td></tr>";

 
$message .= "<tr><td colspan=2 font='colr:#999999;'><I>$name3<br>Registered from IP: $ip</I></td></tr>";
 
$message .= "</table>";
 
$message .= "</body></html>";
    
    // now lets send the email.
mail($email, $subject, $message, $headers);


echo '<div class="alert alert-success"><center><p><font color=\'black\'>Registered Successfully. Check Your Email Address. Redirecting....</font></p></center></div><meta http-equiv="refresh" content="3;url=login.php">';
}
}
}
}
}
}
}
?>
           
<body class="loginpage">
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><font color="white"><font size="5">Hydrostress</font>
        <form id="login" method="post">
 <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="username" class="mws-login-username mws-textinput required" placeholder="Username" />
            </div>
            <div class="inputwrapper animate2 bounceIn">
                <input type="password" name="password" class="mws-login-password mws-textinput required" placeholder="Password" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
               <input type="password" name="rpassword" class="mws-login-password mws-textinput required" placeholder="Repeat Password" />
            </div>
            <div class="inputwrapper animate4 bounceIn">
                <input type="text" name="email" class="mws-login-email mws-textinput required" placeholder="Email Address" />
            </div>

            <div class="inputwrapper animate3 bounceIn">
                <button type="submit" value="Login" name='registerBtn' class="mws-button green mws-login-button">Register now</button></form>
            </div>
            <form action="login.php" method="get">
            <div class="inputwrapper animate3 bounceIn">
		<button type="submit" value="Register" class="mws-button blue mws-login-button" id="frm1_submit">Already have an account?</button></form>
		</div>
           
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
</div><!--loginpanel-->

</body>
</html>