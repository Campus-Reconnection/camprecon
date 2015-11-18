<?php
require("system.php");

function searchCourses($dep, $course) {

$sql = "SELECT strCourseName as courseName,
			intSectionID as secID,
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
			WHERE tblCourse.strDeptCode like '%$dep%'";

	if(!empty($course)) {
		$sql = $sql . " AND tblCourse.strCourseID like '".$course."'";
	}

$result = queryDB($sql);

if (mysqli_num_rows($result) > 0)
{
	foreach($rows as $row) {
		echo "<tr>";
			echo "<td>".$row['courseName']."</td>";
			echo "<td>".$row['secID']."</td>";
			echo "<td>".$row['secNumber']."</td>";
			echo "<td>".$row['secStartTime']."</td>";
			echo "<td>".$row['secEndTime']."</td>";
			echo "<td>".$row['dayPattern']."</td>";
			echo "<td>".$row['dtmStart']."</td>";
			echo "<td>".$row['dtmEnd']."</td>";
			echo "<td>".$row['strFirstName']."</td>";
			echo "<td>".$row['strLastName']."</td>";
			echo "<td>".$row['strFacilityName']."</td>";
			echo "<td>".$row['intRoomNumber']."</td>";
			echo "<td> <input type=\"checkbox\" name=\"check[{$row['secID']}]\" value=\"\" id=\"checkbox\" /> </td>";
		echo "</tr>";	
	}
}

}

function addCourse($secID) {

	$sql = "INSERT INTO tblstudentenrollment VALUES(
		$secID)";

	$result = queryDB($sql);
}

function getAllDepartments() {
	$sql = "SELECT * FROM `tbldepartment` ORDER BY `tbldepartment`.`strDeptCode` ASC";
	return $sql;
}

?>