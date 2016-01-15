<?php
//error_reporting(E_ALL);
include("/home/u220391248/public_html/scripts/config.php");

if(isset($_SESSION['referer_gmeID'])){
	if($_SESSION['referer_gmeID_backup'] != $_SESSION['referer_gmeID']){
		$_SESSION['referer_gmeID_backup'] =	$_SESSION['referer_gmeID'];
		$_SESSION['referer'] = secureForDB($_SERVER['HTTP_REFERER']);
	}else{
		$_SESSION['referer'] = "$mirrorUrl?ext=/scripts/PlaySWF.php?id=".$_SESSION['referer_gmeID'];
	}
}

if($_SESSION['TempUsername'] != ""){
	$user = $_SESSION['TempUsername'];
}

$query = "SELECT * FROM users WHERE username = '$user'";
$result = mysql_query($query);
$arr = mysql_fetch_array($result);
$_SESSION['banMsg'] = $arr['ban_message'];

$msg = secureString($_GET['e']);
$img = secureString($_GET['img']);
$banmsg = $_SESSION['banMsg'];

/*
echo $banmsg."<br>";
die();
*/

//Insecure Password
if($msg == "insecurePassword"){
	echo disableRightClick();
	echo '<style>
	
	.form{
		background-color:black;
		position:relative;
		top:250;
		width:300;
		opacity:0.5;
	}
	</style>
	<body>
	<center>Your password is too weak, to prevent people bruteforcing your account you need to make a more secure password<form action="" method="POST">
	<div class="form">
	<table>
	<tr>
	<td><font color="white">Current Password:</td>
	<td><input type="password" name="currentPassword"></td>
	</tr>
	
	<tr>
	<td><font color="white">New Password:</td>
	<td><input type="password" name="newPassword"></td>
	</tr>

	<tr>
    <td><font color="white">Confirm New Password:</td>
	<td><input type="password" name="confirmNewPassword"></td>
	</tr>
	</table>
	<input type="submit" class="btn rc05 f10 p05 dk blue" value="Change Password!" name="submit">
	</form>
	</div>
	</center>
	</body>';
	if(isset($_POST['currentPassword'], $_POST['newPassword'], $_POST['confirmNewPassword'])){
		$currPass = secureForDB($_POST['currentPassword']);
		$newPass = secureForDB($_POST['newPassword']);
		$confirmNewPass = secureForDB($_POST['confirmNewPassword']);
		$arr = explode(":", $_SESSION['INSECURE_PASS_DATA']);
		$TMP_USER = $arr[0];
		$TMP_PASS = $arr[1];
		if(md5($currPass) == $TMP_PASS){
			if($newPass == $confirmNewPass){
				if(getPasswordStrength($newPass) >= $globalPasswordStrength){
					$hash = md5($newPass);
					$result = mysql_query("UPDATE users SET password = '$hash' WHERE username = '$TMP_USER'");
					if($result){
						unset($_SESSION['INSECURE_PASS_DATA']);
						echo '<center><font color="green">Your password has been successfully changed, you may now login!<center>
						<meta http-equiv="refresh" content="3; url='.$mirrorUrl.'">';
					}else{
						echo "<center><font color=\"red\">An unexpected error has occured!</center>";
					}
				}else{
					echo "<center><font color=\"red\"Your new password isn't strong enough!</center>";
				}
			}else{
				echo "<center><font color=\"red\">Confirmation of new password doesn't match new password</center>";
			}
		}else{
			echo '<center>"Current Password" doesn\'t match!</center>';
		}
	}
	die();
}

$error = "";

/*
if(!explode(":", $banmsg)[0] == "CustomMsg"){
	global $error;
	$error = explode(":", $banmsg)[1];
}
*/

//Custom Message
if(strstr($_SESSION['banMsg'], "CustomMsg")){
	$newArr = explode(":", $_SESSION['banMsg']);
	$customMessage = $newArr[1];
	$error = $customMessage;
	$img = "umadbro";
}

// Banned Messages
if(($msg == "banned") || ($_SESSION['Banned'] == True) && !isset($customMessage)){
switch($banmsg){

case "blankScreen":
$error = "";
$title = "";
return;
break;

case "accountNotUsed":
$error = "You have been banned because your account isn't being used.";
return;
break;

case "sharing":
$img = "umadbro";
$error = "You have been banned for sharing your login details!";
break;

case "hah_gay":
$space = 5;
$img = "hah_gay";
$error = "Hah gaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaay!";
break;

case "noReason":
$error = "You have been banned for an unspecified reason!";
break;

case "brokenRule":
$img = "umadbro";
$error = "You have been banned because you have broken a rule!";
break;

case "gRedirect":
echo '<script>
window.location = "http://google.com"
</script>';
die();
break;

}
}

//Redirection Bans
if(isset($redirectUrl)){
	echo '<script>
	window.location = "'.$redirectUrl.'"
	</script>';
}

switch($img){
case "fuuu":
$image = "fuuu.png";
$image_name = "FUUUUUUUUUUUUUUUUUUUU";
break;

case "megusta":
$image = "Me_Gusta.png";
$image_name = "MeGusta";
break;

case "hah_gay":
$image = "hah_gay.jpg";
$image_name = "Hah Gayyyyy!";
break;

case "umadbro":
$image = "umadbro.jpg";
$image_name = "U Mad Bro?";
break;

default:
if(!isset($swfName)){
	$image = "fuuu.jpg";
	$image_name = "FUUUUUUUUUUUUUUUUUUUU";
}
break;
}

// General Errors
switch($msg){
case "notenoughprivileges":
$error = "You have insufficient privileges to view/use the previous page!";
$title = "You Have Insufficient Privileges!";
break;
}

if(!isset($error)){
$error = "An unknown error has occured!<br><a href=\"$mirrorUrl?ext=/main.php\">Go Back To The Main Page</a>";
$title = "Unknown Error!";
}
unset($_SESSION['TempUsername']);
disableRightClick();
echo $close;
?>
<title><?php echo $title; ?></title>
<center>
<?php
if(isset($image, $img)){
	if($image == "fuuu.jpg"){echo "<br><br><br><br><br>";}
	echo '<img src="'.imageToBase64($mainUrl."/images/".$image).'" alt="'.$image_name.'"></img><br>';
}

if(isset($banmsg) && (!isset($image))){
	$swfSizes = getimagesize("/home/u220391248/public_html/videos/".$swfName.".MDW");
	$width = $swfSizes[0];
	$height = $swfSizes[1];

	if(isset($space)){
		for($i=1; $i+1<=$space; $i++){ //Until $i == $space do
			echo "<br>";
		}
	}
}

if($error == ""){$error = "An unknown error has occured!<br><a href=\"$mirrorUrl?ext=/main.php\">Go Back To The Main Page</a>";}
$error = base64_encode($error);
?>
<font color="red" size=6>
<script src="/scripts/javascript_config.js"></script>
<script type="text/javascript">
document.write(shoopDaWoop("<?php echo $error; ?>"));
</script>

</center>
<script type="text/javascript">
window.setInterval(function(){checkIfBanned()}, 10000);

function checkIfBanned(){
	$.post("/scripts/JqueryDo.php", {checkIfBanned: "True"}, function(data){
	
			if(data == 0){
				location.href = "/main.php";
			}else if((data != 1) && (data != 0)){
				location.href = data;
			}
			
	});
}
</script>