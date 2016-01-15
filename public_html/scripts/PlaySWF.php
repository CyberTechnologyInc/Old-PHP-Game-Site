<?php
include("/home/u220391248/public_html/scripts/config.php");
error_reporting(0);
$user = $_SESSION['CurrentUser'];
$id = secureForDB($_GET['id']);
$playAnotherRandomGame = secureForDB($_GET['randomGameBtn']);

if($id == 0){
	header("Location: /main.php");
	return;
}

checkIfLoggedIn();
checkIfBanned();

$query = mysql_query("SELECT * FROM gmes WHERE id = '$id'");
$arr = mysql_fetch_array($query);
$name = $arr['filename'];
$gme_type = $arr['type'];
$shockwaveUrl = "http://dl.dropboxusercontent.com/u/88620415/swf_files/shockwave/";
$mainUrl = "http://dl.dropboxusercontent.com/u/88620415/swf_files/";

switch($gme_type){
	case "flash":
	//Carry on
	break;

	case "shockwave":

	break;

	case "java":
	header("Location: JVA-GME.php?id=$id");
	return;
	break;

	default:
	die("<center><font color=red>Error! Contact the owner about an invalid link</font></center>");
	break;
}

$width = 0;
$height = 0;
$wmodeDirect = false;
if($gme_type == "shockwave"){
	$gme = $shockwaveUrl."$name.MDR";
	$details = getimagesize($gme);
	$width = $details[0];
	$height = $details[1];
}elseif($gme_type == "flash"){
	$gme = $mainUrl."$name.MDW";
	$details = getimagesize($gme);
	$width = $details[0];
	$height = $details[1];
}
disableRightClick();
?>
<title><?php echo "$title"; ?></title>
<!-- <body onload="pageLoad();"> -->
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
.content {
padding: 5;
}

.btn{
margin:3;
}

.tagsMenu{
width:230;
background: black;
margin:5;
padding:5;
}
</style>
<center>
<div class="content">
<font size=4 color=white>
<?php 
$query = mysql_query("SELECT * FROM gmes WHERE filename = '$name'");
$gme_name = mysql_fetch_array($query);
$id = $gme_name['id'];
$gme_name = '<center><u><font size=6 color=white>'.$gme_name['gme_name'].'</font></u></center>';
echo $menu;
$gme_name = base64_encode($gme_name);

//Game height and width
	switch($id){
		case "118": //FFX Runner
		$width = 640;
		$height = 480;
		break;
		
		case "189": //Mini Dash
		$width = 800;
		$height = 533;
		$wmodeDirect = True;
		break;

		case "2": //54 Dead Miles
		$width = 640;
		$height = 480;
		break;

		case "282": //Street Sesh
		$width = 560;
		$height = 430;
		break;
	
		/*
		case "327":
		$width = 700;
		$height = 525;
		$wmodeDirect = True;
		break;	
        */

		case "346": //Get On Top
		$width = 640;
		$height = 384;
		break;
	}

if($gme_type == "shockwave"){
	$gmeLauncher = base64_encode('
	<object width="'.$width.'" height="'.$height.'" classid="clsid:166B1BCA-3F9C-11CF-8075-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/director/sw.cab#version=7,0,2,0">
    <param name="src" value="'.$shockwaveUrl."$name.MDR".'" />
    <embed src="'.$shockwaveUrl."$name.MDR".'" width="'.$width.'" height="'.$height.'" type="application/x-director" />
	</object>');
}else{
	if($wmodeDirect == True){
		$gmeLauncher = base64_encode('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$width.'" height="'.$height.'" align="middle"><param name="movie" wmode="direct" value="'.$mainUrl.$name.'.MDW"><param name="quality" value="high"><param name="AllowScriptAccess" value="always"><embed src="'.$mainUrl.$name.'.MDW" quality=high width="'.$width.'" height="'.$height.'" name="'.$mainUrl.$name.'.MDW" wmode="direct" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>');
	}else{
		$gmeLauncher = base64_encode('<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="'.$width.'" height="'.$height.'" align="middle"><param name="movie" value="'.$mainUrl.$name.'.MDW"><param name="quality" value="high"><param name="AllowScriptAccess" value="always"><embed src="'.$mainUrl.$name.'.MDW" quality=high width="'.$width.'" height="'.$height.'" name="'.$mainUrl.$name.'.MDW" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed></object>');
	}
}

$array = mysql_fetch_array(mysql_query("SELECT * FROM gmes WHERE id = '$id'"));
$views = $array['views'];
if($views == ""){
	mysql_query("UPDATE gmes SET views = '0' WHERE id = '$id'");
}

$views = $array['views'] + 1;
mysql_query("UPDATE gmes SET views = '$views' WHERE id = '$id'");

if($_SESSION['referer_gmeID'] != $id){
	$_SESSION['referer_gmeID'] = $id;
}
?>
<div id="gme">
<script type="text/javascript">
function pageLoad(){
	//Todo
}
//document.write(shoopDaWoop("<?php echo $gme_name; ?>"));
//document.write(shoopDaWoop("<?php echo base64_decode($gmeLauncher); ?>"));
</script>
<?php echo base64_decode($gmeLauncher); ?>
</div>
<a id="addToFavourites" href="javascript:addToFav();"><font color=gold>Add To My Favourites List</font></a> <a id="reportBroken" href="javascript:reportBroken();"><font color=gold>Report As Broken</font></a><?php if($playAnotherRandomGame == "true"){echo ' - <a href="'.$mirrorUrl.'?ext=/scripts/randomGame.php"><font color="gold">Play Another Random Game</font></a>';} ?>
<script type="text/javascript">
window.setInterval(function(){checkIfBanned()}, 5000);

function checkIfBanned(){
	$.post("/scripts/JqueryDo.php", {checkIfBanned: "True"}, function(data){
		
		if(data == 1){
			location.href = "/error.php?e=banned";
		}
		
	});
}

function addToFav(){
	var $gmeID = "<?php echo $id; ?>";
	document.getElementById("addToFavourites").innerHTML = "Awaiting response...";
	$.post("/scripts/JqueryDo.php", {gmeID: $gmeID, addToFav: "True"}, function(data){
		if(data == "True"){
			document.getElementById("addToFavourites").innerHTML = "";
		}else if(data == "alreadyAdded"){
			document.getElementById("addToFavourites").innerHTML = "This game is already in your favourites list";
		}else{
			document.getElementById("addToFavourites").innerHTML = 'Add To My Favourites List';
		}
	});
}

function reportBroken(){
	var $gmeID = "<?php echo $id; ?>";
	var $user = "<?php echo $user; ?>";
	document.getElementById("reportBroken").innerHTML = "Awaiting response...";
	$.post("/scripts/JqueryDo.php", {gmeID: $gmeID, reportBroken: "True"}, function(data){
		if(data == "True"){
			document.getElementById("reportBroken").innerHTML = "";
		}else{
			document.getElementById("reportBroken").innerHTML = '<a id="reportBroken" href="javascript:reportBroken();"><font color=gold>Report As Broken</font></a>';
		}
	});
}
</script>
</div>
</center>