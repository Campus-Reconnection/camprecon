<?php 
session_start(); 
require("library/system.php"); 
require("library/classqueries.php");
loginHandler(); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<link rel="icon" type="image/ico" href="images/favicon.ico" />
<script>
function sendalert()
{
	var conf = confirm("Are you sure you want to do this?");
	
	if (conf == true)
	{
		document.getElementById("dropform").submit();
	}
}
</script>
</head>
<body>
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Weekly Schedule:</span>
<br />
<div class="shadow-container">
<?php include("includes/weeklyschedule.php"); ?>
</div>
<br />
<span class="title">Drop Classes:</span>
<br />
<div class="shadow-container">
<form id="dropform" method="GET" action="library/classdrop.php">
<table class="schedule" id="schedule">
<?php returnCourses(true); ?>
</table>
</div>
<br />
<input type="button" name="delete" value="Delete Selected Courses" onclick="sendalert()" style="float:right">
</form>
<script>
var x = document.getElementsByClassName("fws");
var checked = [];

//When a checkbox is changed, change colors of corresponding table cells.
function checkchanged(courseid)
{
	for (var i = 0; i < x.length; i++)
	{
		if (x[i].innerHTML == courseid)
		{
			if (checked[i] != true)
			{
				x[i].style.backgroundColor = "#ff0000";
				checked[i] = true;
			}
			else
			{
				x[i].style.backgroundColor = "#52ae63";
				checked[i] = false;
			}
		}
	}
}
</script>
</body>
</html>
