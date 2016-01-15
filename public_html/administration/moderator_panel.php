<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfModOrAdmin();
checkIfBanned();
?>
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
<font color="red"><b>Changing your own/someone elses name for a stupid reason will result in a ban/derank</b></font><br>
<table>
  <tr>
    <a class="a" href="<?php echo $mirrorUrl; ?>/?ext=/administration/viewlogs.php">View Logs</a><br>
  </tr>
  
  <tr>
  <a class="a" href="<?php echo $mirrorUrl; ?>/?ext=/administration/ban.php">Ban/Unban Users</a><br>
  </tr>
  
  <tr>
  <a class="a" href="<?php echo $mirrorUrl; ?>/?ext=/administration/changeUserDetails.php">Change User Details</a><br>
  </tr>
</table>
</center>
</div>