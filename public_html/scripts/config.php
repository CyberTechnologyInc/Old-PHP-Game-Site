<?php
session_start();
include("/home/u220391248/public_html/scripts/connectionfile.php");
ini_set("session.cookie_httponly", true);
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
ini_set('memory_limit','1024M');
date_default_timezone_set("Europe/London");
error_reporting(0);

// Global Variables
$user = $_SESSION['CurrentUser'];
$title = "All items - Google Drive";
$background = "/home/u220391248/public_html/images/background.jpg";
$mirrorUrl = "http://myhiddensite.kek"; //This is the "mirror url", used to hide the original URL of the site. It was very useful when the site started getting blocked when I was in school. I just changed the URL in this text file and it was back online in seconds.
$mainUrl = "/home/u220391248/public_html";
$globalPasswordStrength = 3;
$rules = "<font color=red>
  <u>Site Rules</u><br>
  1) Don't share your account with anyone<br>
  2) Don't try to exploit any bugs<br>
  3) Don't spam the chat<br>
  4) Don't threaten other members<br>
  5) Don't annoy the owner<br>
  </font>";

if(!$user == ""){
  $bgImage = getUserSetting($user, "BG");
  $bgImageSize = getUserSetting($user, "BG", 2);
}
$backgroundImageSettings = "";

if($bgImage == ""){
  $bgImage = $background;
}else{
  $size = getimagesize($bgImage);
  $w = $size[0];
  $h = $size[1];
  if($bgImageSize == ""){
    $backgroundImageSettings = "background-size: 15%;";
  }else{
    $backgroundImageSettings = "background-size: $bgImageSize%;";
  }
  $backgroundImageSettings = "background-size: 15%;";
}

$menu = '<style>body{'.$backgroundImageSettings.' background-image: url('.imageToBase64($bgImage).');}</style><head>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head><script async src="/scripts/javascript_config.js"></script>
<center><div class="title">
<a href="'.$mirrorUrl.'?ext=/favourites.php" target="_self" class="btn rc05 f10 p05 dk blue">My Favourites</a> <a href="'.$mirrorUrl.'?ext=/last100added.php" target="_self" class="btn rc05 f10 p05 dk blue">Last 100 Items Added</a> <a href="'.$mirrorUrl.'?ext=/main.php" target="_self" class="btn rc05 f10 p05 dk blue">Home</a> <a href="'.$mirrorUrl.'?ext=/chat_room.php" target="_self" class="btn rc05 f10 p05 dk blue">Chat</a> <a href="'.$mirrorUrl.'?ext=/search.php" class="btn rc05 f10 p05 dk blue">Search</a> <a href="'.$mirrorUrl.'?ext=/scripts/logout.php" target="_self" class="btn rc05 f10 p05 dk blue">Logout</a>
</font>
</div>
</center>';

$unremovableBans = array("Owner");
$protectedFromBanning = array("DUNHURTME", "IMFRAGILE");

if($user != ""){
  if($_SESSION['account_position'] != "Admin"){
    checkWhenLastActive();
  }
}

// Set User Details
$grabDetails = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '$user'"));
$userDetails['gamesPerPage'] = $grabDetails['gamesPerPage'];
$userDetails['id'] = $grabDetails['id'];
$userDetails['username'] = $grabDetails['username'];
$userDetails['email'] = $grabDetails['email'];

// Control Panel Stuff
$adminPanel = ' <a href="'.$mirrorUrl.'?ext=/administration/admin.php" target="_self" class="btn rc05 f10 p05 dk blue">Admin Panel</a>';
$modPanel = ' <a href="'.$mirrorUrl.'?ext=/administration/moderator_panel.php" target="_self" class="btn rc05 f10 p05 dk blue">Moderator Panel</a>';


//Global/Security Functions
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}

function remote_file_exists($url) {
    return(bool)preg_match('~HTTP/1\.\d\s+200\s+OK~', @current(get_headers($url)));
}

function checkEmail($CHKemail){
    return filter_var($CHKemail, FILTER_VALIDATE_EMAIL);
}

function generateCode(){
    return md5(rand().rand().uniqid().rand().rand());
}

function secureString($stringToSecure){
  return stripslashes(strip_tags($stringToSecure));
}

function secureForDB($stringToSecureForDB){
  return mysql_real_escape_string($stringToSecureForDB);
}

function redirect($time, $redirectTo){
  echo '<meta http-equiv="refresh" content="'.$time.'; url='.$redirectTo.'">';
}

function logText($logMe, $type){
  if(!$type == ""){
    if($type == "good"){
      $txt = "<font color=green>".$logMe."</font><br>";
    }elseif($type == "ban"){
      $txt = "<font color=gold>".$logMe."</font><br>";
    }elseif($type == "tteab"){
      $txt = "<font color=purple>".$logMe."</font><br>";
    }else{
      $txt = "<font color=red>".$logMe."</font><br>";
    }
  }
  $url = '/home/u220391248/public_html/accounts/logs/'.trim(date('F')."-".date('d')."-".date('Y').".txt");
  file_put_contents($url, $txt, FILE_APPEND);
}

function disableRightClick(){
    if((!$_SESSION['account_position'] == "Admin") || (!$_SESSION['account_position'] == "Trusted")){
        echo '<script src="/scripts/jquery.js"></script><script>
$(document).bind("contextmenu", function(e) {
    return false;
});
      
 document.onkeypress = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
    document.onmousedown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
document.onkeydown = function (event) {
        event = (event || window.event);
        if (event.keyCode == 123) {
            return false;
        }
    }
</script>';
    }
}  

function isAlphanumeric($variableToCheckIfAlphanumeric){ //Check if variable contains only letters and numbers
    if(!eregi("[^A-Za-z0-9]", $variableToCheckIfAlphanumeric)){
        return true;
    }else{
        return false;
    }
}

function maskEmail($email, $mask_char, $percent=80){ 
        list($user, $domain) = preg_split("/@/", $email); 
        $len = strlen($user); 
        $mask_count = floor($len * $percent /100); 
        $offset = floor(($len - $mask_count) / 2); 
        $masked = substr($user, 0, $offset) 
                .str_repeat($mask_char, $mask_count) 
                .substr($user, $mask_count+$offset); 
        
        return($masked.'@'.$domain); 
}

function getPasswordStrength($password)
{
    if ( strlen( $password ) == 0 )
    {
        return 1;
    }
 
    $strength = 0;
 
    /*** get the length of the password ***/
    $length = strlen($password);
 
    /*** check if password is not all lower case ***/
    if(strtolower($password) != $password)
    {
        $strength += 1;
    }
 
    /*** check if password is not all upper case ***/
    if(strtoupper($password) == $password)
    {
        $strength += 1;
    }
 
    /*** check string length is 8 -15 chars ***/
    if($length >= 8 && $length <= 15)
    {
        $strength += 1;
    }
 
    /*** check if lenth is 16 - 35 chars ***/
    if($length >= 16 && $length <=35)
    {
        $strength += 2;
    }
 
    if($length > 35)
    {
        $strength += 3;
    }
 
    preg_match_all('/[0-9]/', $password, $numbers);
    $strength += count($numbers[0]);
 
    preg_match_all("/[|!@#$%&*\/=?,;.:\-_+~^\\\]/", $password, $specialchars);
    $strength += sizeof($specialchars[0]);
 
    /*** get the number of unique chars ***/
    $chars = str_split($password);
    $num_unique_chars = sizeof( array_unique($chars) );
    $strength += $num_unique_chars * 2;
 
    /*** strength is a number 1-10; ***/
    $strength = $strength > 99 ? 99 : $strength;
    $strength = floor($strength / 10 + 1);
 
    return $strength;
}

//User Functions & Variables
function checkWhenLastActive(){
  /*
  $user = $_SESSION['CurrentUser'];
  $query = mysql_query("SELECT * FROM users WHERE username = '$user'");
  $num = mysql_num_rows($query);
  $userID = session_id();
  $arr = mysql_fetch_array($query);
  
  if($arr['loginID'] == ""){
    mysql_query("UPDATE users SET loginID = '$userID' WHERE username = '$user'");
    //Carry on, login attempt is legit!
  }else{
    if($userID != $arr['loginID']){    
      $time = date('F')."-".date('d')."-".date("h:i");
      $ip = $_SERVER['REMOTE_ADDR'];
      logText("$ip Tried To Login As The User $user (DUPLICATE LOGIN) At ".date("h:i")."", "bad");
      session_destroy();
      header("Location: /login.php?error=AlreadyLoggedIn");
      return;
    }
  } 
  */  
}

function checkIfLoggedIn(){
  if(($_SESSION['CurrentUser'] == "") || ($_SESSION['LoggedIn'] == False)){
    header("Location: /login.php");
    return;
  }
}

function checkIfAdmin(){
checkIfLoggedIn();

  if($_SESSION['account_position'] != "Admin"){
    header("Location: /error.php?e=notenoughprivileges");
    return;
  }
}

function checkIfModOrAdmin(){
checkIfLoggedIn();

  if($_SESSION['account_position'] == "Admin"){
    $continue = True;
  }elseif($_SESSION['account_position'] == "Mod"){
    $continue = True;
  }else{
    $continue = False;
  }
  
  if(!$continue){
    header("Location: /error.php?e=notenoughprivileges");
    return;
  }
}

function checkIfMod(){
checkIfLoggedIn();

  if($_SESSION['account_position'] != "Mod"){
    header("Location: /error.php?e=notenoughprivileges");
    return;
  }
}

function updateUserDetails(){
  $grabDetails = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE username = '$user'"));
  $userDetails['gamesPerPage'] = $grabDetails['gamesPerPage'];
  $userDetails['ip'] = $grabDetails['registrationIp'];
  $userDetails['id'] = $grabDetails['id'];
  $userDetails['username'] = $grabDetails['username'];
  $userDetails['email'] = $grabDetails['email'];
}

function checkIfBanned(){
$username = $_SESSION['CurrentUser'];
$checkIfBanned = "SELECT * FROM users WHERE username = '$username' && ban_message != ''";
$result = mysql_query($checkIfBanned);
$check = mysql_num_rows($result);
$Arr = mysql_fetch_array($result);
$ban_message = $Arr['ban_message'];
$_SESSION['banMsg'] = $ban_message;

  if($check == 1){
    $_SESSION['LoggedIn'] = True;
    $_SESSION['Banned'] = True;
    header("Location: /error.php?e=banned");
    return;
  }
}

function getUserData($username, $nameOfDataNeeded){
    $dat = mysql_query("SELECT * FROM users WHERE username = '$username'");
    $arr = mysql_fetch_array($dat);
    return $arr[$nameOfDataNeeded];
}

function hashPassword($pass){
  return md5($pass."O~J&F(SJLK");
}

function getUserSetting($user, $settingName, $arrayItemToReturn = "1"){
    $sets = getUserData($user, "settings");
    $arr = explode(";", $sets);
    foreach($arr as $item){
        $arr2 = explode("~", $item);
        if(strstr($arr2[0], $settingName)){
            return $arr2[$arrayItemToReturn];
        }
    }
}

function imageToBase64($pathToImage){
    $img = file_get_contents($pathToImage);
    $imageType = "image/jpeg";
    switch(exif_imagetype($pathToImage)){
      case "IMAGETYPE_GIF":
      $imageType = "image/gif";
      break;
    }
    return "data:$imageType;base64,".base64_encode($img);
}