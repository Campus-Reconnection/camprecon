<?php

function getEmergencyContactInfo() {}

function getPermenantContactInfo() {}

function getWeeklySchedule() {}

function getAdvisorWeeklySchedule() {}

function getNotifications() {}

function getCurrentTerm() {}

function getDefaultInstitution() {}

function getCurrentStudentCourseList() {}

function getFacultySectionList() {}

function getSelectedCourseCoordinates() {}

function getAllStudentCoursesDone() {}

function getStudentMajor($conn, $id)
{
	$sql = "SELECT major1, major2, major3 FROM Student WHERE StudentID = $id";
	$result = $conn->query($sql);
	return $result;
}

function getStudentMinor($conn, $id)
{
	$sql = "SELECT minor1, minor2, minor3 FROM Student WHERE StudentID = $id";
	$result = $conn->query($sql);
	return $result;
}

function getAdviseeRoster() {}

function ValidateUserCredentials() {}

?>
