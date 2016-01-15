<?php
include("/home/u220391248/public_html/scripts/config.php");
if(isset($_GET['error'])){
  switch($_GET['error']){
    case "AlreadyLoggedIn":
    $eMsg = "You have tried to login to an account that is already logged in. \n <b>This action has been logged.</b>";
    break;       
  }
}

//echo '<style>body{'.$backgroundImageSettings.' background-image: url("'.$bgImage.'");}</style>';

if($_SESSION['LoggedIn'] == True){
  header("Location: /main.php");
  return;
}else{
  $_SESSION['LoggedIn'] = False;
}

if(isset($_POST['submit'])){
  if($user != ""){
    $_SESSION['CurrentUser'] = $user;
  }else{
    $_SESSION['CurrentUser'] = "";
  }
  
// Normal Users
if(isset($_POST['submit'])){
$user = secureString($_POST['username']);
$pass = hashPassword($_POST['password']);
$ip = $_SERVER['REMOTE_ADDR'];

$query1 = mysql_query("SELECT * FROM users WHERE username = '$user'");
$query2 = mysql_query("SELECT * FROM users WHERE email = '$user'");

$check1 = mysql_num_rows($query1);
$check2 = mysql_num_rows($query2);

if($check1 == 1){
    $data = mysql_fetch_array($query1);
    $user = $data['username'];
}elseif($check2 == 1){
    $data = mysql_fetch_array($query2);
    $user = $data['username'];
}
$_SESSION['CurrentUser'] = $user;

$result = mysql_num_rows(mysql_query("SELECT * FROM users WHERE username = '$user' && password = '$pass'"));
$result2 = mysql_num_rows(mysql_query("SELECT * FROM users WHERE email = '$user' && password = '$pass'"));

  if($result == 1){
    $finalQuery = mysql_query("SELECT * FROM users WHERE username = '$user' && password = '$pass'");
    $finalResult = mysql_num_rows(mysql_query("SELECT * FROM users WHERE username = '$user' && password = '$pass'"));
  }elseif($result2 == 1){
    $finalQuery = mysql_query("SELECT * FROM users WHERE email = '$user' && password = '$pass'");
    $finalResult = mysql_num_rows(mysql_query("SELECT * FROM users WHERE email = '$user' && password = '$pass'"));
  }
  
  $q = mysql_query("SELECT * FROM users WHERE username = '$user' && activated = '1'");
  $activated = mysql_num_rows($q);
  if(($result == 1) || ($result2 == 1) && ($activated == "1")){ //If user details match
    //Set User Variables
    $arr = mysql_fetch_array($finalQuery);
    $user = $arr['username'];
    $_SESSION['account_position'] = $arr['account_position'];
    
    checkIfBanned(); //Check if banned before continuing
    
    if(getPasswordStrength($_POST['password']) < $globalPasswordStrength){
        $_SESSION['INSECURE_PASS_DATA'] = $user.":".$pass;
        header("Location: ?error=insecurePassword");
        return;
    }
    
    if($_SESSION['account_position'] == "Admin"){
        $ip = "(Removed For Privacy Reasons)";
    } 

    $_SESSION['IP'] = $ip; 
  
    //Log successful login
    logText("$user Logged In With The Ip: $ip At ".date("h:i A")."", "good");
  
    $_SESSION['LoggedIn'] = True;
    Header("Location: /main.php");
    return;
  
    }else{
        $arr = mysql_fetch_array($finalQuery);
        $user = $arr['username'];
        $ip = $arr['registration_ip'];
        //Log bad login
        logText("$ip Tried To Login As The User $user At ".date("h:i A")."", "bad");
        $eMsg = "You have entered an invalid login";
    }
  }
}
echo '<style>body{background-image: url('.imageToBase64($background).');}</style>';
disableRightClick();
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<style>  
  .loginbox{
  border-style:dashed;
  width:260;
  background-color:black;
  position:relative;
  top:260;
  }
  
  .eMsg{
  position:relative;
  left:0;
  right:0;
  margin-left:auto;
  margin-right:auto;
  top:270;
  }
  
  .loginBtn{
  margin:3;
  }
  
  .insidelogin{
  margin:12;
  }
</style>
<center>
  <body>
    <div class="loginbox">
      <form method="POST" action="">
      <div class="insidelogin">
        <font color=white>
            Username: <input type="text" value="<?php echo $user; ?>" name="username"><br>
            Password: <input type="password" name="password"><br>
      <a href="<?php echo $mirrorUrl; ?>?ext=/scripts/resetpass.php">Forgotten Password?</a> <a href="<?php echo $mirrorUrl; ?>?ext=/scripts/register.php">Register</a><br>
      <div class="loginBtn">
          <input type="submit" class="btn rc05 f10 p05 dk blue" name="submit" value="Login!">
      </div>
      </font>
        </div>
      </form>
    </div>
<?php
echo '<div class="eMsg"><font color=red>'.$eMsg.'</font></div>';
?>
  </body>
<center>  