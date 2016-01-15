<?php

include("/home/u220391248/public_html/scripts/config.php");
// Logout Normal User
if(isset($_SESSION['LoggedIn'])){
unset($_SESSION['LoggedIn']);
}

// Delete CurrentUser Data
if(isset($_SESSION['CurrentUser'])){
unset($_SESSION['CurrentUser']);
}

// Delete Banned Data
if(isset($_SESSION['Banned'])){
unset($_SESSION['Banned']);
}

// Logout Admin
if(isset($_SESSION['Admin'])){
	unset($_SESSION['Admin']);
}
session_destroy();
header("Location: /login.php");
return;
?>