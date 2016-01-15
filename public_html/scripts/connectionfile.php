<?php
$database_username = "root";
$database_password = "";

//Opens connection to mysql server
@$dbc = mysql_connect("127.0.0.1", $database_username, $database_password);

if(!$dbc){
  die("Can't Connect To Database: ".mysql_error());
}

//Select database
@$db_selected = mysql_select_db("games_database", $dbc);

if(!$db_selected){
  die("Can't Connect To Database: ".mysql_error());
}
?>