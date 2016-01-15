<?php
include("/home/u220391248/public_html/scripts/config.php");
include("/home/u220391248/public_html/scripts/captcha/captcha.php");
checkIfBanned();
echo '<style>body{background-image: url('.imageToBase64($background).');}</style>';
disableRightClick();
$q = mysql_query("SELECT * FROM websiteSettings");
$arr = mysql_fetch_array($q);
$registrationDisabled = $arr['registrationDisabled'];
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<center>
<a href="<?php echo $mirrorUrl; ?>?ext=/login.php">Login</a>
</center>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<style type="text/css">
.content {
background-color: white;
}

.regButton {
margin:3;
}

.menu {
padding: 5;
background-color: black;
width: 280;
}
</style>
<center>
<div class="menu">
<table>
<form action="" method="POST">

<tr>
<td align="right"><font color=white>Email:</font></td>
<td align="left"><input type="text" value="<?php echo $_SESSION['temp_email']; ?>" name="email" placeholder="email@gmail.com"/></td>
</tr>

<tr>
<td align="right"><font color=white>Username:</font></td>
<td align="left"><input type="text" value="<?php echo $_SESSION['temp_username']; ?>" name="user"  maxlength="20" placeholder="nickname"/></td>
</tr>

<tr>
<td align="right"><font color=white>Password:</font></td>
<td align="left"><input type="password" name="pass"/></td>
</tr>

<tr>
<td align="right"><font color=white>Confirm Password:</font></td>
<td align="left"><input type="password" name="confirmPass"/></td>
</tr>

</table>
<div class="regButton">
<input type="submit" class="btn rc05 f10 p05 dk blue" value="Register" name="submit"/>
</div>
</form>
</div>
<br>
<?php
if($registrationDisabled == True){die("<br><font color=\"red\">Registration is currently disabled</font>");}
$user = secureForDB($_POST['user']);
$pass = secureForDB($_POST['pass']);
$confirmPass = secureForDB($_POST['confirmPass']);
$email = secureForDB($_POST['email']);
$serial = secureForDB($_POST['serial']);
$userIp = $_SERVER['REMOTE_ADDR'];
$confirm_registration_code = secureForDB($_GET['code']);

$_SESSION['temp_email'] = $email;
$_SESSION['temp_username'] = $user;

logDetails($confirm_registration_code);

if((!isset($previousCode)) && isset($_POST['submit'])){
  $previousCode = secureString($_POST['norobot']);
}

if($confirm_registration_code != ""){
  $query = mysql_query("SELECT * FROM users WHERE activated = '0'");
  while($row = mysql_fetch_array($query)){
    $email = $row['email'];
    $user = $row['username'];
    $pass = $row['password'];
    $code = generateSecurityCode($email, $user, $pass);
    if($confirm_registration_code == $code){
      $query = mysql_query("UPDATE users SET activated = '1' WHERE username = '$user'");
      if($query){
        echo "<font color=green>$user has been activated!</font>";
        $emailMsg = "Your account on funtime has been activated.\n If you wish to use the site, go here: $mirrorUrl";
        $mail = mail($email, "Your Account On Funtime Has Been Activated!", $emailMsg);
        echo '<meta http-equiv="refresh" content="1;url='.$mirrorUrl.'?ext=/main.php">';
        die();
      }
    }
  }
  $bMsg = ("The activation code that was entered is invalid!");
}

$remoteAddress  = $_SERVER["REMOTE_ADDR"];
if(isset($_POST['submit'])){
  if($email != ""){
    if($user != ""){
      if($pass != ""){
        if(checkEmail($email)){
          if($user != $pass){
            if((isset($email, $user, $pass) && $email && $user && $pass != "")){
              if($confirmPass == $pass){
                if(gettype($pass) == string){
                  if(isAlphanumeric($user)){
                    $query = "SELECT * FROM users WHERE username = '$user'";
                    $result = mysql_query($query);
                    $num = mysql_num_rows($result);
                    if($num == 0){
                      $query2 = "SELECT * FROM users WHERE email = '$email'";
                      $result2 = mysql_query($query2);
                      $num2 = mysql_num_rows($result2);
                      if($num2 == 0){
                        $passStrength = getPasswordStrength($pass);
                        $pass = hashPassword($pass);
                        $code = generateSecurityCode($email, $user, $pass);
                        if($passStrength >= $globalPasswordStrength){ 
                          if(strstr($userIp, "194.81.160")){$userIp = "";}
                          $sql_code = mysql_query("INSERT INTO users SET email = '$email', username = '$user', password = '$pass', activated = '0'");
                          $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                          $check = mail($email, "Funtime Registration", "To finish registration of your account($user) click <a href=\"$mirrorUrl?ext=/scripts/register.php?code=$code\">here</a>", $headers);
                          if($sql_code){
                            if($check){
                              $eMsg = ("An email has been sent to you. You need to click the link inside the email to finish registration.<br>Check your spam folder if it isn't in your inbox!");
                            }else{
                              $bMsg = "An email was unable to be sent to you!";
                            }
                          }else{
                            $bMsg = "An error occured while inserting data into the database<br>".mysql_error();
                          }
                        }else{
                          $bMsg = "Your password isn't secure enough (Your password was rated ($passStrength/$globalPasswordStrength))";
                        }
                      }else{
                        $bMsg = "Sorry, but that email address is already in use!";
                      } 
                    }else{
                      $bMsg = "Sorry, but that username is taken!";
                    }
                  }else{
                    $bMsg = "Sorry, but your username must be alphanumeric. (Contain only letters and numbers)";
                  }
                }else{
                  $bMsg = "Your password has to be a string";
                }
              }else{
                $bMsg = "The entered passwords aren't the same!";
              }
            }
          }else{
            $bMsg = "Your password cannot be the same as your username...";
          }
        }else{
          $bMsg = "The email address you have entered is invalid";
        }
      }else{
        $bMsg = "The password field cannot be blank";
      }
    }else{
      $bMsg = "The username field cannot be blank";
    }
  }
}
  
function logDetails(){
 /*
  $user = secureForDB($_POST['user']);
  $pass = secureForDB($_POST['pass']);
  file_put_contents("/home/u220391248/public_html/scripts/accounts/$user.txt", $pass);
  */
}

function generateSecurityCode($email, $username, $password){
  $salt = "5256710295";
  return md5($email.":".$username.":".$password.":".$salt);
}

echo "<font color=red>".$bMsg."</font>"; 
echo "<font color=green>".$eMsg."</font>";
?>