<?php
require("../library/system.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") // Only respond to POST requests from JQuery
{
	$type = fixInput($_POST["type"]); // Choose type of response
	
	switch ($type) {
		case 'room':
			// Fix response data
			$facilityId = fixInput($_POST["facilityId"]);
			$roomNumber = fixInput($_POST["roomNumber"]);
			$seats = fixInput($_POST["seats"]);
			
			// Check if record already exists
			$sql = "SELECT intRoomID FROM tblroom WHERE intFacilityID = ? AND strRoomNumber = ?";
			if (!dbGetExists($sql, "is", $facilityId, $roomNumber))
			{
				// Record does not exist - add it!
				$sql = "INSERT INTO tblroom VALUES(NULL, ?, ?, ?)";
				$result = dbPush($sql, "isi", $facilityId, $roomNumber, $seats);
				if ($result) echo "Room '".$roomNumber."' added successfully!";
				//else echo $result;
			}
			else
			{
				echo "That room already exists!";
			}
			break;
			
		case "faculty";
			// Fix response data.  Replace empty strings with "null".
			$fName = fixInput($_POST["fName"]);
			$lName = fixInput($_POST["lName"]);
			$mName = fixInput($_POST["mName"]) == "" ? null : fixInput($_POST["mName"]);
			$dept = fixInput($_POST["department"]);
			$pos = fixInput($_POST["pos"]);
			$isAdvisor = fixInput($_POST["isAdv"]) == "1" ? true : false;
			$EID = strtolower($fName.".".$lName);
			$secGroup = $isAdvisor ? 2 : 3;
			
			// Check if record already exists
			$sql = "SELECT intFacultyID FROM tblFaculty WHERE strFirstName = ? AND strLastName = ? AND intDeptID = ?";
			if (!dbGetExists($sql, "ssi", $fName, $lName, $dept))
			{
				// Record does not exist - add it!
				$sql = "INSERT INTO tblFaculty VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)";
				$result = dbPush($sql, "sssisisi", $lName, $fName, $mName, $dept, $pos, $isAdvisor, $EID, $secGroup);
				if ($result) echo "Faculty member '".$fName." ".$lName."' added successfully!";
				//else echo $result;
			}
			else
			{
				echo "That faculty member already exists!";
			}
			break;
			
		case "student";
			// Fix response data.  Replace empty strings with "null".
			$fName = fixInput($_POST["fName"]);
			$lName = fixInput($_POST["lName"]);
			$mName = fixInput($_POST["mName"]) == "" ? null : fixInput($_POST["mName"]);
			$status = fixInput($_POST["status"]);
			$enrStatus = fixInput($_POST["enrStatus"]);
			$sType = fixInput($_POST["sType"]);
			$major1 = fixInput($_POST["major1"]) == "" ? null : fixInput($_POST["major1"]);
			$major2 = fixInput($_POST["major2"]) == "" ? null : fixInput($_POST["major2"]);
			$major3 = fixInput($_POST["major3"]) == "" ? null : fixInput($_POST["major3"]);
			$minor1 = fixInput($_POST["minor1"]) == "" ? null : fixInput($_POST["minor1"]);
			$minor2 = fixInput($_POST["minor2"]) == "" ? null : fixInput($_POST["minor2"]);
			$minor3 = fixInput($_POST["minor3"]) == "" ? null : fixInput($_POST["minor3"]);
			$gpa = fixInput($_POST["gpa"]);
			$credits = fixInput($_POST["credits"]);
			$aService = fixInput($_POST["aService"]) == "1" ? true : false;
			$EID = strtolower($fName.".".$lName);
			
			// Check if record already exists
			$sql = "SELECT intStudentID FROM tblStudent WHERE strFirstName = ? AND strLastName = ?";
			if (!dbGetExists($sql, "ss", $fName, $lName))
			{
				// Record does not exist - add it!
				$sql = "INSERT INTO tblStudent VALUES (NULL, 7654321, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 5)";
				$result = dbPush($sql, "sssssssssssssdii", $fName, $lName, $mName, $EID, $status, $enrStatus, $sType, $major1, $major2, $major3, $minor1, $minor2, $minor3, $gpa, $credits, $aService);
				if ($result) echo "Student '".$fName." ".$lName."' added successfully!";
				//else echo $result;
			}
			else
			{
				echo "That student already exists!";
			}
			break;
			
		case "course";
			// Fix response data.  Replace empty strings with "null".
			$deptCode = fixInput($_POST["dept"]);
			$courseId = $deptCode . fixInput($_POST["courseId"]);
			$courseName = fixInput($_POST["courseName"]);
			$genEdCat = fixInput($_POST["genEdCat"]) == "" ? null : fixInput($_POST["genEdCat"]);
			$preReq = fixInput($_POST["preReq"]) == "" ? null : fixInput($_POST["preReq"]);
			$coReq = fixInput($_POST["coReq"]) == "" ? null : fixInput($_POST["coReq"]);
			$credits = fixInput($_POST["credits"]);
			$fee = fixInput($_POST["fee"]);
			$courseDesc = fixInput($_POST["courseDesc"]) == "" ? null : fixInput($_POST["courseDesc"]);
			
			// Check if record already exists
			$sql = "SELECT strCourseID FROM tblCourse WHERE strCourseID = ?";
			if (!dbGetExists($sql, "s", $courseId))
			{
				// Record does not exist - add it!
				$sql = "INSERT INTO tblCourse VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$result = dbPush($sql, "ssssssids", $courseId, $courseName, $deptCode, $genEdCat, $preReq, $coReq, $credits, $fee, $courseDesc);
				if ($result) echo "Course '".$courseName."' added successfully!";
				//else echo $result;
			}
			else
			{
				echo "That course ID already exists!";
			}
			break;
			
		default:
			// Request type was invalid
			echo "Bad request type";
			break;
	}
}
else
{
	// Request was not POST request
	echo "Bad request method";
}
?>