<?php
require_once("library/system.php");
//if (session_status() == PHP_SESSION_NONE) session_start();

if (isset($_SESSION['crlogin']) && $_SESSION['crlogin'] != '')
{
	echo '<table id="loginfoTable"><tr>';
	echo '<td class="loginfo">Welcome,<br />'.$_SESSION['crname'].'!</td>';
	echo '<td class="loginfo"><image src="images/'.$_SESSION['crphototb'].'" id="loginfoPhoto"></image></td>';
	echo '<td class="loginfo"><form method="POST" action="includes/logout.php">';
	echo '<input type="image" src="images/powerbutton.png" alt="Logout"; />';
	echo '</form></td></tr></table>';
}
else
{
	
}
?>