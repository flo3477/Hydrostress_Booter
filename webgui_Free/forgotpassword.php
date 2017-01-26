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
<title>EMO STRESSER - Reset Password</title>
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

<?php

$_SESSION['start']="session";

$_SESSION['register']="session";

// This is displayed if all the fields are not filled in

$empty_fields_message = '<center><div class="alert alert-danger"><center><p><font color=\'black\'>Please Fill In All Fields</font></p></center>';

// Convert to simple variables  

$email_address = $_POST['email_address'];
$name = $_POST['email_address'];

if (!isset($_POST['email_address'])) {

?>


  <?php

}

elseif (empty($email_address)) {

    echo $empty_fields_message;

}

else {





mysql_connect("localhost", "DB_USERNAME", "DB_PASSWORD") or die(mysql_error());

mysql_select_db("DB_NAME") 

 or die(mysql_error());





$email_address = mysql_real_escape_string($email_address);

$status = "OK";

$msg="";

//error_reporting(E_ERROR | E_PARSE | E_CORE_ERROR);

if (!stristr($email_address,"@") OR !stristr($email_address,".")) {


echo '<div class="alert alert-warning"><center><p><font color=\'black\'>Your email address is not in the correct format.</font</p></center>';

$status= "NOTOK";}


echo "";


if($status=="OK"){  $query="SELECT email,username FROM users WHERE email = '$email_address'";

$st=mysql_query($query);

$recs=mysql_num_rows($st);

$row=mysql_fetch_object($st);

$em=$row->email_address;// email is stored to a variable

 if ($recs == 0) {  

echo '<div class="alert alert-warning"><center><p><font color=\'black\'>Sorry That Email Address Wasnt Found In Our Database.  Redirecting....</font></p></center></div><meta http-equiv="refresh" content="3;url=forgotpassword.php">';



exit;

}

function makeRandomPassword() { 

          $salt = "abchefghjkmnpqrstuvwxyz0123456789"; 

          srand((double)microtime()*1000000);  

          $i = 0; 

          while ($i <= 7) { 

                $num = rand() % 33; 

                $tmp = substr($salt, $num, 1); 

                $pass = $pass . $tmp; 

                $i++; 

          } 

          return $pass; 

    } 

    $random_password = makeRandomPassword(); 

    $db_password = SHA1($random_password); 

     

    $sql = mysql_query("UPDATE users SET password='$db_password'  

                WHERE email='$email_address'"); 

$ip = getRealIpAddr();
						$SQL = $odb -> prepare('INSERT INTO `forgotlogs` VALUES(:email, :ip, UNIX_TIMESTAMP(), "")');
						$SQL -> execute(array(':ip' => $ip, ':email' => $email_address));

    //change this to your email.
 $name3 = $odb -> query("SELECT `sitename` FROM `SiteConfig` LIMIT 1") -> fetchColumn(0);
 $name2 = $odb -> query("SELECT `header` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
    $subject = $odb -> query("SELECT `Subject` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
$name1 = $odb -> query("SELECT `email` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);

    $subject = $odb -> query("SELECT `Subject` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
 $from = "m2@maaking.com";

  $to   = "huzoorbux@gmail.com";
  $from = $odb -> query("SELECT `email` FROM `forgotconfig` LIMIT 1") -> fetchColumn(0);
 
  $headers = "From: " . strip_tags($from) . "\r\n";
  $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
  $headers .= "CC: info@phpgang.com\r\n";
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>';
 
$message .= '<table width="100%"; rules="all" style="border:1px solid #3A5896;" cellpadding="10">';
 
$message .= "<tr><td><img src='http://hit4life.tk/db/horizon.png' alt='EMO STRESSER' /></td></tr>";
 
$message .= "<tr><td colspan=2>Hello , you have chosen to reset your password.<br /><br />As you requested, your password for our client area has now been reset.
Your details are as follows: 
<br>
Email: $email_address 
<br>
Password: $random_password 
<br>
<br>
Once logged in you can change your password 
<br>
<br>
If it was not at your request, then please contact support immediately. 
<br>
<br>
This is an automated response, please do not reply!</td></tr>";

 
$message .= "<tr><td colspan=2 font='colr:#999999;'><I>$name3<br>Password requested from IP: $ip</I></td></tr>";


 
$message .= "</table>";
 
$message .= "</body></html>";
    
    // now lets send the email.
mail($email_address, $subject, $message, $headers);


 echo '<div class="alert alert-success"><center><p><font color=\'black\'>Request Has been sent.  Redirecting....</font></p></center></div><meta http-equiv="refresh" content="3;url=login.php">';


 } 

 else {echo "$msg";}

}

?>  
           
<body class="loginpage">
<div class="loginpanel">
    <div class="loginpanelinner">
        <div class="logo animate0 bounceIn"><font color="white"><font size="5">Forgot Your Password?</font>
        <form id="login" method="post">
            <div class="inputwrapper login-alert">
                <div class="alert alert-error">Invalid username or password</div>
            </div>
            <div class="inputwrapper animate1 bounceIn">
                <input type="text" name="email_address" class="mws-login-username mws-textinput required" placeholder="Email Address" />
            </div>
            <div class="inputwrapper animate3 bounceIn">
                <button type="submit" value="Login" name='loginBtn' class="mws-button green mws-login-button">Send Request</button></form>
            </div>
      <form action="login.php" method="get">
            <div class="inputwrapper animate3 bounceIn">
		<button type="submit" value="Register" class="mws-button blue mws-login-button" id="frm1_submit">GO BACK</button></form>
		</div>
	
           
    </div><!--loginpanelinner-->
</div><!--loginpanel-->
</div><!--loginpanel-->



</body>
</html>