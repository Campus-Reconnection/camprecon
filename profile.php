<?php session_start(); require_once("library/system.php"); require_once("library/basicqueries.php"); loginHandler();

function formatAddress($address) {
	if ($address)
		return $address['street']."<br />".$address['city'].", ".$address['state']."<br />".$address['country']."<br />".$address['postCode'];
	return "";
}
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
<?php
	$id = ($r = getStudentID($_SESSION['cruser'])) ? $r : "";
	$name = ($r = getStudentFullName($_SESSION['cruser'])) ? $r : "";
	$dob = ($r = getStudentDateOfBirth($_SESSION['cruser'])) ? date_create($r): date_create("1990-00-00");
	$age = date_diff(date_create(), $dob)->format("%y");
	$status = ($r = getStudentStatus($_SESSION['cruser'])) ? $r : "";
	$enroll = ($r = getStudentEnrollment($_SESSION['cruser'])) ? $r : "";
	$type = ($r = getStudentType($_SESSION['cruser'])) ? $r : "";
	$aService = getActiveService($_SESSION['cruser']) ? "Yes" : "No";
	$majors = ($r = getStudentMajors($_SESSION['cruser'])) ? $r : null;
	$major1 = isset($majors[0]) ? $majors[0][0] : "Undeclared";
	$major2 = isset($majors[1]) ? $majors[1][0] : "";
	$major3 = isset($majors[2]) ? $majors[2][0] : "";
	$minors = ($r = getStudentMinors($_SESSION['cruser'])) ? $r : null;
	$minor1 = isset($minors[0]) ? $minors[0][0] : "---";
	$minor2 = isset($minors[1]) ? $minors[1][0] : "";
	$minor3 = isset($minors[2]) ? $minors[2][0] : "";
	echo "<tr><td>ID:</td><td>".$id."</td><td>Status:</td><td>".$status."</td></tr>";
	echo "<tr><td>Name:</td><td>".$name."</td><td>Standing:</td><td>".$type."</td></tr>";
	echo "<tr><td>Date of Birth:</td><td>".date_format($dob, "M jS, Y")."</td><td>Enrollment:</td><td>".$enroll."</td></tr>";
	echo "<tr><td>Age:</td><td>".$age."</td><td>Active Military:</td><td>".$aService."</td></tr>";
	echo "<tr><td></td><td></td><td></td><td></td></tr>";
	echo "<tr><td>Majors:</td><td>".$major1."</td><td>Minors:</td><td>".$minor1."</td></tr>";
	echo "<tr><td></td><td>".$major2."</td><td></td><td>".$minor2."</td></tr>";
	echo "<tr><td></td><td>".$major3."</td><td></td><td>".$minor3."</td></tr>";
?>
</table>
</div>
<div class="profileTabContent" id="contact">
<table class="profile">
<?php
	$a = getPermanentContactInfo($_SESSION['cruser']);
	$b = getSchoolContactInfo($_SESSION['cruser']);
	$a1 = $a ? [formatAddress($a), $a['email'], $a['mobileNumber'], $a['homeNumber']] : ["", "", "", ""];
	$b1 = $b ? [formatAddress($b), $b['email']] : ["", ""];
	echo "<tr><td>Permanent<br />Address:</td><td>".$a1[0]."</td><td>School<br />Address:</td><td>".$b1[0]."</td></tr>";
	echo "<tr><td></td><td></td><td></td><td></td></tr>";
	echo "<tr><td>Personal Email:</td><td>".$a1[1]."</td><td>School Email:</td><td>".$b1[1]."</td></tr>";
	echo "<tr><td></td><td></td><td></td><td></td></tr>";
	echo "<tr><td>Mobile Phone:</td><td>".$a1[2]."</td></tr>";
	echo "<tr><td>Home Phone:</td><td>".$a1[3]."</td></tr>";
	echo "<tr><td>Work Phone:</td><td></td></tr>";
?>
</table>
</div>
<div class="profileTabContent" id="emergency">
<table class="profile">
<?php
	$c = getEmergencyContacts($_SESSION['cruser']);
	$c1 = isset($c[0]) ? [$c[0]['firstName']." ".$c[0]['lastName'], $c[0]['relation'], formatAddress($c[0]), $c[0]['mobileNumber'], $c[0]['homeNumber']] : ["", "", "", "", ""];
	$c2 = isset($c[1]) ? [$c[1]['firstName']." ".$c[1]['lastName'], $c[1]['relation'], formatAddress($c[1]), $c[1]['mobileNumber'], $c[1]['homeNumber']] : ["", "", "", "", ""];
	echo "<tr><td>Contact #1:</td><td>".$c1[0]."</td><td>Contact #2:</td><td>".$c2[0]."</td></tr>";
	echo "<tr><td>Relation:</td><td>".$c1[1]."</td><td>Relation:</td><td>".$c2[1]."</td></tr>";
	echo "<tr><td>Address:</td><td>".$c1[2]."</td><td>Address:</td><td>".$c2[2]."</td></tr>";
	echo "<tr><td></td><td></td><td></td><td></td></tr>";
	echo "<tr><td>Phone:</td><td>".$c1[3]."</td><td>Phone:</td><td>".$c2[3]."</td></tr>";
	echo "<tr><td>Alt Phone:</td><td>".$c1[4]."</td><td>Alt Phone:</td><td>".$c2[4]."</td></tr>";
?>
</table>
</div>
</div>
</div>
</div>
<br>
</body>
</html>