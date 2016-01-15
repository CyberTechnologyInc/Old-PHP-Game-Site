<?php
include("/home/u220391248/public_html/scripts/config.php");
updateUserDetails();
function createForm(){
?>
<style type="text/css">
.title{
padding: 5;
}
</style>
<body>
      <form action="" method="post">
        <table align="center">
          <tr><td colspan="2">Please enter a nickname to login!</td></tr>
          <tr><td>Your name: </td>
          <td><input class="text" type="text" name="name" /></td></tr>
          <tr><td colspan="2" align="center">
             <input class="text" type="submit" name="submitBtn" value="Login" />
          </td></tr>
        </table>
      </form>
</body>
<?php
}

//TODO: ALLOW ADMINS TO CHANGE OTHER PEOPLE'S USERNAMES

if(!isset($_SESSION['ChatName'])){
	$_SESSION['ChatName'] = $_SESSION['CurrentUser'];
}

// Process login info
if(isset($_SESSION['ChatName'])){
      $name = isset($_SESSION['ChatName']) ? $_SESSION['ChatName'] : "Unnamed";
      $_SESSION['nickname'] = $name;
}

$nickname = isset($_SESSION['nickname']) ? $_SESSION['nickname'] : "Hidden";   
?>
<head>
   <link href="style/style.css" rel="stylesheet" type="text/css" />
    <script language="javascript" type="text/javascript">
    <!--
      var httpObject = null;
      var link = "";
      var timerID = 0;
      var nickName = "<?php echo $nickname; ?>";

      function getHTTPObject(){
         if (window.ActiveXObject) return new ActiveXObject("Microsoft.XMLHTTP");
         else if (window.XMLHttpRequest) return new XMLHttpRequest();
         else {
            alert("Your browser does not support AJAX.");
            return null;
         }
      }   

      function setOutput(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML += response;
            objDiv.scrollTop = objDiv.scrollHeight;
            var inpObj = document.getElementById("msg");
            inpObj.value = "";
            inpObj.focus();
         }
      }

      function setAll(){
         if(httpObject.readyState == 4){
            var response = httpObject.responseText;
            var objDiv = document.getElementById("result");
            objDiv.innerHTML = response;
            objDiv.scrollTop = objDiv.scrollHeight;
         }
      }
   
      function doWork(){    
		var $message = document.getElementById('msg').value;
		if($message === ""){
		}else{
			
				switch($message){
				
					case "/clear":
						var sendMsg = false;
						httpObject = getHTTPObject();
						if (httpObject != null) {
							link = "message.php?function=clear";
							httpObject.open("GET", link , true);
							httpObject.onreadystatechange = setOutput;
							httpObject.send(null);
						}
					break;
					
					case "/rules":
						var sendMsg = false;
						if (httpObject != null) {
							link = "message.php?function=rules";
							httpObject.open("GET", link , true);
							httpObject.onreadystatechange = setOutput;
							httpObject.send(null);
						}
					break;
					
				}
			
			if(sendMsg != false){
				if($message != ""){
					httpObject = getHTTPObject();
					if (httpObject != null) {
						link = "message.php?nick="+nickName+"&msg="+$message;
						httpObject.open("GET", link , true);
						httpObject.onreadystatechange = setOutput;
						httpObject.send(null);
					}
				}
			}
         }
      }
   
      function doReload(){    
         httpObject = getHTTPObject();
         if (httpObject != null) {
            link = "message.php?all=1";
            httpObject.open("GET", link , true);
            httpObject.onreadystatechange = setAll;
            httpObject.send(null);
         }
      }

      function UpdateTimer() {
         doReload();   
         timerID = setTimeout("UpdateTimer()", 1000);
      }
    
      function keypressed(e){
         if(e.keyCode=='13'){
			doWork();
        }
      }
    //-->
    </script>   
</head>
<body onload="UpdateTimer();">
    <div id="main">
      <div id="caption">Funtime Chat!</div>
      <div id="icon">&nbsp;</div>
<?php 

if(!isset($_SESSION['nickname'])){ 
    createForm();
}else{ 
      $name    = isset($_SESSION['ChatName']) ? secureString($_SESSION['ChatName']) : "Unnamed";
      $_SESSION['nickname'] = $name;
    ?>
      
     <div id="result">
     <?php 
        $data = file("msg.html");
        foreach ($data as $line) {
        	echo $line;
        }
     ?>
      </div>
      <div id="sender" onkeyup="keypressed(event);">
         Your message: <input type="text" name="msg" size="30" id="msg" />
         <button onclick="doWork();">Send</button>
      </div>   
<?php            
    }
?>
    </div>
</body>
<script src="/scripts/jquery.js"></script>
<script type="text/javascript">
window.setInterval(function(){checkIfBanned()}, 10000);

function checkIfBanned(){
	$.post("/scripts/JqueryDo.php", {checkIfBanned: "True"}, function(data){
		
		if(data == 1){
			parent.location.href = "/error.php?e=banned";
		}
		
	});
}
</script>