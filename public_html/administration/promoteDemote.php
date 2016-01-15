<?php
session_start();
include("/home/u220391248/public_html/scripts/config.php");
checkIfAdmin();
checkIfLoggedIn();
?>

<?php  ?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<div class="content">
<style type="text/css">
.content {
padding: 5;
}

.menu {
padding: 5;
background-color: grey;
border-style: dashed;
border-color: black;
border-width: 1;
width: 250;
}
</style>
<?php 
echo $menu; 
  echo "<center>".$adminPanel."</center>";
?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<center>
<div class="menu">
<form action="" method="POST">
<table>
<tr>
<td>Username:<input type="text" value="<?php echo $_POST['user']; ?>" name="user"></td>
</tr>
<tr>
<td>Update To:<select name="promoteDemoteTo">
<option value="Mod">Moderator</option>
<option value="VIP">VIP</option>
<option value="Normal">Normal User</option>
<option value="Trusted">Trusted User</option>
</select></td>
</tr>
</table>
<input type="submit" value="Update User Status" name="updateStatus">
</form>
</div>
<?php
$newStatus = secureString($_POST['promoteDemoteTo']);
$upUser = secureString($_POST['user']);
if(isset($_POST['updateStatus'])){
	if($newStatus && $upUser != ""){
		$check1 = mysql_query("SELECT * FROM users WHERE username = '$upUser'");
		$check2 = mysql_num_rows($check1);
	  
		$positions = array();
		$positions[0] = "Mod";
		$positions[1] = "VIP";
		$positions[2] = "Normal";
		$positions[3] = "Trusted";
	  
		foreach($positions as $position){
			if($newStatus == $position){
				$positionExists = True;
			}
		}
	  
		if(($check2 == 1) && ($positionExists)){ //If user and position exists
			mysql_query("UPDATE users SET account_position = '$newStatus' WHERE username = '$upUser'");
		}
	  
		if(!$positionExists){
			echo "<font color=red>Nice try...</font>";
		}
	}else{
		echo "<font color=red>Please fill in all fields!</font>";
	}
}
?>
</center>
</div>