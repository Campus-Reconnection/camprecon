<?php
require_once("library/system.php");
//if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_SESSION['crlogin']) && $_SESSION['crlogin'] != '')
{
	echo '<table style="border-collapse:collapse; float:right;"><tr>';
	echo '<td style="color:#ffffff;">Welcome, '.$_SESSION['crname'].'!</td>';
	echo '<td><image src="images/'.$_SESSION['crphototb'].'"></image></td>';
	echo '<td><form method="POST" action="includes/logout.php">';
	echo '<input type="image" src="images/powerbutton.png" style="border:0px; float:right;" />';
	echo '</form></td></tr></table>';
}
else
{
	
}
?>