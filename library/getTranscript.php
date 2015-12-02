<?php
if (session_status() == PHP_SESSION_NONE) session_start();
	require_once("system.php");
	loginHandler();

if ($_SERVER["REQUEST_METHOD"] == "GET"){
	$eid = $_SESSION['cruser'];
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

	$transcript = dbGetAll($sql, "s", $eid);
	if ($transcript)
	{
		$struct = array("transcript" => $transcript);
		print json_encode($struct);
	}
	else
	{
		// Error?
	}
}
else {echo "Nice try.";}
?>