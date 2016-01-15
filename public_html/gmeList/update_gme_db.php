<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfAdmin();
checkIfBanned();
disableRightClick();
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<?php 
echo $menu;
echo "<center>".$adminPanel."</center>";
?>
<style> 
  
  .title{
  margin:5;
  }
  
  .form2{
  border-style:dashed;
  width:400;
  background-color:black;
  position:relative;
  left:auto;
  top:170;
  } 
  
  .form{
  border-style:dashed;
  width:400;
  background-color:black;
  position:relative;
  left:auto;
  top:200;
  }
  
  .eMsg{
  position:relative;
  left:0;
  right:0;
  margin-left:auto;
  margin-right:auto;
  left:auto;
  top:400;
  }
</style>
<center>
<div class="form2">
<form method="POST" action="">
<table>

<tr>
	<td><font color=white>Gme ID/Name:</font></td><td><input type="text" name="gmeID"></td>
<tr>

</table>
<input type="submit" name="delGme" value="Remove Gme">
</form>
</div>


<div class="form">
<form method="POST" action="">
<table>
	<tr>
		<td><font color=white>Gme Name:</font></td><td><input type="text" name="gmeName"><br></td>
	</tr>

	<tr>
		<td><font color=white>Swf Name:</font></td><td><input type="text" name="swfName"><br></td>
	</tr>
</table>
<input type="submit" name="addOne" value="Add Gme">
</form>

	<br>
    <form method="POST" action="">
			<table>
				<tr>
					<td>
						<input type="submit" name="addNew" value="Add Gmes From Text File">
						<input type="submit" name="genList" value="Generate Gme List From DB">
					</td>
				</tr>
			<table>
	</form>
	</div>
<?php  
	if(isset($_POST['delGme'])){
		$gmeID = SecureForDB($_POST['gmeID']);
		if($gmeID != ""){
			$query1 = mysql_query("SELECT * FROM gmes WHERE id = '$gmeID'");
			$check1 = mysql_num_rows($query1);
			
			$query2 = mysql_query("SELECT * FROM gmes WHERE gme_name = '$gmeID'");
			$check2 = mysql_num_rows($query2);
			
			if($check1 == 1){
				
				$data = mysql_fetch_array($query1);
				$gmeID = $data['id'];
				$gmeName = $data['gme_name'];
				$query = mysql_query("SELECT * FROM gmes");
				
				while($row = mysql_fetch_array($query)){
					$i++;
				}
				
				$ai = $i;
				$del = mysql_query("DELETE FROM gmes WHERE id = '$gmeID'");
				
				if($del){
					mysql_query("ALTER TABLE gmes AUTO_INCREMENT = $i;");
					$gMsg = $gmeName." has been removed successfully!";
				}else{
					$eMsg = "An error has occured while trying to remove\n".$gmeName;
				}
				
			}elseif($check2 == 1){
				
				$data = mysql_fetch_array($query2);
				$gmeID = $data['id'];
				$gmeName = $data['gme_name'];
				$query = mysql_query("SELECT * FROM gmes");
				
				while($row = mysql_fetch_array($query)){
					$i++;
				}
				
				$del = mysql_query("DELETE FROM gmes WHERE id = '$gmeID'");
				
				if($del){
					mysql_query("ALTER TABLE gmes AUTO_INCREMENT = $i;");
					$gMsg = $gmeName." has been removed successfully!";
				}else{
					$eMsg = "An error has occured while trying to remove\n".$gmeName;
				}
				
			}else{
				$eMsg = "There is no Gme with that Name/ID";
			}
		}
	}
	
	if(isset($_POST['addOne'])){
		$gme_name = secureForDB($_POST['gmeName']);
		$swfFile = secureForDB($_POST['swfName']);
		
		if(($gme_name != "") && ($swfFile != "")){
		
			$query = "INSERT INTO gmes SET filename = '$swfFile', gme_name = '$gme_name'";
			$check = mysql_query("SELECT * FROM gmes WHERE filename = '$swfFile'");
			$check2 = mysql_query("SELECT * FROM gmes WHERE gme_name = '$gme_name'");
		
			$actualCheck = mysql_num_rows($check);
			$actualCheck2 = mysql_num_rows($check2);
	  
			if(($actualCheck == 0) && ($actualCheck2 == 0)){
				$result = mysql_query($query);
				if($result){
					$gMsg = "$gme_name has been added!";
				}
			}
		}
	}
	
	if(isset($_POST['genList'])){
		$query = mysql_query("SELECT * FROM gmes ORDER BY gme_name ASC");
		if($query){
			while($arr = mysql_fetch_array($query)){
				$filename = $arr['filename'];
				$gme_name = $arr['gme_name'];
				$views = $arr['views'];
				$list .= "<li><a href=\"/scripts/PlaySWF.php?n=$filename\" style=\"color: #CCCCCC\">$gme_name</a><br></li>$views#END\n";
			}
			file_put_contents("/home/u220391248/public_html/gmeList/gmeList.txt", $list);	
		}
	}
  
  if(isset($_POST['addNew'])){
    $lines = file("/home/u220391248/public_html/gmeList/gmeList.txt");
    foreach($lines as $line){
	  $swfFile = get_string_between($line, 'n=', '" style');
	  $gme_name = get_string_between($line, 'style="color: #CCCCCC">', "</a>");
	  $views = get_string_between($line, '<br></li>', '#END');
      $query = "INSERT INTO gmes SET filename = '$swfFile', gme_name = '$gme_name', views = '$views'";
	  $check = mysql_num_rows(mysql_query("SELECT * FROM gmes WHERE filename = '$swfFile'"));
	  $check2 = mysql_num_rows(mysql_query("SELECT * FROM gmes WHERE gme_name = '$gme_name'"));
	  if(($check == 0) && ($check2 == 0)){ //If gme isn't already added then...
	    $result = mysql_query($query); //Add Game To DB
	  }
    }
  }
	echo '<div class="eMsg"><font color=red>'.$eMsg.'</font></div>';
	echo '<div class="gMsg"><font color=green>'.$gMsg.'</font></div>'; 
  ?>
  </body>
<center>