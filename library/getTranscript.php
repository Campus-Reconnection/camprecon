<?php
//session_start();
require("system.php");
//loginHandler();

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	//$eid = $_SESSION['cruser'];
	$eid = "girl.nobody"; // temporary solution
	$mysqli = getMysqli();
	
	$sql = "SELECT crs.strCourseName AS courseName,
			   crs.intCredits AS courseCredits,
			   crs.strCourseID AS courseId,
			   sec.intYear AS sectionYear,
			   sec.strSeason AS sectionSeason,
			   enr.strSectionGrade AS courseGrade
			FROM tblStudentEnrollment enr
			JOIN tblSection sec ON enr.intSectionID = sec.intSectionID
			JOIN tblCourse crs ON sec.strCourseID = crs.strCourseID
			JOIN tblStudent stu ON stu.intStudentID = enr.intStudentID
			WHERE stu.strStudentEID = ?
			ORDER BY sectionYear,
				CASE WHEN sectionSeason = 'Spring' THEN 0
				when sectionSeason = 'Summer' THEN 1
				when sectionSeason = 'Fall' THEN 2
				END,
				courseID;";
				
	$query = $mysqli->prepare($sql);
	if ($query) {
		$query->bind_param"'s", $eid);
		if ($query->execute())
		{
			$result = $query->get_result();
			$transcript = $result->fetch_all(MYSQLI_ASSOC);
			$struct = array("transcript" => $transcript);
			print json_encode($struct);
			$query->close();
		}
	}
	$mysqli->close();
}
else {echo "Nice try.";}
?>