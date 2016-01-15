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
margin: 5;
}

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
<?php echo $menu; ?>

<?php
$query = mysql_query("SELECT * FROM gmes ORDER BY id DESC LIMIT 100");
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
<div class="content">
<script type="text/javascript">
document.write(shoopDaWoop("<?php echo $gmeList; ?>"));
</script>
</div>
<?php
if($_SESSION['account_position'] == "Admin"){echo "<center>".$adminPanel."</center>";}
if($_SESSION['account_position'] == "Mod"){echo "<center>".$modPanel."</center>";}
?>