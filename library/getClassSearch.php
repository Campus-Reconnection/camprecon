<?php
require("system.php");

function searchCourses($course) {

$sql = "SELECT strCourseName as courseName,
			intSectionID as secID,
			intSectionNumber as secNumber,
			dtmStart, dtmEnd,
			strFirstName, strLastName,
			strFacilityName, strRoomNumber
			FROM tblCourse
			INNER JOIN tblsection ON tblcourse.strCourseID = tblsection.strCourseID
			INNER JOIN tblfaculty ON tblsection.intFacultyID = tblfaculty.intFacultyID
			INNER JOIN tblroom ON tblsection.strRoomID = tblRoom.intRoomID
			INNER JOIN tblfacility ON tblroom.intFacilityID = tblFacility.intFacilityID
			WHERE tblcourse.strCourseID like '$course'";

$result = queryDB($sql);

if (mysqli_num_rows($result) > 0)
{
	foreach($rows as $row) {
		echo "<tr>";
			echo "<td>".$row['courseName']."</td>";
			echo "<td>".$row['secID']."</td>";
			echo "<td>".$row['secNumber']."</td>";
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