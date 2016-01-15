<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfModOrAdmin();
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
.content {
padding: 5;
}
</style>
<div class="content">
<?php echo $menu; ?>
<center>
<?php if($_SESSION['account_position'] == "Admin"){echo $adminPanel;}elseif($_SESSION['account_position'] == "Mod"){echo $modPanel;} ?>
<br>
<style type="text/css">
.menu {
padding: 5;
background-color: black;
display: inline-block;
}

.subBtn {
padding:3;
}
</style>
<div class="menu">
<table>
<form action="" method="POST">
<tr>
<td><font color=white>Username:</font></td>
<td><input type="text" value="<?php echo secureString($_POST['user']); ?>" name="user"></td>
</tr>

<tr>
<td><font color=white>New Username:</font></td>
<td><input type="text" name="newUsername"></td>
</tr>

<tr>
<td><font color=white>New Password:</font></td>
<td><input type="password" name="password"></td>
</tr>

<td><font color=white>New Email Address:</font></td>
<td><input type="text" name="email"></td>

</table>
<div class="subBtn">
<input type="submit" class="btn rc05 f10 p05 dk blue" value="Change Details" name="submit"/>
</div>
</table>
</div>
</form>

<?php
if(isset($_POST['submit'])){
$username = secureForDB($_POST['user']);
$password = hashPassword(secureForDB($_POST['password']));
$email = secureForDB($_POST['email']);
$somethingChanged = false;
$id = getUserData($username, "id");
$newUsername = secureForDB($_POST['newUsername']);
$newMail = "";
$newPassword = "";
	
  if(!$_SESSION['account_position'] == "Admin"){
    if($_SESSION['CurrentUser'] == $username){
      die("<font color=\"red\">You cannot edit your own details</font>");
    }
  }
  if(getUserData($username, "account_position") == "Admin"){die("<br><font color=\"red\">You cannot edit an administrator's details.</font>");}
  if(isset($user)){
    $query = mysql_query("SELECT * FROM users WHERE username = '$username'");
    if($query){
      $query2 = mysql_query("UPDATE users SET password = '$password' WHERE username = '$username'");
      if($query2){
        echo "<font color=green><center>$username's password has been changed!</center></font>";
		$newPassword = secureForDB($_POST['password']);
		$somethingChanged = true;
      } 
      
      if($email != ""){
        $query2 = mysql_query("UPDATE users SET email = '$email' WHERE username = '$username'");
        if($query2){
          echo "<font color=green><center>$username's email address has been changed!</center></font>";
		  $newMail = $email;
		  $somethingChanged = true;
        }
      }
      
      if($newUsername != ""){
        $query = mysql_query("UPDATE users SET username = '$newUsername' WHERE username = '$username'");
        if($query){
          echo "<font color=green><center>$username's new username is now: $newUsername</center></font>";
			$somethingChanged = true;
        }
      }
    }
  }
	if($somethingChanged){
		$msg = "Your new details on funtime are as follows:<br>";
		if(!$newUsername = ""){
			$msg .= "New Username: $newUsername<br>";
		}
		if(!$newMail = ""){
		   $msg.= "New Email: $newMail<br>";
		}
		if(!$newPassword = ""){
			$msg .= "New Password: $newPassword<br>";
		}
		$headers = 'Content-type: text/html; charset=iso-8859-1';
		echo $msg;
		$mail = mail($email, "Your Account Details Have Changed", $msg, $headers);
		if($mail){
			echo "An email has been sent to the user to inform them of your changes.";
		}
	}
}
?>

</center>
</div>