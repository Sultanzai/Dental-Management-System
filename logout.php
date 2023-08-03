<?php
session_start();

$_SESSION["Username"] = "";
$_SESSION["type"] = ""; 
$_SESSION["userid"] = "";

session_destroy();
header("Location: Login.php")

?>