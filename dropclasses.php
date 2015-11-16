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
<br /><br />
<div id="sch-container">
<?php include("includes/weeklyschedule.php"); ?>
</div>
<br />
<span class="title">Drop Classes:</span>
<br /><br >
<table class="schedule">
<tr>
<th>Select</th>
<th>Class</th>
<th>Description</th>
<th>Days/Times</th>
<th>Room</th>
<th>Instructor</th>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="select"</td>
<td class="advcell">PHYS211</td>
<td class="advcell">Physics</td>
<td class="advcell">MoWeFr 10:00AM - 10:50AM</td>
<td class="advcell">SE </td>
<td class="advcell">Warren Christensen</td>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="select"</td>
<td class="advcell">CSCI213</td>
<td class="advcell">Modern Software Development</td>
<td class="advcell">MoWeFr 2:00PM - 2:50PM</td>
<td class="advcell">Quentin Burdick Bldg, 102</td>
<td class="advcell">Oksana</td>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="select"</td>
<td class="advcell">CSCI222</td>
<td class="advcell">Discrete Math</td>
<td class="advcell">MoWeFri 4:00PM-4:50PM</td>
<td class="advcell">Quentin Burdick Bldg, 102</td>
<td class="advcell">Vasasant Ubhaya</td>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="select"</td>
<td class="advcell">CSCI413</td>
<td class="advcell">Principles of Software Engineering</td>
<td class="advcell">TuTh 11:00AM-12:15PM</td>
<td class="advcell">Quentin Burdick Bldg, 102</td>
<td class="advcell">Alex Radermacher</td>
</tr>
<td class="advcell"><input type="checkbox" name="select"</td>
<td class="advcell">STAT367</td>
<td class="advcell">Statistics</td>
<td class="advcell">TuTh 2:00PM - 2:50PM</td>
<td class="advcell">Van Es, 101</td>
<td class="advcell">Tatjana</td>
</tr>
</table>
<br />
<button style="float:right">Drop selected classes</button>
<br /><br />
</body>
</html>