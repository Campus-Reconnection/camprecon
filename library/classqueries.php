<?php

/*
// Search for class by class ID 
// param: class ID ( CSCI222, STAT360, ...)
// return: ID, Name, and Section
*/
function classSearchID($id) {
	$sql = "SELECT strCourseID, strCourseName, intSectionNumber
		FROM tblCourse
		WHERE tblCourse.strCourseID = $id
		INNER JOIN tblSection
		ON tblSection.strCourseID = tblCourse.strCourseID";
	$result = $conn->query($sql);
	return $result;
}

/*
// Get class sections from department name
// param: department name (Computer Science, Psychology, ...)
// return: ID, Name, and Section
*/
function classSearchDep($dep) {
	$sql = "SELECT strCourseID, strCourseName, intSectionNumber
		FROM tblCourse
		WHERE tblCourse.strDepartment = $dep
		INNER JOIN tblSection
		ON tblSection.strCourseID = tblCourse.strCourseID";
	$result = $conn->query($sql);
	return $result;
}

/*
// Get the scheduling information about a certain section
// param: sectionid (123456789098, ...)
// return: start time, end time, days
*/
function getSectionTime($sectionid) {
	$sql = "SELECT intSectionTimeStart, intSectionTimeEnd, strDayPattern
		FROM tblSectionTime, tblSectionDayPattern
		WHERE tblSection.sectionID = $sectionid";
	$result = $conn->query($sql);
	return $result;
}

/*
// Get the date the section is scheduled for
// param: sectionid (123456789098, ...)
// return: start date, end date
*/
function getSectionDate($sectionid) {
	$sql = "SELECT dtmStart, dtmEnd
		FROM tblSection
		WHERE sectionID = $sectionid";
	$result = $conn->query($sql);
	return $result;
}

/*
// Get the professors name for the section
// param: sectionid (123456789098, ...)
// return: first name, last name
*/
function getSectionProf($sectionid) {
	$sql = "SELECT strFirstName, strLastName
		FROM tblFaculty
		WHERE tblSection.intSectionID = $sectionid 
		AND tblSection.intFacultyID = tblFaculty.intFacultyID";
	$result = $conn->query($sql);
	return $result;
}

/*
// Get the number of students allowed in a section
// param: sectionid (123456789098, ...)
// return: capacity
*/
function getSectionCapacity($sectionid) {
	$sql = "SELECT intCapacity
		FROM tblSection
		WHERE intSectionID = $sectionid";
	$result = $conn->query($sql);
	return $result;

}

/*
// Get a description of the course
// param: course id (CSCI222, STAT360, ...)
// return: course description
*/
function getCourseDescription($courseID) {
	$sql = "SELECT strCourseDescription
		FROM tblCourse
		WHERE strCourseID = $courseID";
	$result = $conn->query($sql);
	return $result;
}

/*
// Get the location of the section
// param: sectionid (123456789098, ...)
// return: building and room number
*/
function getSectionRoom($sectionid) {
	$sql = "SELECT strFacilityName, intRoomNumber
		FROM tblFacility, tblRoom
		WHERE tblSection.intSectionID = $sectionID
		AND tblSection.intRoomID = tblRoom.intRoomID
		AND tblRoom.intFacilityID = tblFacility.intFacilityID";
	$result = $conn->query($sql);
	return $result;
}

function getAllDepartments() {
	$sql = "SELECT strDepartment
		FROM tblCourse";
	$result = $conn->query($sql);
	return $result;
}

?>