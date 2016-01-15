<?php
include("/home/u220391248/public_html/scripts/config.php");
$tempUser = $user;
checkIfModOrAdmin();
?>
<style type="text/css">
.content {
padding: 5;
}
</style>
<div class="content">
<?php echo $menu; ?>
<center>
<?php
if($_SESSION['account_position'] == "Admin"){
  echo $adminPanel;
}else{
  echo $modPanel;
}
?>
<br>
<style type="text/css">
.menu{
padding: 5;
background-color: black;
width:310;
}

btns{
padding:3;
}
</style>
<div class="menu">
<table>
<form action="" method="POST">

<tr>
<td><font color=white>Username:</font></td>
<td><input type="text" id="user" name="user"/></td>
</tr>

<tr>
<td><font color=white>Normal Messages:</font></td>
<td><select name="banMsg">
<option value=""></option>
<option value="accountNotUsed">Account Isn't Used</option>
<option value="sharing">Sharing Login Details</option>
<option value="noReason">Non-Specified Reason</option>
<option value="brokenRule">Broke A Rule</option>

<option value="hah_gay">Hah Gay</option>
<option value="gRedirect">Google Redirect</option>
<option value="blankScreen">Blank Screen</option>
</td>
</tr>

<tr>
<td><font color=white>Custom Message:</font></td>
<td><input type="text" name="customMsg"></td>
</tr>

</table>
<div class="btns">
<input type="submit" class="btn rc05 f10 p05 dk blue" value="Ban User" name="ban"/>
<input type="submit" class="btn rc05 f10 p05 dk blue" value="Unban User" name="unban"/>
</div>
</table>
</div>
</form>
<br>
<br>
<script>
function fillUserField(name){
    document.getElementById("user").value = name;
}
</script>
</div>
<?php
$query = mysql_query("SELECT * FROM users");
$i = mysql_num_rows($query);
echo "<center>Total number of users: $i<br>";
while($arr = mysql_fetch_array($query)){ //For each row in table
    $username = $arr['username'];
    echo "<a href=\"javascript:fillUserField('$username')\">$username</a>, "; 
}
echo '</center><style type="text/css">.viewusers{display:none;}</style>';

$username = secureForDB($_POST['user']);

function logBan(){
    global $username;
    global $user;

    if($_SESSION['account_position'] == "Admin"){
        $ip = "(Removed For Privacy Reasons)";
    }

    if($ip == ""){
        $query = mysql_query("SELECT * FROM users WHERE username = '$username''");
        $arr = mysql_fetch_array($query);
        $ip = $arr['registration_ip'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $time = date("h:i A");
    
    if($username == "ManselD"){
        echo "<font color=red>You cannot ban ManselD. Your action has been logged.</font>";
        logText("$ip Tried to ban ManselD with the username $user at $time", "ban");
    }else{
        logText("$user <b>Banned</b> $username with the Ip $ip at $time", "ban");
    }
}

function logUnban(){
    global $username;
    global $user;
    if($_SESSION['account_position'] == "Admin"){
        $ip = "(Removed For Privacy Reasons)";
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    $time = date("h:i A");
    logText("$user <b>Unbanned</b> $username with the Ip $ip at $time", "ban");
}

function preventEditingAdminBan(){
    $usr = getUserData($user, "bannedBy");
    $bannerAccPos = getUserData($usr, "account_position"); 
    file_put_contents("debug.txt", $bannerAccPos.":".$_SESSION['account_position']);
    if(($bannerAccPos == "Admin") && (!$_SESSION['account_position'] == "Admin")){
        die('<center><font color="red">You cannot modify an administrator\'s ban</font></center>');
    }
}

if(!$_POST['banMsg'] == ""){
    $banMsg = secureForDB($_POST['banMsg']);

    if(isset($_POST['submit']) || isset($_POST['ban']) || isset($_POST['unban'])){
        if($username == ""){
            die("<font color=red>The user field cannot be blank!</font></center>");
        }
    }

  // Ban User
  if(in_array($username, $protectedFromBanning)){
    die("<center><font color=\"red\">This user is protected from being banned, only an administrator can ban '$username'</font></center>");
  }
  

  if((!$_POST['banMsg'] == "") && (!$_POST['customMsg'] == "")){
    preventEditingAdminBan();
    $msg = secureForDB($banMsg.":".$_POST['customMsg']);
    $query = mysql_query("UPDATE users SET bannedBy = '$user', ban_message = '$msg' WHERE username = '$username'");
    if($query){
      logBan();
      echo "<center><font color=green>The user $username has been banned with your custom message!</font></center>";
      die();
    }else{
      echo "<center><font color=red>An unexpected error has occured!</font></center>";
    }
  }

  if(!$banMsg == ""){
    preventEditingAdminBan();
    $query = mysql_query("SELECT * FROM users WHERE username = '$user' && account_position = 'Admin' || 'Mod'");
    $check = mysql_num_rows($query);
    if(($check == 1) && (!$username == "ManselD")){die("<font color=red>You can't ban an admin/moderator</font></center>");} 
        if(!$banMsg == ""){
            $query = mysql_query("UPDATE users SET bannedBy = '$user', ban_message = '$banMsg' WHERE username = '$username'");
            if($query){
                logBan();
                echo "<center><font color=green>The user $username has been banned!</font></center>";
            }else{
                echo "<center><font color=red>An unexpected error has occured!<br>".mysql_error()."</font></center>";
            }
        }
    }elseif($banMsg == ""){
        echo "<center><font color=red>You can't ban someone without a message</font></center>";
    }else{
        if(!isset($_POST['customMsg'])){
            echo "<center><font color=red>You can't ban someone without a message</font></center>";
        }
    }
}

// Custom Message Ban
  if(!$_POST['customMsg'] == ""){
    preventEditingAdminBan();
    $msg = secureForDB("CustomMsg:".$_POST['customMsg']);
    $query = mysql_query("UPDATE users SET bannedBy = '$user', ban_message = '$msg' WHERE username = '$username'");
    if($query){
      logBan();
      echo "<center><font color=green>The user $username has been banned with your custom message!</font></center>";
      die();
    }else{
      echo "<center><font color=red>An unexpected error has occured!</font></center>";
    }
  }

// Unban User
    if(!$username == ""){
      if(in_array($bannedBy, $unremovableBans)){
          die('<center><font color="red">You cannot modify an administrator\'s ban</font></center>');
      }
      
      if(isset($_POST['unban'])){
            $banner = getUserData($username, "bannedBy");
            $banner_position = getUserData($banner, "account_position");
            if(($banner_position == "Admin") && ($user == "ManselD")){
                $query = mysql_query("UPDATE users SET bannedBy = '', ban_message = '' WHERE username = '$username'");
                if($query){
                    logUnban();
                    echo "<center><font color=green>The user $username has been unbanned!</font></center>";
                }else{
                    echo "<center><font color=red>An unexpected error has occured!</font></center>";
                }
            }elseif(($banner_position == "Admin") && (getUserData($user, "account_position") == "Mod")){
                die('<center><font color="red">You cannot modify an administrator\'s ban</font></center>');
            }elseif($banner_position == "Mod"){
                $query = mysql_query("UPDATE users SET bannedBy = '', ban_message = '' WHERE username = '$username'");
                if($query){
                    logUnban();
                    echo "<center><font color=green>The user $username has been unbanned!</font></center>";
                }else{
                    echo "<center><font color=red>An unexpected error has occured!</font></center>";
                }
            }
            
      }
    }
?>
