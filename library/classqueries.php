<?php

/*
// Search for class by class ID 
// param: class ID ( CSCI222, STAT360, ...)
// return: an associative array containing ID, course name, and section number; false on fail
*/
function classSearchID($id) {
	$sql = "SELECT strCourseID, strCourseName, intSectionNumber
		FROM tblCourse
		WHERE tblCourse.strCourseID = ?
		INNER JOIN tblSection
		ON tblSection.strCourseID = tblCourse.strCourseID";
	if ($result = dbGetAll($sql, "s", $id))
		return $result;
	return false;
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

function returnCourses($javascriptable)
{
	$sql = "SELECT DISTINCT strCourseName AS courseName,
		tblsection.intSectionID AS secID,
		CONCAT(tblcourse.strCourseID,'-',intSectionNumber) AS secNumber,
		tblcourse.strCourseID AS secBareCourse,
		tblfaculty.strFirstName,
		tblfaculty.strLastName,
		strDayFormat,
		CONCAT(DATE_FORMAT(timStartTime,'%l:%i%p'),'-',DATE_FORMAT(timEndTime,'%l:%i%p')) AS time,
		strFacilityName,
		strRoomNumber
		FROM tblstudentenrollment
		JOIN tblsection ON tblstudentenrollment.intSectionID = tblsection.intSectionID
		JOIN tblcourse ON tblsection.strCourseID = tblcourse.strCourseID
		JOIN tblfaculty ON tblsection.intFacultyID = tblfaculty.intFacultyID
		JOIN tblsectionschedule ON tblsection.intScheduleID = tblsectionschedule.intDaySlotID
		JOIN tblsectiontimes ON tblsection.intTimeSlotID = tblsectiontimes.intTimeSlotID
		JOIN tblroom ON tblsection.intRoomID = tblRoom.intRoomID
		JOIN tblfacility ON tblroom.intFacilityID = tblFacility.intFacilityID
        JOIN tblstudent ON tblstudentenrollment.intStudentID = tblstudent.intStudentID
        WHERE tblstudent.strStudentEID = ?;";

	if ($result = dbGetAll($sql, "s", $_SESSION["cruser"]))
	{
		echo "<thead>";
		echo "<tr><td class=\"thr\">Select</td>";
		echo "<td class=\"thr\">Course Name</td>";
		echo "<td class=\"thr\">Section</td>";
		echo "<td class=\"thr\">Schedule</td>";
		echo "<td class=\"thr\">Time</td>";
		echo "<td class=\"thr\">Instructor</td>";
		echo "<td class=\"thr\">Facility</td>";
		echo "<td class=\"thr\">Room</td></tr>";
		echo "</thead><tbody>";
		
		foreach ($result as $row)
		{
			echo "<tr>";
			if ($javascriptable == true)
				{echo "<td class=\"advcell\"><input type=\"checkbox\" name=\"check[]\" value=\"" .$row['secID']. "\" onchange=\"checkchanged('" . $row["secBareCourse"] . "')\" /></td>";}
			else
				{echo "<td class=\"advcell\"><input type=\"checkbox\" name=\"check[]\" value=\"" .$row['secID']. "\" /></td>";}
			echo "<td class=\"advcell\">".$row['courseName']."</td>";
			echo "<td class=\"advcell\">".$row['secNumber']."</td>";
			echo "<td class=\"advcell\">".$row['strDayFormat']."</td>";
			echo "<td class=\"advcell\">".$row['time']."</td>";
			echo "<td class=\"advcell\">".$row['strFirstName'].' '.$row['strLastName']."</td>";
			echo "<td class=\"advcell\">".$row['strFacilityName']."</td>";
			echo "<td class=\"advcell\">".$row['strRoomNumber']."</td>";	
			echo "</tr>";
		}
		
		echo "</tbody>";
		
	}
	else
	{
		echo "<tr><td class=\"advcell\">You are not signed up for any classes.</td></tr>";
	}
}

function deleteCourses($secID) 
{
	$sql = "DELETE enr FROM tblstudentenrollment enr
		JOIN tblstudent stu ON enr.intStudentID = stu.intStudentID
		WHERE enr.intSectionID = ? AND stu.strStudentEID = ?;";
	return dbPush($sql, "is", $secID, $_SESSION["cruser"]);
}
?>