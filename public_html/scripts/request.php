<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfLoggedIn();
checkIfBanned();

if(isset($_POST['submit'])){
	$name = secureForDB($_POST['name']);
	$url = secureForDB($_POST['url']);
	$email = getUserData($user, "email");
	$date = date("dS F Y");
	mysql_query("INSERT INTO requests SET username = '$user', email = '$email', game_name = '$name', game_url = '$url', date = '$date'");
}

$form = base64_encode('<style>
.form{
	position:relative;
	top:250;
	width:300;
	margin:5;
	padding:5;
	background-color:black;
}
</style>
<center>
<div class="form">
<form action="" method="POST">
<table>
<tr>
<td><font color="white">Game Name:</font></td>
<td><input type="text" name="name"></td>
</tr>

<tr>
<td><font color="white">SWF/Game Url:</font></td>
<td><input type="text" name="url"></td>
</tr>
</table>
<input type="submit" name="submit" value="Send Request!">
</form>
</div>
</center>');

echo $menu;
?>
<script>
document.write(shoopDaWoop("<?php echo $form; ?>"));
</script>