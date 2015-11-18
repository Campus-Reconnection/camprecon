<?php

//Main Categories
$genReq = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">GENERAL EDUCATION REQUIREMENTS - X Credits Required</td></tr>\r\n";
$collegeReq = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">COLLEGE REQUIREMENTS for a BS Degree - X Additional Credits Required</td></tr>\r\n";
$deptReq = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">DEPARTMENT REQUIREMENT</td></tr>\r\n";
$majorReq = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">MAJOR REQUIREMENTS - X Credits</td></tr>\r\n";
$univReq = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">UNIVERSITY GRADUATION REQUIREMENTS</td></tr>\r\n";
$relatedReq = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">Related Required Courses - X Credits Required</td></tr>\r\n";
$additCourses = "<tr><td id=\"plannerReq\" COLSPAN=\"5\">Additional Courses - X Credits Required</td></tr>\r\n";

//Sub Categories
$firstYear = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">First Year Experience (F)</td></tr>\r\n";
$comm = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Communication (C)</td></tr>\r\n";
$quanReas = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Quantitative Reasoning (R)</td></tr>\r\n";
$sciTech = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Science and Technology (S)</td></tr>\r\n";
$humFineArt = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Humanities and Fine Arts (A)</td></tr>\r\n";
$socBehSci = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Social and Behavioral Sciences (B)</td></tr>\r\n";
$wellness = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Wellness (W)</td></tr>\r\n";
$cultDiv = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Cultural Diversity (D)</td></tr>\r\n";
$globalPer = "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Global Perspectives (G)</td></tr>\r\n";

echo "<table BORDER=\"3\" id=\"planner\">\r\n";
echo "<tbody>\r\n";
echo $genReq;
echo "<tr><td>Course</td><td>Number</td><td>Course Title</td><td>Credits</td><td>Grade</td></tr>\r\n";
echo $firstYear;
echo "<tr><td>UNIV</td><td>189</td><td>Skills for Academic Success</td><td>1</td><td>A</td></tr>\r\n";
echo $comm;
echo "<tr><td>ENGL</td><td>110</td><td>College Composition I</td><td>3</td><td>A</td></tr>\r\n";
echo "<tr><td>ENGL</td><td>120</td><td>College Composition II</td><td>3</td><td>A</td></tr>\r\n";
echo $quanReas;
echo $sciTech;
echo $humFineArt;
echo $socBehSci;
echo $wellness;
echo $cultDiv;
echo $globalPer;
echo $collegeReq;
echo $deptReq;
echo $majorReq;
echo "<tr><td id=\"plannerReq\" COLSPAN=\"5\">X Credits of Computer Science Electives </td></tr>\r\n";
echo "<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Software Engineering: </td></tr>\r\n
	<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Large Systems: </td></tr>\r\n
	<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Systems Modeling: </td></tr>\r\n
	<tr><td id=\"plannerSubReq\" COLSPAN=\"5\">Emerging Areas: </td></tr>\r\n";
echo $relatedReq;
echo "<tr><td id=\"plannerReq\"COLSPAN=\"5\">One Year Lab Science Sequence - X Credits Required</td></tr>\r\n";
echo $additCourses;
echo "</tbody>\r\n";
echo "</table>\r\n";
echo "<br />\r\n";
echo "<table BORDER=\"3\" id=\"planner\">\r\n
				<tbody>
					<tr><td id=\"plannerReq\" COLSPAN=\"3\">UNIVERSITY GRADUATION REQUIREMENTS</td></tr>\r\n
					<tr><td COLSPAN=\"3\">Residency at NDSU (15 credits at NDSU):</td></tr>\r\n
					<tr><td COLSPAN=\"3\">Credits at a 4-year University:</td></tr>\r\n
					<tr><td COLSPAN=\"3\">Courses numbered 300+ (Min. 15 credits at NDSU):</td></tr>\r\n
					<tr><td COLSPAN=\"3\">Total Credits Required:</td></tr>\r\n
				</tbody>\r\n
			</table>\r\n";
?>