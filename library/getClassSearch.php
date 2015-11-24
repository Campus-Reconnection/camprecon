<?php

function searchCourses($search)
{
	$sql = "SELECT DISTINCT strCourseName AS courseName,
		intSectionID AS secID,
		intSectionNumber AS secNumber,
		strFirstName,
		strLastName,
		strDayFormat,
		CONCAT(DATE_FORMAT(timStartTime,'%l:%i%p'),'-',DATE_FORMAT(timEndTime,'%l:%i%p')) AS time,
		strFacilityName,
		strRoomNumber
		FROM tblCourse
		INNER JOIN tblsection ON tblcourse.strCourseID = tblsection.strCourseID
		INNER JOIN tblfaculty ON tblsection.intFacultyID = tblfaculty.intFacultyID
		INNER JOIN tblsectionschedule ON tblsection.intScheduleID = tblsectionschedule.intDaySlotID
		INNER JOIN tblsectiontimes ON tblsection.intTimeSlotID = tblsectiontimes.intTimeSlotID
		INNER JOIN tblroom ON tblsection.strRoomID = tblRoom.intRoomID
		INNER JOIN tblfacility ON tblroom.intFacilityID = tblFacility.intFacilityID
		WHERE tblcourse.strCourseID LIKE '$search' OR
			tblcourse.strDeptCode LIKE '%$search%' OR
			tblfaculty.strLastName LIKE '$search' OR
			tblfaculty.strFirstName LIKE '$search' OR
			tblcourse.strCourseName LIKE '%$search%'";

	$result = queryDB($sql);

	if (mysqli_num_rows($result) > 0)
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
		echo "</thead><tbody><tr>";
		
		while($row = mysqli_fetch_assoc($result))
		{
			echo "<td class=\"advcell\"><input type=\"checkbox\" name=\"check[".$row['secID']."]\" value=\"\" /></td>";
			echo "<td class=\"advcell\">".$row['courseName']."</td>";
			echo "<td class=\"advcell\">".$row['secNumber']."</td>";
			echo "<td class=\"advcell\">".$row['strDayFormat']."</td>";
			echo "<td class=\"advcell\">".$row['time']."</td>";
			echo "<td class=\"advcell\">".$row['strFirstName'].' '.$row['strLastName']."</td>";
			echo "<td class=\"advcell\">".$row['strFacilityName']."</td>";
			echo "<td class=\"advcell\">".$row['strRoomNumber']."</td>";
			echo "</tr></tbody>";	
		}
	}
	else
	{
		echo "<tr><td class=\"advcell\">Your search returned no results.</td></tr>";
	}
}

function addCourse($secID)
{
	$sql = "INSERT INTO tblstudentenrollment VALUES($secID)";
	$result = queryDB($sql);
}

function getAllDepartments()
{
	$sql = "SELECT * FROM tbldepartment ORDER BY strDeptCode ASC";
	return $sql;
}

?>