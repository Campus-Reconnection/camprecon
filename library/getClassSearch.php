<?php
require("system.php");

$sql = "SELECT strCourseName as courseName,
			intSectionNumber as secNumber,
			intSectionTimeStart as secStartTime,
			intSectionTimeEnd as secEndTime,
			strDayPattern as dayPattern,
			dtmStart, dtmEnd,
			strFirstName, strLastName,
			strFacilityName, intRoomNumber
			FROM tblCourse
			INNER JOIN tblSection ON tblCourse.intCourseID = tblSection.intCourseID
			INNER JOIN tblSectionTime ON tblSection.intTimeSlotID = tblSectionTime.intTimeSlotID
			INNER JOIN tblSectionDayPattern ON tblSection.intDayPattern = tblSectionDayPattern.intDayPattern
			INNER JOIN tblFaculty ON tblSection.intFacultyID = tblFaculty.intFacultyID
			INNER JOIN tblRoom ON tblSection.intRoomID = tblRoom.intRoomID
			INNER JOIN tblFacility ON tblRoom.intFacilityID = tblFacility.intFacilityID
			WHERE tblCourse.strDepartment like '%$q%' or tblCourse.strCourseID like '%$q%'";

$result = queryDB($sql);

if (mysqli_num_rows($result) > 0)
{
	foreach($rows as $row) {
		echo "<tr>";
			echo "<td>".$row['courseName']."</td>";
			#do this for all attributes

		echo "</tr>";	
	}
}

?>