<?php

require('system.php');

$sql = "SELECT crs.strCourseName as courseName,
			   crs.intCredits as courseCredits,
			   crs.strCourseID as courseId,
			   sec.intYear as sectionYear,
			   sec.strSeason as sectionSeason,
			   enr.strSectionGrade as courseGrade
			FROM tblStudentEnrollment enr
			JOIN tblSection sec ON enr.intSectionID = sec.intSectionID
			JOIN tblCourse crs ON sec.strCourseID = crs.strCourseID
			WHERE enr.intStudentID = 0
			ORDER BY sectionYear,
				case when sectionSeason = 'Spring' then 0
				when sectionSeason = 'Summer' then 1
				when sectionSeason = 'Fall' then 2
				end,
				courseID;";
$result = queryDB($sql);
if (mysqli_num_rows($result) > 0)
{
	//$xml = new SimpleXMLElement("<transcript></transcript>");
	//foreach($result as $key => $value) {
	//	$courseNode = $xml->addChild("course");
	//	foreach($value as $key2 => $value2) {
	//		$lcKey2 = strtolower($key2);
	//		$courseNode->addChild("$lcKey2",htmlspecialchars("$value2"));
	//	}
	//}
	//echo $xml->asXML();
	
	while ($row = mysqli_fetch_assoc($result)) {
		$transcript[] = $row;
	}

	$struct = array("transcript" => $transcript);
	print json_encode($struct);
}