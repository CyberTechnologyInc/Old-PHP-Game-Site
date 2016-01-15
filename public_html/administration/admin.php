<?php
session_start();
include("/home/u220391248/public_html/scripts/config.php");
checkIfAdmin();
checkIfBanned();
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
  
.a:link{color:#ffffff;}
.a:visited{color:#ffffff;}
</style>
<div class="content">
<?php echo $menu; ?>
<center>
<table>
  
  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/siteSettings.php">Site Settings</a><br>
  </tr>

  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/checkRequests.php">Check Requests</a><br>
  </tr>

  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/emailUsers.php">Email All Users</a><br>
  </tr>
  
  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/gmeList/update_gme_db.php">Update Gme DB</a><br>
  </tr>
  
  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/promoteDemote.php">Promote/Demote User</a><br>
  </tr>

  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/changeUserDetails.php">Change User Details</a><br>
  </tr>
  
  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/swfgrabber.php">SWF Grabber</a><br>
  </tr>

  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/ban.php">Ban/Unban Users</a><br>
  </tr>
  
  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>?ext=/administration/viewlogs.php">View Logs</a><br>
  </tr>
</table>
</center>
</div>