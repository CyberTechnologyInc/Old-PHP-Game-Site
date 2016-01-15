<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfBanned();
checkIfLoggedIn();
disableRightClick();
?>
<title><?php echo "$title"; ?></title>
<div class="content">
<?php echo "$menu"; ?>
<style type="text/css">
.content {
padding: 5;
}

.changePassword {
padding: 5;
background-color: black;
width: 298;
}

.email {
padding: 5;
background-color: black;
width: 298;
}

.GPP {
padding: 5;
background-color: black;
width: 298;
}

.backgroundUrlDiv{
padding: 5;
background-color: black;
width: 298;
}

.confirm {
padding: 5;
background-color: black;
width: 298;
}
</style>
<center>
<font color=white>You're currently logged in as <u><b><?php echo $user; ?></b></u><br></font>
<?php
$query = mysql_query("SELECT * FROM users WHERE username = '$user'");
$arr = mysql_fetch_array($query);
$email = $arr['email'];
$account_position = $arr['account_position'];

if(isset($email)){
  echo "<font color=white>Your current email address is: <b><u>".$email."</u></b>";
}else{
  echo "<br><font color=white>You don't currently have an email address. So if you ever forget your password,<br>
  We can't send you a password recovery email to reset your password.</font>";
}
?>
<br>
<br>
<form action="" method="POST">
<?php
$showViews = $_SESSION['showViews'];
if($showViews == True){
  echo '<input type="submit" name="showPlays" class="btn rc05 f10 p05 dk blue" value="Don\'t Show Amount Of Plays"><br><br>';
}else{
  echo '<input type="submit" name="showPlays" class="btn rc05 f10 p05 dk blue" value="Show Amount Of Plays"><br><br>';
}
?>

<u><font color="white">Change the default background image</font></u>
<div class="backgroundUrlDiv">
<table>
<tr>
<td><font color="white">Image Url: </font></td>
<td><input type="text" name="backgroundUrl"></td>
</tr>
</table>
<input type="submit" class="btn rc05 f10 p05 dk blue" value="Save Background Image" name="saveBackgroundUrl">
</div>
<br>

<?php
if(isset($_POST['showPlays'])){
  if($showViews == True){
    $showViews = False;
  }else{
    $showViews = True;
  }
  $_SESSION['showViews'] = $showViews;
  mysql_query("UPDATE users SET showViews = '$showViews' WHERE username = '$user'");
  redirect(0, "settings.php");
}
$GPPform = base64_encode('<u><font color="white">Change how many games are listed on each page</font></u><div class="GPP"><table><tr><td><font color="white">Games Per Page: </font><input type="text" value="'.$userDetails['gamesPerPage'].'" name="amountPerPage"></td></tr></table><input type="submit" class="btn rc05 f10 p05 dk blue" name="perPage" value="Set Amount Of Games Per Page"></tr><br></div>');
?>
<script type="text/javascript">
document.write(shoopDaWoop("<?php echo $GPPform; ?>"));
</script>

</form>
<br>
<font color=black>
<u><font color="white">Change the email asscociated with your account</font></u>
<form action="" method="POST">
<div class="email">
<table>
<tr>
<td align="right"><font color="white">Email: </font></td>
<td align="left"><input type="text" name="email"/></td>
</tr>
</table>
</div>

<br>

<u><font color="white">Change the password asscociated with your account</font></u>
<div class="changePassword">
<table>
<tr>
<td align="right"><font color="white">New Password: </font></td>
<td align="left"><input type="password" name="pass"/></td>
</tr>
</table>
</div>

<br>

<u><b><font color="white">Confirm All Of Your Actions</font></b></u>
<div class="confirm">
<center>
<table>
<tr>
<td align="right"><font color="white">Current Password:</font></td>
<td align="left"><input type="password" name="currpass"/></td>
</tr>
</table>
<input type="submit" class="btn rc05 f10 p05 dk blue" id="confirm" value="Confirm Actions" name="cnfrm"/>
</div>
</form>
</font>
<br><br>

<?php
$query = mysql_query("SELECT * FROM users WHERE username = '$user'");
$arr = mysql_fetch_array($query);
$p0 = $arr['username']; // Username
$p1 = $arr['password']; // Password

$bg = secureForDB($_POST['backgroundUrl']);
if((isset($_POST['saveBackgroundUrl'])) && ($bg == "")){
  $sets = getUserData($user, "settings");
  if(!$sets == ""){
    $sets = str_replace("BG:".getUserSetting($user, "BG"), "");
  }
  mysql_query("UPDATE users SET settings = '$sets' WHERE username = '$user'");
}elseif((isset($_POST['saveBackgroundUrl'])) && (!$bg == "")){
  $sets = getUserData($user, "settings");
  $sets = str_replace("BG:".getUserSetting($user, "BG"), "BG:".$bg.";", $sets);
  mysql_query("UPDATE users SET settings = '$sets' WHERE username = '$user'");
}

if((remote_file_exists($bg)) && (strstr($bg, "http://"))){
  $sets = getUserData($user, "settings");
    if($sets == ""){
      mysql_query("UPDATE users SET settings = 'BG~$bg;' WHERE username = '$user'");
    }else{
      mysql_query("UPDATE users SET settings = '$sets;BG~$bg;' WHERE username = '$user'");
   }
}


$confirmpass = secureString($_POST['currpass']);
$pass = md5(secureForDB($_POST['pass']));
$email = secureForDB($_POST['email']);
if(isset($_POST['cnfrm'])){
if(isset($confirmpass)){
  if(md5($confirmpass) == $p1){
    
    if($pass != ""){ // Change password
    mysql_query("UPDATE users SET password = '$pass' WHERE username = '$user'");
        echo "<center><font color=green>The password for your account
        has been changed!</font></center>";
      }
    
      if(isset($email) && checkEmail($email)){ // Change email address
        $query = mysql_query("UPDATE users SET email = '$email' WHERE username = '$user'");
        echo "If you ever forget your password, you can now use the password reset feature.<br> Just click the link that says \"Forgot Password?\" on the login page.";
      }elseif($email != ""){
        echo "<font color=red>The email address you have entered is invalid!</font>";
      }
    
  }else{
    die("<center><font color=red>The password you have entered is invalid!</font></center>");
  }
}
}

if(isset($_POST['perPage'])){
  $amountPP = secureForDB($_POST['amountPerPage']);
  mysql_query("UPDATE users SET gamesPerPage = '$amountPP' WHERE username = '$user'");
  redirect(0, "settings.php");
}
?>
</center>