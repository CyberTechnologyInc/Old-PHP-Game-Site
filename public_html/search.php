<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfLoggedIn();
checkIfBanned();
disableRightClick();
echo $menu;

$echoForm = True;
$search = secureForDB($_POST['search']);
$results = "";
$count = 0;
if(isset($_POST['submit'])){
	if($search != ""){
		$echoForm = False;
		$query = mysql_query("SELECT * FROM gmes WHERE gme_name LIKE '%$search%'");
		$results = '<table border="1"><tr><th><div id="title"><center>Game</center></div></th><th><div id="title"><center>Views</center></div></th></tr>';
		while($row = mysql_fetch_array($query)){
			$name = $row['gme_name'];
			$ID = $row['id'];
			$views = $row['views'];
			$results .= '<tr><td><a id="link" href="'.$mirrorUrl.'?ext=\scripts\PlaySWF.php?id='.$ID.'">'.$name.'</a></div></td><td><div id="views">'.$views.'</td></tr>';
			$count++;
		}
		$results .= '</table>';
	}
}
?>
<title><?php echo "$title"; ?></title>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<style>  
.form{
opacity:0.5;
background-color:black;
position:relative;
top:260;
width:220;
padding:12;
color:white;
}

#link:link{color:#CCCCCC;}
#link:visited{color:#CCCCCC;}

#link{
margin-left:5;
margin-right:5;
}

#views{
color:white;
text-align:center;
margin-left:5;
margin-right:5;
}

#title{color:white;}
</style>
<center>
<body>
<?php
if($echoForm == True){
	echo '<div class="form">
<form action="" method="POST">
<table>

<tr>
<td><font color="white">Search</font></td>
<td><input type="text" name="search"></td>
</tr>

</table>
<input type="submit" name="submit" value="Search!">
</form>
</div>';
}else{
	if($count == 0){
		$results = "We didn't find any games with the search term you provided!";
		
		$final = base64_encode('<a id="title" href="'.$mirrorUrl.'?ext=/search.php">Search Again</a><br><br>'.$results);
		echo '<script type="text/javascript">document.write(shoopDaWoop("'.$final.'"));</script>';
	}elseif($count == 1){
		$final = base64_encode('<a id="title" href="'.$mirrorUrl.'?ext=/search.php">Search Again</a><br><br><font color="white">'.$count.' game found!</font><br>'.$results);
		echo '<script type="text/javascript">document.write(shoopDaWoop("'.$final.'"));</script>';
	}elseif($count > 1){
		$final = base64_encode('<a id="title" href="'.$mirrorUrl.'?ext=/search.php">Search Again</a><br><br><font color="white">'.$count.' games found!</font><br>'.$results);
		echo '<script type="text/javascript">document.write(shoopDaWoop("'.$final.'"));</script>';
	}
}
echo '<div class="eMsg"><font color=red>'.$eMsg.'</font></div>'; 
?>
  </body>
<center>  