<?php
include("/home/u220391248/public_html/scripts/config.php");
$action = $_POST['action'];
//Example Jquery Script
/*
<script type="text/javascript">
var $gmeID = "<?php echo $id; ?>";
function addToFav(){
  $.post("/scripts/JqueryDo.php", {gmeID: $gmeID});
  return false;
};
</script>
*/

function returnData($returnMe){
	header('Content-Type: application/json');
	echo json_encode($returnMe);
}

//Add to favourites
$gmeID = secureForDB($_POST['gmeID']);
$addToFav = secureForDB($_POST['addToFav']);
if(($gmeID != "") && ($addToFav == True)){
	$arr = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '$user'"));
	$favourites = $arr['favourite_games'].$gmeID.";";
	
	$favouritesBack = explode(";", $arr['favourite_games']);
	foreach($favouritesBack as $fav){
		if($fav == $gmeID){
			$nope = False;
		}
	}
	
	if(!isset($nope)){
		if(mysql_query("UPDATE users SET favourite_games = '$favourites' WHERE username = '$user'")){
			returnData("True");
		}else{
			returnData("False");
		}
	}else{
		returnData("alreadyAdded");
	}
}

//Check If Banned
if(!$_POST['checkIfBanned'] == ""){
$checkIfBanned = mysql_query("SELECT * FROM users WHERE username = '$user' && ban_message != ''");
$check = mysql_num_rows($checkIfBanned);
$Arr = mysql_fetch_array($checkIfBanned);
$_SESSION['banMsg'] = $Arr['ban_message'];

	if($check == 1){
		$_SESSION['LoggedIn'] = True;
		$_SESSION['Banned'] = True;
		returnData(True);
	}elseif(isset($_SESSION['referer'])){
		returnData($_SESSION['referer']);
	}else{
		returnData(False);
	}
}

if(isset($_POST['reportBroken'], $_POST['gmeID'])){
	$id = secureForDB($_POST['gmeID']);
	$query = mysql_query("SELECT * FROM gmes WHERE id = '$id'");
	$arr = mysql_fetch_array($query);
	$gme = $arr['gme_name'];
	$body = 'The game "'.$gme.'" with the id of "'.$id.'" has been reported broken by '.$user.'.';
	$query = mysql_query("SELECT * FROM users WHERE username = '$user'");
	$arr = mysql_fetch_array($query);
	$accountPosition = $arr['account_position'];
	if(($accountPosition == "Admin") || ($accountPosition == "Mod")){
		if(mail("manseld5@gmail.com", "$gme Is Broken!", $body)){
			returnData("True");
		}else{
			returnData("False");
		}
	}
}

$id = secureForDB($_POST['gmeID']);
switch($action){
	case "removeFav":
	$arr = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '$user'"));
    $favourites = $arr['favourite_games'];
    $favourites = str_replace($id.";", "", $arr['favourite_games']);
    if(mysql_query("UPDATE users SET favourite_games = '$favourites' WHERE username = '$user'")){
    	returnData($id);
    }else{
    	returnData("False");
    }
	break;

	case "getUpdatedFavs":
	$data = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '$user'"));
	$favourites = $data['favourite_games'];
	$arr = explode(";", $favourites);
	if((count($arr) == 0) || ($favourites == 0)){
		returnData("0");
	}
	if($favourites != ""){
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
		returnData($list);
		break;
	}
	break;

	case "removeRequest":
	$id = secureForDB($_POST['id']);
	mysql_query("UPDATE requests SET hidden = '1' WHERE id = '$id'");

	$q = mysql_query("SELECT * FROM requests WHERE hidden = '0'");
	if(!mysql_num_rows($q) == 0){
		$tbl = '<div id="requests"><table border="1"><tr><th>Game Name</th><th>Username</th><th>Email</th><th>Date</th><th>Remove</th></tr>';
		while($row = mysql_fetch_array($q)){
			$tbl .= '<tr><td><a href="'.$row['game_url'].'">'.$row['game_name'].'</a></td><td>'.$row['username'].'</td><td>'.$row['email'].'</td><td>'.$row['date'].'</td><td><a id="remove" href="javascript:removeRequest('.$row['id'].');">X</a></td></tr>';
		}
		$tbl .= "</table>";
		returnData(base64_encode($tbl));
	}else{
		returnData(base64_encode("There are currently no requests"));
	}
	break;
}
?>