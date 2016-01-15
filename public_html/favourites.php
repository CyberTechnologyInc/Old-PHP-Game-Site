<?php
include("/home/u220391248/public_html/scripts/config.php");
$action = secureForDB($_GET['action']);

switch($action){
	case "deleteAllItems":
	$query = mysql_query("UPDATE users SET favourite_games = '' WHERE username = '$user'");
	break;
}

checkIfLoggedIn();
checkIfBanned();
disableRightClick();
?>

<?php  ?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<style type="text/css">
.content {
padding: 5;
}

#gmeName{
margin-left:5;
margin-right:5;
}

#title{
color:white;
}

#x:link{color:#FF0000;}
#x:visited{color:#FF0000;}
#link:link{color:#CCCCCC;}
#link:visited{color:#CCCCCC;}
#deleteAllItems:link{color:#FF0000}
#deleteAllItems:visited{color:#FF0000}
</style>
<div id="content">

<?php 
echo $menu; 
echo "<center><br><font color=blue><u>My Favourites</u></font><br></center>";
$data = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '$user'"));
$favourites = $data['favourite_games'];

if($favourites != ""){
	echo "<a href=\"$mirrorUrl?ext=/favourites.php?action=deleteAllItems\" id=\"deleteAllItems\">Delete All Favourites</a><br>";
	$arr = explode(";", $favourites);
	
	$list .= '<div id="favourites"><table border="2"><tr><th><center><div id="title">Game</div></center></th><th><center><div id="title">Remove</div></center></th></tr>';
	foreach($arr as $id){
		if($id != ""){
			$data = mysql_fetch_array(mysql_query("SELECT * FROM gmes WHERE id = '$id'"));
			$gme_name = $data['gme_name'];
			$list .= '<tr><td><div id="gmeName"><a id="link" href="'.$mirrorUrl.'?ext=/scripts/PlaySWF.php?id='.$id.'">'.$gme_name.'</a></div></td><td><a id="x" href="javascript:removeFav('.$id.')"><center>Remove</center></a></td></tr>';
		}
	}
	$list .= "</div></table>";
$list = base64_encode($list);
}else{
  echo "<center>You haven't currently favourited anything.</center>";
}
?>
</div>
<script type="text/javascript">
document.write(shoopDaWoop("<?php echo $list; ?>"));  
</script>
<script>
function removeFav(id){
	if(!id == ""){
		$.post("/scripts/JqueryDo.php", {action: "removeFav", gmeID: id}, function(data){
			if(data == "False"){
				//An error has occured
			}else{
				$.post("/scripts/JqueryDo.php", {action: "getUpdatedFavs"}, function(data){
					if(!data == "0"){
						$("#favourites").html(shoopDaWoop(data));
					}else if(data == "0"){
						$("#content").html("test");
					}
				})
			}
		})
	}
}
</script>