<?php

include("/home/u220391248/public_html/scripts/config.php");
checkIfLoggedIn();


$query = mysql_query("SELECT * FROM gmes");
while($row = mysql_fetch_array($query)){
	$i++;
}

$id = rand(1, $i);
header("Location: /scripts/PlaySWF.php?id=".$id."&randomGameBtn=true");
return;
?>