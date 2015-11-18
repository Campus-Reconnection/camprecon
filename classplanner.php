<?php //session_start(); require("library/system.php"); loginHandler(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script>
function openMap()
{
    myWindow = window.open("./map.php", "Map Window", "width=960, height=640");
}
</script>
</head>
<body>
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Class Planner:</span>
<br /><br />

<!--Replace-Content-Here---------------------------------->
<span style="color:#007f00;">
.:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. <br />
.:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. <br />
.:. INSERT COOL BEANS HERE!!&nbsp; .:. <br />
.:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. <br />
.:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. .:. <br />
</span>
<!-------------------------------------------------------->

<br /><br />
<input type="button" value="Open Map" onclick="openMap()" />
</div>
</body>
</html>