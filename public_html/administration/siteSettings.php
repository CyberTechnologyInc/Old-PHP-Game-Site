<?php
session_start();
include("/home/u220391248/public_html/scripts/config.php");
checkIfAdmin();
checkIfBanned();

if(isset($_POST['submit'])){
  $registrationDisabled = secureForDB($_POST['registrationDisabled']);
  if(mysql_query("UPDATE websiteSettings SET registrationDisabled = '$registrationDisabled'")){
    $msg = "Your settings have been saved!";
  }else{
    $msg = "Your settings haven't bene saved!";
  }
}
echo $menu;
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>

<style>
.form{
  position:relative;
  top:250;
  background-color:black;
  width:330;
  margin:5;
  padding:5;
}

.msg{
  position:relative;
  top:255;
}
</style>

<center>
<div class="form">
<form action="" method="POST">
<table>
  <tr>
  <td><font color="white">Disable Registration(1:0):</font></td>
  <td><input type="text" name="registrationDisabled"></td>
  </tr>
</table>
<input type="submit" name="submit" value="Save Settings">
</form>
</div>
<?php echo "<div class=\"msg\">".$msg."</div>"; ?>
</center>