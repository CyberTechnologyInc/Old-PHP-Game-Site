<?php
include("/home/u220391248/public_html/scripts/config.php");
$_SESSION['TempUsername'] = "";
checkIfLoggedIn();
disableRightClick();
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

.title{
margin:5;
}
</style>
<?php echo $menu; ?>
<div class="content">
<font color=white>
<?php
if(isset($_GET['tag'])){
	$tag = secureForDB($_GET['tag']);
	if($tag == ""){die("<center><font color=red>Derp, you haven't entered a tag...</font></center>");}
	$query = mysql_query("SELECT * FROM gmes WHERE tags LIKE '%$tag%' ORDER BY gme_name");
	
	while($row = mysql_fetch_array($query)){
		$tags = $row['tags'];
		$tags = explode(";", $tags);
		$id = $row['id'];
		foreach($tags as $item){
			if($item == $tag){
				$list .= $id.";";
			}
		}
	}
	
	$list = explode(";", $list);
	foreach($list as $fuq){
		$query = mysql_query("SELECT * FROM gmes WHERE id = '$fuq'");
		while($row = mysql_fetch_array($query)){
			$gme_name = $row['gme_name'];
			$id = $row['id'];
			$views = $row['views'];
			
			if($views >= 2){
				$viewOrViews = "Views";
			}elseif($views == 1){
				$viewOrViews = "View";
			}else{
				$viewOrViews = "Views";
			}
		
			if($views == ""){
				mysql_query("UPDATE gmes SET views = '0' WHERE id = '$id'");
			}
			
			if(($userDetails['showViews'] == True) && $views != 0){
				$gmeList .= '<li><a href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$id.'" style="color: #CCCCCC">'.$gme_name.'</a> '.$views.' '.$viewOrViews.'<br></li>';
			}else{
				$gmeList .= '<li><a href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$id.'" style="color: #CCCCCC">'.$gme_name.'</a><br></li>';
			}
		}
		if($query){
			$count++;
		}
	}
$gmeList = base64_encode($gmeList);
}else{
	echo 'Find Games With The Tag:';
	sort($acceptableTags);
	foreach($acceptableTags as $item){
		$gmeList .= base64_encode('<li><a href="'.$mirrorUrl.'?ext=/categorize.php?tag='.$item.'" style="color: #CCCCCC">'.$item.'</a></li>');
	}
}
?>
<script src="/scripts/jquery.js"></script>
<script type="text/javascript">
document.write(shoopDaWoop("<?php echo $gmeList; ?>"));
</script>
</font>
</div>
<center>
<div class="title">
<?php
if(($count == 0) && isset($tag)){die("<center><font color=red>There are no games with that tag yet.</font></center>");}
$data = base64_encode('<font size=4 color=white><a href="'.$mirrorUrl.'?ext=/scripts/privateMessage.php" target="_self" class="btn rc05 f10 p05 dk blue">PM Another Member</a> <a href="'.$mirrorUrl.'?ext=/settings.php" target="_self" class="btn rc05 f10 p05 dk blue">Settings</a> <a href="'.$mirrorUrl.'?ext=/categorize.php" target="_self" class="btn rc05 f10 p05 dk blue">Categorize By Genre</a> <a href="'.$mirrorUrl.'?ext=/scripts/randomGame.php" target="_self" class="btn rc05 f10 p05 dk blue">Play A Random Game</a> <a href="'.$mirrorUrl.'?ext=/scripts/request.php" target="_self" class="btn rc05 f10 p05 dk blue">Want Something Added?</a></script>');

echo '<script type="text/javascript">
document.write(shoopDaWoop("'.$data.'"));
</script>';

if($_SESSION['account_position'] == "Admin"){echo $adminPanel;}
if($_SESSION['account_position'] == "Mod"){echo $modPanel;}
?>
</font>
</div>
</center>