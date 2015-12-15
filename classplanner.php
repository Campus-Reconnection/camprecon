<?php session_start(); require("library/system.php"); loginHandler(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" type="image/ico" href="images/favicon.ico" />
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
<table class="plantable">
<tr>
<td class="planblack" colspan="5">GENERAL EDUCATION REQUIREMENTS - 40 Credits Required</td>
</tr><tr>
<td class="planhead">Course</td><td class="planhead">Number</td><td class="planhead">Course Title</td><td class="planhead">Credits</td><td class="planhead">Grade</td>
</tr><tr>
<td colspan="5" class="plangrey">First Year Experience(F) - 1 credit</td>
</tr><tr>
<td class="planreg">UNIV</td><td class="planreg">189</td><td class="planreg">Skills for Academic Success</td><td class="planregcenter">1</td><td class="planregcenter">A</td>
</tr><tr>
<td colspan="5" class="plangrey">Communication (C) - 12 credits</td>
</tr><tr>
<td class="planreg">ENGL</td><td class="planreg">110</td><td class="planreg">College Composition I</td><td class="planregcenter">3</td><td class="planregcenter">B</td>
</tr><tr>
<td class="planreg">ENGL</td><td class="planreg">120</td><td class="planreg">College Composition II</td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td class="planreg">COMM</td><td class="planreg">110</td><td class="planreg">Fundamentals of Public Speaking</td><td class="planregcenter">3</td><td class="planregcenter">B</td>
</tr><tr>
<td class="planreg">ENGL</td><td class="planreg">321 or 324</td><td class="planreg">(Upper-Division Writing)</td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td colspan="5" class="plangrey">Quantitative Reasoning (R) - 3 credits</td>
</tr><tr>
<td class="planreg">Math</td><td class="planreg">165</td><td class="planreg">Calculus I</td><td class="planregcenter">4</td><td class="planregcenter">C</td>
</tr><tr>
<td colspan="5" class="plangrey">Science & Technology (S) - 10 credits</td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">4</td><td class="planregcenter"></td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td colspan="5" class="plangrey">Humanities & Fine Arts (A) - 6 credits</td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td colspan="5" class="plangrey">Social & Behavioral Sciences (B) - 6 credits</td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td colspan="5" class="plangrey">Wellness (W) - 2 credits</td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">2</td><td class="planregcenter"></td>
</tr><tr>
<td colspan="5" class="plangrey">Cultural Diversity (D)</td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr><tr>
<td colspan="5" class="plangrey">Global Perspectives (G)</td>
</tr><tr>
<td class="planreg"></td><td class="planreg"></td><td class="planreg"></td><td class="planregcenter">3</td><td class="planregcenter"></td>
</tr>
</table>
<!--<img src="images/menatwork.png" width="128px;" />
<br />-->
<br />
<input type="button" value="Open Map" onclick="openMap()" />
</div>
</div>
</body>
</html>