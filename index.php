<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Weekly Schedule:</span>
<br />
<div id="sch-container">
<?php include("includes/weeklyschedule.php"); ?>
</div>
<br />
<span class="title">Quick List:</span>
<?php include("includes/quicklist.php"); ?>
<br />
</div>
</body>
</html>