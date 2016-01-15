<?php
include("/home/u220391248/public_html/scripts/config.php");

if(!file_exists("msg.html")){
	echo $rules;
	file_put_contents("msg.html", $rules);
}

if(isset($_GET['msg'])){ 										
	if($_GET['msg'] == $_SESSION['oldMsg']){							
		die();															
	}else{																
		unset($_SESSION['oldMsg']);										
	}																	
}																		
if(!isset($_SESSION['oldMsg'])){										
	$_SESSION['oldMsg'] = $_GET['msg'];									
}																		

if(isset($_GET['msg'])){
	if($_GET['msg'] == ""){
		die();
	}
}

	if(isset($_GET['msg'])){
		if (file_exists('msg.html')) {
		   $f = fopen('msg.html',"a+");
		} else {
		   $f = fopen('msg.html',"w+");
		}
      $nick = isset($_GET['nick']) ? $_GET['nick'] : "Hidden";
      $msg  = isset($_GET['msg']) ? secureString($_GET['msg']) : ".";
	  
	  if(!strstr($msg, "http://") && strstr($msg, "www.")){$msg = str_replace("www.", "http://www.", $msg);}
	  $msg = str_replace("cybertechnologyinc.x10.bz", "superfuntime.comlu.com?ext=", $msg);
			
			if(strstr($msg, "[href:")){
				$var1 = get_string_between($msg, "[href:", "]");
				$var2 = get_string_between($msg, "]", "[/href]");
				$end = "[/href]";
				$msg = str_replace("[href:".$var1."]".$var2."[/href]", '<a href="'.$var2.'">'.$var1.'</a>', $msg);
			}
		
		switch($_SESSION['account_position']){
			
			case "Admin":
			$nick = "<font color=black>[</font><font color=red>ADMIN</font><font color=black>]</font> ".$nick;
			break;
			
			case "Mod":
			$nick = "<font color=black>[</font><font color=orange>MOD</font><font color=black>]</font> ".$nick;
			break;
			
			case "VIP":
			$nick = "<font color=black>[</font><font color=green>VIP</font><font color=black>]</font> ".$nick;
			break;
			
		}
		
		switch($nick){
			
			case "nmek7":
			$nick = "<font color=black>[</font><font color=green>Supreme Overlord</font><font color=black>]</font> ".$nick;
			break;
			
		}
	  $time = date("h:i A");	
      $line = "<p><span class=\"name\">$nick: </span><span class=\"txt\">$msg - <b>$time</b></span></p>";
		fwrite($f,$line."\r\n");
		fclose($f);
		
		echo $line;
		
	}else if(isset($_GET['all'])){
	   $flag = file('msg.html');
	   $content = "";
	   foreach ($flag as $value){
	   	$content .= $value;
	   }
	   echo $content;
	}
	
	//New Content :D
	if(isset($_GET['function'])){
		
		$rules = "<font color=red>
		<u>Site Rules</u><br>
		1) Don't share your account with anyone!<br>
		2) Don't try to exploit any bugs!<br>
		3) Don't spam the chat!<br>
		4) Don't threaten other members!<br>
		5) Don't annoy the owner.<br>
		</font>";
		
		switch(strtolower($_GET['function'])){
			
			case "clear":
			if($_SESSION['account_position'] == "Admin"){
				file_put_contents("msg.html", $rules);
			}
			break;
			
			case "rules":
			if($_SESSION['account_position'] == "Admin"){
				file_put_contents("msg.html", $rules, FILE_APPEND);
			}
			break;
			
		}
	}
?>	
