<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<img src="images/campusreconnectionlogo.png" />
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<header>
<ul class="topnav">
  <li><a href="#" style="color: white;">Home</a></li>
  <li><a href="#">Personal</a></li>
  <li><a href="#">Class Management</a></li>
  <li><a href="#">Expenses</a></li>
  <li><a href="#">Other</a></li>
  </ul>
</header>
<span class="title">Weekly Schedule:</span>
<br /><br />
<?php include("includes/weeklyschedule.php"); ?>
<br />
<span class="title">Quick List:</span>
<?php include("includes/quicklist.php"); ?>
<br />
</div>
</body>
</html>
