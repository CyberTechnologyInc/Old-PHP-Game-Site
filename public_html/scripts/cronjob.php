<?php
include("/home/u220391248/public_html/scripts/config.php");
// */5 * * * * /usr/bin/php -f /home/u220391248/public_html/scripts/cronjob.php >/dev/null 2>&1 
$save_path = ini_get("session.save_path");
$query = mysql_query("SELECT * FROM users WHERE loginID != ''");

while($row = mysql_fetch_array($query)){
	$loginID = $row['loginID'];
	$user = $row['username'];
	if(!file_exists($save_path."/".$loginID)){
		mysql_query("UPDATE users SET loginID = '' WHERE username = '$user'");
		echo $user." has logged out!<br>";
	}
}
?>