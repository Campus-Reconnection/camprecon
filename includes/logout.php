<?php
session_start();
$_SESSION['crlogin'] = false;
header("Location:/login.php");
?>