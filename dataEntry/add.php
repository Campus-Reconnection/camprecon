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
			$mysqli = getMysqli();
			$query1 = $mysqli->prepare("SELECT intRoomID FROM tblroom WHERE intFacilityID = ? AND strRoomNumber = ?");
			$query1->bind_param("is", $facilityId, $roomNumber);
			if ($query1->execute() && !($query1->get_result()->fetch_array()))
			{
				// Record does not exist - add it!
				$query2 = $mysqli->prepare("INSERT INTO tblroom VALUES(NULL, ?, ?, ?)");
				$query2->bind_param("isi", $facilityId, $roomNumber, $seats);
				if ($query2->execute()) {echo "Room '".$roomNumber."' added successfully!"; }
				else { printf("errno: %d, error: %s", $mysqli->errno, $mysqli->error); }
				// Close prepared query
				$query2->close();
			}
			else
			{
				echo "That room already exists!";
			}
			// Close connections
			$query1->close();
			$mysqli->close();
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
			$mysqli = getMysqli();
			$query1 = $mysqli->prepare("SELECT intFacultyID FROM tblFaculty WHERE strFirstName = ? AND strLastName = ? AND intDeptID = ?");
			$query1->bind_param("ssi", $fName, $lName, $dept);
			if ($query1->execute() && !($query1->get_result()->fetch_array()))
			{
				// Record does not exist - add it!
				$query2 = $mysqli->prepare("INSERT INTO tblFaculty VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
				$query2->bind_param("sssisisi", $lName, $fName, $mName, $dept, $pos, $isAdvisor, $EID, $secGroup);
				if ($query2->execute()) { echo "Faculty member '".$fName." ".$lName."' added successfully!"; }
				else { printf("errno: %d, error: %s", $mysqli->errno, $mysqli->error); }
				// Close prepared query
				$query2->close();
			}
			else
			{
				echo "That faculty member already exists!";
			}
			// Close connections
			$query1->close();
			$mysqli->close();
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
			$mysqli = getMysqli();
			$query1 = $mysqli->prepare("SELECT intStudentID FROM tblStudent WHERE strFirstName = ? AND strLastName = ?");
			$query1->bind_param("ss", $fName, $lName);
			if ($query1->execute() && !($query1->get_result()->fetch_array()))
			{
				// Record does not exist - add it!
				$query2 = $mysqli->prepare("INSERT INTO tblStudent VALUES (NULL, 7654321, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 5)");
				$query2->bind_param("sssssssssssssdii", $fName, $lName, $mName, $EID, $status, $enrStatus, $sType, $major1, $major2, $major3, $minor1, $minor2, $minor3, $gpa, $credits, $aService);
				if ($query2->execute()) { echo "Student '".$fName." ".$lName."' added successfully!"; }
				else { printf("errno: %d, error: %s", $mysqli->errno, $mysqli->error); }
				// Close prepared query
				$query2->close();
			}
			else
			{
				echo "That student already exists!";
			}
			// Close connections
			$query1->close();
			$mysqli->close();
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
			$mysqli = getMysqli();
			$query1 = $mysqli->prepare("SELECT strCourseID FROM tblCourse WHERE strCourseID = ?");
			$query1->bind_param("s", $courseId);
			if ($query1->execute() && !($query1->get_result()->fetch_array()))
			{
				// Record does not exist - add it!
				$query2 = $mysqli->prepare("INSERT INTO tblCourse VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$query2->bind_param("ssssssids", $courseId, $courseName, $deptCode, $genEdCat, $preReq, $coReq, $credits, $fee, $courseDesc);
				if ($query2->execute()) { echo "Course '".$courseName."' added successfully!"; }
				else { printf("errno: %d, error: %s", $mysqli->errno, $mysqli->error); }
				// Close prepared query
				$query2->close();
			}
			else
			{
				echo "That course ID already exists!";
			}
			// Close connections
			$query1->close();
			$mysqli->close();
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