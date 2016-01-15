<?php
session_start();
include("/home/u220391248/public_html/scripts/config.php");
checkIfAdmin();
disableRightClick();
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<?php 
echo $menu;
echo "<center>".$adminPanel."</center>";
?>
<style>  
  .title{
  padding: 5;
  }

  .form{
  width:250;
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
  <font color=white>Send Email To:</font><select name="whoToSendTo">
  <option value="everyUser">Every User</option>
  <option value="moderators">Moderators</option>
  <option value="bannedMembers">Banned Members</option>
  </select>
  </tr>

  <tr>
    <td><font color=white>Subject:</font></td><td><input type="text" name="subject"><br></td>
  </tr>
  
  <tr>
    <td><font color=white>Body:</font></td><td><textarea name="body" style="margin: 0px; height: 140px; width: 159px; "></textarea><br></td>
  </tr>
</table>
<div class="btn">
<input type="submit" class="btn rc05 f10 p05 dk blue" name="submit" value="Send Email!">
</div>
</form>

<?php
//Only if the option "Banned Members" is chosen then the banned members will get an email sent to them.
if(isset($_POST['submit'])){
  $option = SecureString($_POST['whoToSendTo']);
  $subject = SecureString($_POST['subject']);
  $body = SecureString($_POST['body']);
  $i = 0;
  
  if($option == "everyUser"){
    $query = mysql_query("SELECT * FROM users WHERE banned = 'false'");
  }
  
  if($option == "moderators"){
    $query = mysql_query("SELECT * FROM users WHERE banned = 'false' && account_position = 'Mod'");
  }
  
  if($option == "bannedMembers"){
    $query = mysql_query("SELECT * FROM users WHERE banned = 'true'");
  }
  
  $email = array();
  while ($row = mysql_fetch_array($query)){
    $email[] = $row['email'];
  }
  
  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
  foreach($email as $sendTo){
    $success = mail($sendTo, $subject, $body, $headers);
    $i++;
  }
  if($success){$gMsg = $i." Emails have been sent!";}
}
echo '<div class="eMsg"><font color=red>'.$eMsg.'</font></div>';
echo '<div class="gMsg"><font color=green>'.$gMsg.'</font></div>'; 
?>
  </body>
<center>