<?php
include("/home/u220391248/public_html/scripts/config.php");
$user = secureForDB($_POST['user']);

if($_SESSION['Banned'] == True){
	header("Location: /error.php?e=banned&img=fuuu");
	return;
}
echo '<style>body{background-image: url('.imageToBase64($background).');}</style>';
disableRightClick();
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
<style type="text/css">
.menu {
border-style:dashed;
width:270;
background-color:black;
position:relative;
top:260;
}

.menutwo {
border-style:dashed;
width:320;
background-color:black;
position:relative;
top:260;
}

.bMsg {
position:relative;
top:260;
}

.sub1 {
margin:3;
}

.sub2 {
margin:3;
}
</style>
<center>
<a href="/login.php">Login</a>
</center>
<?php
if(!isset($_GET['code'])){
	echo '<center>
	<div class="menu">
	<table>
	<form action="" method="POST">
	<tr>
	<td align="right"><font color=white>Username:</font></td>
	<td align="left"><input type="text" name="user"/></td>
	</tr>
	</table>
	<div class="sub1">
	<input type="submit" class="btn rc05 f10 p05 dk blue" value="Reset Password" name="resetpass"/>
	</div>
	</form>
	</div>
	</center>';
}

if(isset($_POST['resetpass'])){
	if($user != ""){
		$query = mysql_query("SELECT * FROM users WHERE username = '$user'");
		$query1 = mysql_num_rows($query);
		if($query1 == 1){
			$arr = mysql_fetch_array($query);
			$email = $arr['email'];
			$success = True;
		}
		
		$maskedEmail = maskEmail($arr['email'], "*");
		$genCode = generateCode();
		if($success){
			$query = mysql_query("INSERT INTO reset_pass SET code = '$genCode', username = '$user'");
			if($query){
				$emailMsg = 'Hello '.$user.'.<br> If you wish to reset your password click <a href="'.$mirrorUrl.'?ext=/scripts/resetpass.php?code='.$genCode.'">here</a>';
				$headers = 'Content-type: text/html; charset=iso-8859-1';
				$sentEmail = mail($email, "Password Reset For $user", $emailMsg, $headers);

				if($sentEmail){
					echo "<center><font color=green>An email has been sent to $maskedEmail!<br>The email may take up to 10 minutes to show up. Make sure you check your spam folder!</font></center>";
				}else{
					echo "<center><font color=red>An unexpected error has occured while trying to send the email...</font></center>";
				}
			}else{
				echo '<div class="bMsg"><center><font color=red></font></center></div>';
			}
		}else{
			die('<div class="bMsg"><center><font color=red>We\'re sorry, but the user "'.$user.'" doesn\'t exist.</font></center></div>');
		}	
	}
}

if(isset($_GET['code'])){
	$code = $_GET['code'];
	if($code != ""){
		$query = mysql_query("SELECT * FROM reset_pass WHERE code = '$code'");
		$check = mysql_num_rows($query);
		if($check == 1){
			echo '<center>
			<div class="menutwo">
			<table>
			<form action="" method="POST">
			
			<tr>
			<td><font color=white>New Password:</font></td>
			<td><input type="password" name="newpassword"/></td>
			</tr>
			
			<tr>
			<td><font color=white>Confirm New Password:</font></td>
			<td><input type="password" name="confirmpass"/></td>
			</tr>
			
			</table>
			<div class="sub2">
			<input type="submit" class="btn rc05 f10 p05 dk blue" value="Change Password" name="newpass"/>
			</div>
			</form>
			</div>
			</center>';
			
			if(isset($_POST['newpassword'])){
				if(secureForDB($_POST['confirmpass']) == ($_POST['newpassword'])){
					$passStrength = getPasswordStrength(secureForDB($_POST['newpassword']));
					if($passStrength >= $globalPasswordStrength){
						$newPass = hashPassword(secureForDB($_POST['newpassword']));
						$query = mysql_query("SELECT * FROM reset_pass WHERE code = '$code'");
						$arr = mysql_fetch_array($query);
						$user = $arr['username'];
						$check = mysql_num_rows($query);
						if($check == 1){
							$update = mysql_query("UPDATE users SET password = '$newPass' WHERE username = '$user'");
							if($update){
								mysql_query("DELETE FROM reset_pass WHERE code = '$code'");
								echo "<center><font color=green>The password to your account has been reset!<br>You may now login with your new 	password.</font></center>";
								redirect(3, "/login.php");
							}
						}else{
							echo '<div class="bMsg"><center><font color=red>An unexpected error has occured!</font></center></div>';
						}
					}else{
						$bMsg = '<div class="bMsg"><center>Your password isn\'t secure enough, it has to be bigger than or equal to 3 (Your password was rated '.$passStrength.')</center></div>';
					}
				}else{
					echo '<div class="bMsg"><center><font color=red>The entered passwords don\'t match!</font></center></div>';
				}
			}
		}else{ // If the code isn't in the db...
			die('<div class="bMsg"><center><font color=red>Password reset code has expired!<br>If you want to reset the password to your account. Go <a href="resetpass.php">here</a></font></center></div>');
		}
	}
}
?>