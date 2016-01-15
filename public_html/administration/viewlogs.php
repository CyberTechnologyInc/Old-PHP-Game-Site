<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfModOrAdmin();
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
</style>
<div class="content">
<style type="text/css">
.menu {
padding-top: 12;
padding-bottom: 12;
background-color: black;
width: 250;
}
</style>
<?php echo "$menu"; ?>
<center>
<?php
if($_SESSION['account_position'] == "Admin"){
  echo $adminPanel;
}else{
  echo $modPanel;
}
?>
<div class="menu">
<form action="" method="post">
<tr>
<br>
<td align="left"><select name="viewlog"/>

<?php
$files = scandir($mainUrl."/accounts/logs/");
$logs = array();
$i = 0;
foreach($files as $file){
if(strpos($file, ".txt") == True){
echo "<option value='".$i."'>".$file."</option>";
$logs[$i] = $file;
$i++;
}
}
if($i == 0){
echo "<option>There is no log(s)</option>";
}
?>

</select></td>
</tr>
</table>
<input type="submit" value="View Log" name="submit" name="submit"/>
</form></div><br>

<?php
if(isset($_POST['viewlog'])){
  $view = $_POST['viewlog'];
  if(file_exists($mainUrl."/accounts/logs/".$logs[$view])){
    $currentLog = str_replace(".txt", "", $logs[$view]);
    echo "<font color=white>You're Currently Viewing The Log That Was Made On: <b>$currentLog</b></font><br>";
    echo file_get_contents($mainUrl."/accounts/logs/".$logs[$view]);
  }
}
?>
</center>
</div>