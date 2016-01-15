<?php

include("/home/u220391248/public_html/scripts/config.php");

$user = $_SESSION['CurrentUser'];
$id = secureString($_GET['id']);

$query = mysql_query("SELECT * FROM gmes WHERE id = '$id'");
$arr = mysql_fetch_array($query);
$name = $arr['filename'];

if((!file_exists($mainUrl."/JVA - files/$name.jar") || ($name == ""))){
die("<center><font color=red>Error! Contact owner about invalid link</font></center>");
}
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
<center>
<div class="content">
<?php echo "$menu"; ?>
<?php
$baseUrl = "http://cybertechnologyinc.x10.bz/JVA%20-%20files/";
switch($name){ // Select gme to load
	case "mincrft":
	$mincrft = $baseUrl."mincrft.jar?v=1357737036000";
	break;
	
	case "runescpe07":
	echo '<applet name=oldscape id=game width="765px" height="503px" alt="For assistance please visit the FAQ page" archive=gamepack_9650549.jar code=client.class mayscript>';
	break;
}


// Mincrft Stuff
if($name == "mincrft"){
	if(isset($_POST['setUser'])){
		$mcUsername = secureString($_POST['inputName']);
	}

	if($mcUsername != ""){
		echo "<div class=\"info\"> 
			<applet code=\"net.minecraft.Launcher\" archive=\"$mincrft\" codebase=\"/game/\" width=\"854\" height=\"480\">  
			<param name=\"separate_jvm\" value=\"true\"/> 
			<param name=\"java_arguments\" value=\"-Xmx1024M -Xms1024M -Dsun.java2d.noddraw=true -Dsun.awt.noerasebackground=true -Dsun.java2d.d3d=false -Dsun.java2d.opengl=false -Dsun.java2d.pmoffscreen=false\"> 
			<param name=\"latestVersion\" value=\"1363862534000\"> 
			<param name=\"downloadTicket\" value=\"0\">
			<param name=\"sessionId\" value=\"0\">
			<param name=\"userName\" value=\"$mcUsername\"> </applet>";
	}else{
		echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<form action="" method="post">
				<center>
					<input name="inputName" type="text" maxlength="16"/>
					<input type="submit" name="setUser" value="Set Username"/>
				</center>
			</form>';
	}
}
?>
</div>
</center>