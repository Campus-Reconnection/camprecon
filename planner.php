<?php
	require("library/system.php");
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Campus Reconnection</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<SCRIPT SRC="javascript/jquery-2.1.4.min.js"></SCRIPT>
	<script>
	</script>
</head>
<body>
	<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
	<div id="pagediv">
		<?php include("includes/menustrip.php"); ?>
		<span class="title">Class Planner</span>
		<br />
		<br />
		<br />
		<br />
		<div id="plannerDiv">
		<?php include("includes/buildplanner.php"); ?>
		<br />
		</div>
		<div id='overlay'></div>
		
	</div>
</body>
</html>