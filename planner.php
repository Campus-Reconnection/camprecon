<?php
	require("library/system.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Campus Reconnection</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<SCRIPT SRC="javascript/jquery-2.1.4.min.js"></SCRIPT>
	<script>
	</script>
</head>
<body>
	<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
	<div id="pagediv">
		<?php include("includes/menustrip.php"); ?>
		<span class="title">Class Planner</span>
		<br />
		<br />
		<br />
		<br />
		<div id="plannerDiv">
			<table BORDER="3" id="generalEdReq">
				<thead>GENERAL EDUCATION REQUIREMENTS - X Credits Required</thead>
				<tbody>
					<tr><td>Course</td><td>Number</td><td>Course Title</td><td>Credits</td><td>Grade</td></tr>
					<tr><td COLSPAN="5">First Year Experience (F)</td></tr>
					<tr><td COLSPAN="5">Communication (C)</td></tr>
					<tr><td COLSPAN="5">Quantitative Reasoning (R)</td></tr>
					<tr><td COLSPAN="5">Science and Technology (S)</td></tr>
					<tr><td COLSPAN="5">Humanities and Fine Arts (A)</td></tr>
					<tr><td COLSPAN="5">Social and Behavioral Sciences (B)</td></tr>
					<tr><td COLSPAN="5">Wellness (W)</td></tr>
					<tr><td COLSPAN="5">Cultural Diversity (D)</td></tr>
					<tr><td COLSPAN="5">Global Perspectives (G)</td></tr>
					<tr><td COLSPAN="5">The College of Science and Mathematics requires an additional 6 credits in Humanites or Social Sciences for the BS degree.</td></tr>
					<tr><td COLSPAN="5">COLLEGE REQUIREMENTS for a BS Degree</td></tr>
					<tr><td COLSPAN="5">DEPARTMENT REQUIREMENT</td></tr>
					<tr><td COLSPAN="5">MAJOR REQUIREMENTS - X Credits</td></tr>
					<tr><td COLSPAN="5">X Credits of Computer Science Electives </td></tr>
				</tbody>
			</table>
			
					
			<br />
		</div>
		<div id='overlay'></div>
		
	</div>
</body>
</html>