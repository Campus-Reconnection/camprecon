<?php session_start(); require_once("library/system.php"); loginHandler();
?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="javascript/profile.js"></script>
</head>
<body onload="init()">
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Student Profile:</span>
<br /><br />
<ul id="tabs">
  <li><a href="#about">About</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#emergency">Emergency</a></li>
</ul>
<div id="profileDiv">
<img src="images/derpvader.jpg" alt="Profile picture" id="profilePicture" />
<div style="margin-left:250px;">
<div class="profileTabContent" id="about">
<table class="profile">
  <tr>
  <td>ID:</td>
  <td>0000001</td>
  </tr>
  <tr>
  <td>Name:</td>
  <td>Derp Vader</td>
  </tr>
  <tr><td></td><td></td></tr>
  <tr>
  <td>Standing:</td>
  <td>Junior</td>
  </tr>
  <tr>
  <td>Enrollment:</td>
  <td>Full Time</td>
  </tr>
  <tr>
  <td>Status:</td>
  <td>Active</td>
  </tr>
  <tr>
  <td>Major:</td>
  <td>Dark Side</td>
  </tr>
  <tr>
  <td>Minor:</td>
  <td>---</td>
  </tr>
  <tr>
  <td>Active Military:</td>
  <td>Yes</td>
  </tr>
</table>
</div>
<div class="profileTabContent" id="contact">
<table class="profile">
  <tr>
  <td>Address:</td>
  <td>502 Death Star</td>
  </tr>
  <tr>
  <td></td>
  <td>Some Galaxy</td>
  </tr>
  <tr>
  <td></td>
  <td>Far, Far Away</td>
  </tr>
  <tr>
  <td></td>
  <td>58102</td>
  </tr>
  <tr><td></td><td></td></tr>
  <tr>
  <td>Phone:</td>
  <td>(444)-444-4444</td>
  </tr>
  <tr><td></td><td></td></tr>
  <tr>
  <td>Email:</td>
  <td>derp.vader@ndsu.edu</td>
  </tr>
  <tr>
  <td></td>
  <td>coolsith69@hotmail.com</td>
  </tr>
</table>
</div>
<div class="profileTabContent" id="emergency">
<table class="profile">
  <tr>
  <td>Emergency Contact #1:</td>
  <td>Mommy Vader</td>
  <td>Emergency Contact #2:</td>
  <td>Daddy Vader</td>
  </tr>
  <tr>
  <td>Relation:</td>
  <td>Mother</td>
  <td>Relation:</td>
  <td>Father</td>
  </tr>
  <tr>
  <td>Address:</td>
  <td>559 Death Star II</td>
  <td>Address:</td>
  <td>559 Death Star II</td>
  </tr>
  <tr>
  <td></td>
  <td>Some Other Galaxy</td>
  <td></td>
  <td>Some Other Galaxy</td>
  </tr>
  <tr>
  <td></td>
  <td>Astonishingly Close By</td>
  <td></td>
  <td>Astonishingly Close By</td>
  </tr>
  <tr>
  <td></td>
  <td>90431</td>
  <td></td>
  <td>90431</td>
  </tr>
  <tr><td></td><td></td></tr>
  <tr>
  <td>Phone:</td>
  <td>(555)-555-5555</td>
  <td>Phone:</td>
  <td>(555)-555-5555</td>
  </tr>
  <tr>
  <td>Alt Phone:</td>
  <td>(666)-666-6666</td>
  <td>Alt Phone:</td>
  <td>(777)-777-7777</td>
  </tr>
</table>
</div>
</div>
</div>
</div>
<br>
</body>
</html>