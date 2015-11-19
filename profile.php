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
<span class="title">Student Profile:</span>
<br />
<div>
<img src="images/profilepicture.png" id="profile-image" alt="Profile picture" />
</div>
<div id="profile-info">
<table class="schedule">
  <tr>
  <td class="thr">Key</td>
  <td class="thr">Value</td>
  </tr>
  <tr>
  <td class="advcell">ID:</td>
  <td class="advcell">0000000</td>
  </tr>
  <tr>
  <td class="advcell">Name:</td>
  <td class="advcell">Derp Vader</td>
  </tr>
  <tr>
  <td class="advcell">Date of Birth:</td>
  <td class="advcell">long/time/ago</td>
  </tr>
  <tr>
  <td class="advcell">Address:</td>
  <td class="advcell">502 Death Star Blvd, A galaxy far far away</td>
  </tr>
  <tr>
  <td class="advcell">Phone:</td>
  <td class="advcell">(444) 444-4444</td>
  </tr>
  <tr>
  <td class="advcell">Major:</td>
  <td class="advcell">Dark Side</td>
  </tr>
  <tr>
  <td class="advcell">GPA:</td>
  <td class="advcell">3.00</td>
  </tr>
  <tr>
  <td class="advcell">Advisor:</td>
  <td class="advcell">Derp Sidius</td>
  </tr>
  <tr>
  <td class="advcell">Emergency Contact:</td>
  <td class="advcell">Mom</td>
  </tr>
  <tr>
  <td class="advcell">Phone:</td>
  <td class="advcell">(555) 555-5555</td>
  </tr>
  <tr>
  <td class="advcell">Alt Phone:</td>
  <td class="advcell">(666) 666-6666</td>
  </tr>
  <tr>
  <td class="advcell">Active Military:</td>
  <td class="advcell">Yes</td>
  </tr>
  <tr>
  <td class="advcell">Enrollment Status:</td>
  <td class="advcell">Full Time</td>
  </tr>
  <tr>
  <td class="advcell">Credits Earned:</td>
  <td class="advcell">99</td>
  </tr>
  <tr>
  <td class="advcell">Academic Standing:</td>
  <td class="advcell">Junior</td>
  </tr>
</table>
</div>
<br>
</body>
</html>