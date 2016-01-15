<?php

include("/home/u220391248/public_html/scripts/config.php");

checkIfLoggedIn();
checkIfBanned();
disableRightClick();

//window.setInterval(function(){checkIfBanned()}, 10000);
?>

<?php  ?>
<title><?php echo "$title"; ?></title>
<style type="text/css">
.title{
padding: 5;
}

#ban:link{color:#FF0000;}
#ban:visited{color:#FF0000;}
</style>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<div class="content">
<?php
echo "$menu";
if($_SESSION['account_position'] == "Admin"){
	echo '<center><font color=blue><a id="ban" href="/administration/ban.php">Ban Users</a></font></center></div>';
}
?>
<center>
<iframe frameborder="0" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" src="/chat/index.php"></iframe>
</center>
<div class="banUsers"></div>