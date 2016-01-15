<?php
include("/home/u220391248/public_html/scripts/config.php");
checkIfLoggedIn();
checkIfBanned();
checkIfAdmin();
disableRightClick();

echo $menu;
echo "<center>".$adminPanel."<br><br>";
$q = mysql_query("SELECT * FROM requests WHERE hidden = '0'");
if(!mysql_num_rows($q) == 0){
	$tbl = '<div id="requests"><table border="1"><tr><th>Game Name</th><th>Username</th><th>Email</th><th>Date</th><th>Remove</th></tr>';
	while($row = mysql_fetch_array($q)){
		$tbl .= '<tr><td><a href="'.$row['game_url'].'">'.$row['game_name'].'</a></td><td>'.$row['username'].'</td><td>'.$row['email'].'</td><td>'.$row['date'].'</td><td><a id="remove" href="javascript:removeRequest('.$row['id'].');">X</a></td></tr>';
	}
	$tbl .= "</table></div></center>";
	$tbl = base64_encode($tbl);
}else{
	echo "There are currently no requests</center>";
}
?>
<style>
.remove{

}
</style>
<script>
document.write(shoopDaWoop("<?php echo $tbl; ?>"));

function removeRequest(id){
	$.post("/scripts/JqueryDo.php", {action: "removeRequest", id: id}, function(data){
		if(!data == ""){
			document.getElementById("requests").innerHTML = shoopDaWoop(data);
		}
	});
}
</script>