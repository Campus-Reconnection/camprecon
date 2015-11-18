<?php //session_start(); require("library/system.php"); loginHandler(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Holds:</span>
<br /><br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Item</td>
<td class="thr">Amount</td>
<td class="thr">Date</td>
<td class="thr">Department</td>
</tr>
<tr>
<td class="advcell">Financial Obligation Agreement</td>
<td class="advcell">$0.00</td>
<td class="advcell">10/04/2015</td>
<td class="advcell">Customer Account Services</td>
</tr>
</table>
</div>
<br />
<span class="title">To-Do:</span>
<br /><br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Item</td>
<td class="thr">Date</td>
<td class="thr">Status</td>
<td class="thr">Description</td>
</tr>
<tr>
<td class="advcell">Audit</td>
<td class="advcell">10/07/2015</td>
<td class="advcell">F***ed up.</td>
<td class="advcell">We messed everything up sor...</td>
</tr>
</table>
</div>
<br />
<span class="title">Inbox:</span>
<br /><br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Date</td>
<td class="thr">Description</td>
<td class="thr">From</td>
<td class="thr">&nbsp;</td>
</tr>
<tr>
<td class="advcell">10/10/1964</td>
<td class="advcell">Science Fair</td>
<td class="advcell">Tim</td>
<td class="advcell">View</td>
</tr>
</table>
</div>
</div>
</body>
</html>