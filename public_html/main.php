<?php
include("/home/u220391248/public_html/scripts/config.php");
error_reporting(E_ALL);
$_SESSION['TempUsername'] = "";
$gmeList = "";
checkIfLoggedIn();
checkIfBanned();
disableRightClick();
?>
<a name="#Top"></a>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
<script src="/scripts/javascript_config.js"></script>
</head>
<style type="text/css">
#content {padding: 5;}
#title{color:white;}

#gmeLink{
margin-left:5;
margin-right:5;
}

#numViews{
color:white;
text-align:center;
margin-left:5;
margin-right:5;
}
</style>
<div id="content">
<?php 
echo "$menu";
$gamesPerPage = $userDetails['gamesPerPage'];
$i = 0;
$query = mysql_query("SELECT * FROM gmes");
while($row = mysql_fetch_array($query)){ //For each row in table
  $finalViews = 1;
  $views = $row['views'];
  
  if($views != ""){
    if($views > $finalViews){
      $id = $row['id'];
      $finalViews = $views;
    }
  }
  $i++;
}

$query = mysql_query("SELECT * FROM gmes WHERE id = '$i'");
$list = mysql_fetch_array($query);
$gme_name = $list['gme_name'];
$views = $list['views'];

if(($views >= 2) || ($views == 0)){
  $viewOrViews = "Views";
}elseif($views == 1){
  $viewOrViews = "View";
}else{
  $viewOrViews = "Views";
}

$miniMenu = '<center><font color=white>Latest Game Added: <a href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$i.'" style="color: #CCCCCC">'.$gme_name.' ['.$views.' '.$viewOrViews.']</a><br>';

$query = mysql_query("SELECT * FROM gmes WHERE id = '$id'");
$list = mysql_fetch_array($query);
$gme_name = $list['gme_name'];
$i = $list['id'];

$miniMenu .= 'Most Played Game: </font><a href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$i.'" style="color: #CCCCCC">'.$gme_name.' ['.$finalViews.' Views]</a><br></center>';

echo '<script type="text/javascript">
document.write(shoopDaWoop("'.base64_encode($miniMenu).'"));
</script>';
?>
<div class="main">
<font color=white>
<div style="text-align:left">
<?php
$result = mysql_query("SELECT * FROM gmes");
$i = mysql_num_rows($result);
echo "At the moment there is $i to choose from:";
$pagination = "";
if((isset($grabDetails['gamesPerPage']) && ($grabDetails['gamesPerPage'] != 0))){
  $per_page = $grabDetails['gamesPerPage'];
  $pages = round($i / $per_page);
  
  $page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
  $start = ($page - 1) * $per_page;
  
  $query = mysql_query("SELECT * FROM gmes ORDER BY gme_name LIMIT $start, $per_page");
  
  $pagination = '<center>';
  if($pages >= 1 && $page <= $pages){
    for($x = 1; $x<=$pages; $x++){
      if($x == $page){
        $pagination .= '<a class="btn rc05 f10 p05 dk blue" href="?page='.$x.'"><b>'.$x.'</b></a> ';
      }else{
        $pagination .= '<a class="btn rc05 f10 p05 dk blue" href="?page='.$x.'">'.$x.'</a> ';
      }  
    }
  }else{
    redirect(0, "main.php");
  }
  $pagination .= "</center>";
}else{
  $query = mysql_query("SELECT * FROM gmes ORDER BY gme_name");
}

$gmeList .= '<table border="2"><tr><th><center><div id="title">Game</div></center></th><th><center><div id="title">Views</div></center></th></tr>';
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
		  
		  if(!$views == 0){
			$gmeList .= '<tr><td><a id="gmeLink" href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$id.'" style="color: #CCCCCC">'.$gme_name.'</a></td><td><div id="numViews">'.$views.' '.$viewOrViews.'</div></td></tr>';
		  }elseif(!$views >= 0){
			$gmeList .= '<tr><td><a id="gmeLink" href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$id.'" style="color: #CCCCCC">'.$gme_name.'</a></td><td><div id="numViews">0 Views</div></td>';
		  }
	}
$gmeList .= "</table>";
$gmeList = base64_encode($gmeList);
?>
<br>
<script type="text/javascript">
document.write(shoopDaWoop("<?php echo $gmeList; ?>"));
</script>
</div>
<?php echo $pagination; ?>
<hr>
</font>
<center>
<div class="title">
<?php
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
</div>	