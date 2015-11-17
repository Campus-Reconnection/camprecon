<?php

function getEmergencyContactInfo($conn,$id)
{
	$sql = "SELECT intEmergencyNumber, strEmergencyContactLastName, strEmergencyContactFirstName FROM tblUserContact WHERE intExternalID = $id";
	return mysqli_query($conn,$sql);
}

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

function getStudentMajor($conn,$id)
{
	$sql = "SELECT strMajor1, strMajor2, strMajor3 FROM tblstudent WHERE intStudentID = $id";
	return mysqli_query($conn,$sql);
}

function getStudentMinor($conn,$id)
{
	$sql = "SELECT strMinor1, strMinor2, strMinor3 FROM tblstudent WHERE intStudentID = $id";
	return mysqli_query($conn,$sql);
}

function getAdviseeRoster() {}

function ValidateUserCredentials() {}

?>
