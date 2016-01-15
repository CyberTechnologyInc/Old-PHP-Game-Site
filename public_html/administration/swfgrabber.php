<?php
session_start();
include("/home/u220391248/public_html/scripts/config.php");
checkIfAdmin();
function getSize($url) {
    if (substr($url, 0, 4)=='http') {
        $x = array_change_key_case(get_headers($url, 1), CASE_LOWER);
        if (strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) {
            $x = $x['content-length'][1];
        } else {
            $x = $x['content-length'];
        }
    } else {
        $x = @filesize($url);
    }
    return $x;
}

if(isset($_POST['submit'])){
	if($_POST['url'] != ""){
		$swf = secureString($_POST['url']);
		$original = $swf;

		if((!strstr($swf, "www.") && strstr($swf, "http://"))){
			$swf = str_replace("http://", "www.", $swf);
		}elseif((!strstr($swf, "www.") && strstr($swf, "https://"))){
			$swf = str_replace("https://", "www.", $swf);
		}else{
			$swf = str_replace("http://", "", $swf);
			$swf = str_replace("https://", "", $swf);
		}
		$arr = explode("/", $swf);

		$siteList = array("www.addictinggames.com", "www.notdoppler.com", "www.crazymonkeygames.com", "www.arcadebomb.com", "www.physicsgames.net", "www.freeworldgroup.com", "www.newgrounds.com", "www.maxgames.com", "www.jayisgames.com", "www.kbhgames.com", "www.kanogames.com", "www.y8.com", "www.funny-games.biz", "www.turbonuke.com");
	
		switch(trim($arr[0])){
			case "www.addictinggames.com":
			$var1 = ".gameURL = '";
			$var2 = "';";
			break;

			case "www.notdoppler.com":
			$var1 = "<embed src=\"";
			$var2 = "\" quality=";
			break;

			case "www.crazymonkeygames.com":
			$var1 = "<embed src=\"";
			$var2 = "\" quality=";
		    break;

			case "www.arcadebomb.com":
			$var1 = "<embed src=\"";
			$var2 = ".swf\" quality=\"high\"";
			break;

			case "www.physicsgames.net":
			$var1 = "<param name=\"movie\" value=\"";
			$var2 = "\" />";
			break;

			case "www.freeworldgroup.com":
			$var1 = "var swf_url = \"";
			$var2 = "\";";
			$baseurl = "http://www.freeworldgroup.com/games9/";
			$remove = "../";
			break;

			case "www.newgrounds.com":
			$var1 = '"http:\/\/uploads.ungrounded.net';
			$var2 = '",';
			$baseurl = 'http://uploads.ungrounded.net';
			$remove = '\\';
			$lineNumber = 1337;
			break;

			case "www.maxgames.com":
			$var1 = "<embed src=\"";
			$var2 = "\" quality=\"autohigh\" wmode=\"direct\"";
			break;

			case "www.jayisgames.com":
			$var1 = "var swf = \"";
			$var2 = "\";";
			break;

			case "www.kbhgames.com":
			$var1 = "<embed src=\"";
			$var2 = "\"";
			$baseurl = "http://kbhgames.com/";
			break;

			case "www.kanogames.com":
			$var1 = "\"location\":\"";
			$var2 = "\",";
			$remove = "\\";
			break;
		  
			case "www.y8.com":
			$var1 = '    <param name="movie" value="';
			$var2 = '"';
			break;
		  
			case "www.funny-games.biz":
			$var1 = '<embed src="';
			$var2 = '" quality="high"';
			break;
		  
			case "www.turbonuke.com":
			$var1 = "var so = new SWFObject('/flashgames";
			$var2 = "',";
			$baseurl = "http://www.turbonuke.com/flashgames";
			break;
			
			/* Template
			case "":
			$var1 = "";
			$var2 = "";
			break;
			*/
		}
		
		$curl = curl_init($swf);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$Source = curl_exec($curl);
		curl_close($curl);
		
		if(isset($lineNumber)){	//$lineNumber should represent the line to look for the .swf link on
			$lines = explode(PHP_EOL, $Source);
			foreach($lines as $line_num => $line){
				if(strstr($line, $var1)){
					$filename = get_string_between($line, $var1, $var2);
				}
				$currentLine++;
			}
		}else{
			$filename = get_string_between($Source, $var1, $var2);
		}

        if(isset($baseurl, $remove)){ // The .swf is in a different directory
			if(!isset($replacewith)){$replacewith = "";}
            $filename = str_replace($remove, $replacewith, $filename);
            $filename = $baseurl.$filename;
        }

        if((isset($baseurl) && !isset($remove))){ // Just merge baseurl and filename
			$filename = $baseurl.$filename;
        }

        if(isset($remove) && (!isset($baseurl))){ // Assume we just want to remove some characters
			if(!isset($replacewith)){$replacewith = "";}
            $filename = str_replace($remove, $replacewith, $filename);
        }
		
		$filename = str_replace("http://www.", "http://", $filename);
		
		
		//echo $filename.":".$lineNumber.":".$swf;
		
		$_SESSION['filename'] = $filename;
        $array = explode("/", $filename);
        $filename2 = end($array);
        header("Content-Length: ".getSize($filename));
        header('Content-Type: application/x-shockwave-flash'); 
        header('Content-Disposition: attachment; filename='.$filename2.'');
        if(!readfile($filename)){ // Download SWF File
			echo("<font color=red><center>An unexpected error has occurred. Maybe the site isn't supported?</center></font><br>");
			echo 'Supported Sites: ';
			foreach($siteList as $site){
				echo $site.", ";
			}
        }
	}
}
?>
<title><?php echo "$title"; ?></title>
<style type="text/css">
.content {
padding: 5;
}
</style>
<head>
<link href="/stylesheets/default.css" rel="stylesheet" type="text/css">
<link href="/stylesheets/css_buttons.css" rel="stylesheet" type="text/css">
</head>
<div class="content">
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
<br>
<br>
<style type="text/css">
.menu {
padding-top: 12;
padding-bottom: 12;
background-color: black;
width: 250;
}
</style>
<center>
<form action="" method="POST">
<input type="text" name="url"/>
<input type="submit" value="Grab Swf" name="submit"/>
</form>
<?php
if((isset($_POST['submit'])) && ($_POST['url'] == "")){
echo "<font color=red>You haven't filled in the url to grab the swf from!</font>";
}
?>
</center>
</div>