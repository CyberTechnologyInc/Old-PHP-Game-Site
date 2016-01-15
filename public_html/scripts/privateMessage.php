<?php
include("/home/u220391248/public_html/scripts/config.php");
$rid = secureForDB($_GET['rid']);
if(is_numeric($rid)){
	$query = mysql_query("SELECT * FROM users WHERE id = '$rid'");
	$arr = mysql_fetch_array($query);
	$rid = $arr['username'];
}
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<?php echo $menu; ?>
<style>
  .title{
  padding: 5;
  }
  
  .form{
  width:510;
  height:320;
  background-color:black;
  position:relative;
  left:auto;
  top:160;
  }
  
  .eMsg{
  position:relative;
  left:0;
  right:0;
  margin-left:auto;
  margin-right:auto;
  left:auto;
  top:400;
  }
  
  .btn{
  margin:3;
  }
</style>
<center>
<div class="form">
<form method="POST" action="">
<table>
	<tr>
	<td><font color=white>Send PM To:</font>
	<input type="text" value="<?php echo $rid; ?>" name="name"></td>
	</tr>
	
	<tr>
		<td><textarea name="body" style="margin: 3px; height: 250px; width: 500px; "></textarea><br></td>
	</tr>
</table>
<div class="btn">
<input type="submit" class="btn rc05 f10 p05 dk blue" name="submit" value="Send PM!">
</div>
</form>

<?php
if(isset($_POST['submit'])){
	$name = secureForDB($_POST['name']);
	
	if(is_numeric($name)){
		$query = mysql_query("SELECT * FROM users WHERE id = '$name'");
		$arr = mysql_fetch_array($query);
		$name = $arr['username'];
	}
	$query = mysql_query("SELECT * FROM users WHERE username = '$name'");
	$arr = mysql_fetch_array($query);
	$email = $arr['email'];
	$subject = 'You have recieved a PM from '.$user.'';
	$body = secureString($_POST['body']);
	$body .= '<br>----------<br>To reply to this PM, go <a href="'.$mirrorUrl.'?ext=/scripts/privateMessage.php?rid='.$userDetails['id'].'">here</a>';
	$headers = "Content-Type: text/html;";
	$success = mail($email, $subject, $body, $headers);
	if($success){$gMsg = "A PM to $name has been sent!";}
}
echo '<br><div class="eMsg"><font color=red>'.$eMsg.'</font></div>';
echo '<br><div class="gMsg"><font color=green>'.$gMsg.'</font></div>'; 
?>
  </body>
<center>