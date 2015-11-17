<?php
require('../library/system.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$type = $_POST['type'];
	
	switch ($type) {
		case 'room':
			$facilityId = $_POST['facilityId'];
			$roomNumber = $_POST['roomNumber'];
			$seats = $_POST['seats'];
			
			$sql = "SELECT intRoomID FROM tblroom WHERE intFacilityID = '" . $facilityId . "', strRoomNumber = '" . $roomNumber . "'";
			$result = queryDB($sql);
			if (!$result)
			{
				$sql = 'INSERT INTO tblroom VALUES(NULL,' . $facilityId . ',' . $roomNumber . ',' . $seats . ');';
				queryDB($sql);
				echo 'Room added successfully!';
			}
			else { echo "That room already exists!"; }
			break;
		case 'faculty';
			$fName = $_POST['fName'];
			$lName = $_POST['lName'];
			$mName = $_POST['mName'];
			$dept = $_POST['department'];
			$pos = $_POST['pos'];
			$isAdvisor = false;
			if ($_POST['isAdv'] == '1') {$isAdvisor = true;}
			$EID = strtolower($fName.".".$lName);
			$secGroup = 3;
			if ($isAdvisor) {$secGroup = 2;}
			if ($mName == "") {$mName = null;}
			
			$sql = "SELECT intFacultyID FROM tblFaculty WHERE strFirstName = '" . $fName . "' AND strLastName = '" . $lName . "' AND intDeptID = " . $dept;
			$result = queryDB($sql);
			if (!mysqli_fetch_row($result))
			{
				$conn = openDB();
				$stmt = mysqli_prepare($conn, "INSERT INTO tblFaculty VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
				mysqli_stmt_bind_param($stmt, 'sssisisi', $lName, $fName, $mName, $dept, $pos, $isAdvisor, $EID, $secGroup);
				mysqli_stmt_execute($stmt);
				closeDB($conn);
				
				echo 'Faculty member added successfully!';
			}
			else { echo "That faculty member already exists!"; }
			break;
		case 'student';
			$fName = $_POST['fName'];
			$lName = $_POST['lName'];
			$mName = ($_POST['mName'] == "" ? null : $_POST['mName']);
			$status = $_POST['status'];
			$enrStatus = $_POST['enrStatus'];
			$sType = $_POST['sType'];
			$major1 = ($_POST['major1'] == "" ? null : $_POST['major1']);
			$major2 = ($_POST['major2'] == "" ? null : $_POST['major2']);
			$major3 = ($_POST['major3'] == "" ? null : $_POST['major3']);
			$minor1 = ($_POST['minor1'] == "" ? null : $_POST['minor1']);
			$minor2 = ($_POST['minor2'] == "" ? null : $_POST['minor2']);
			$minor3 = ($_POST['minor3'] == "" ? null : $_POST['minor3']);
			$gpa = $_POST['gpa'];
			$credits = $_POST['credits'];
			$aService = ($_POST['aService'] == "1" ? true : false);
			$EID = strtolower($fName.".".$lName);
			
			$sql = "SELECT intStudentID FROM tblStudent WHERE strFirstName = '" . $fName . "' AND strLastName = '" . $lName . "'";
			if (!mysqli_fetch_row(queryDB($sql)))
			{
				$mysqli = new mysqli("localhost", "root", "camprecon", "camprecon");
				$sql = "INSERT INTO tblStudent VALUES (NULL, 7654321, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 5)";
				$stmt = $mysqli->prepare($sql);
				if ($stmt) {
					$stmt->bind_param('sssssssssssssdii', $fName, $lName, $mName, $EID, $status, $enrStatus, $sType, $major1, $major2, $major3, $minor1, $minor2, $minor3, $gpa, $credits, $aService);
					$stmt->execute();
					$stmt->close();
					echo 'Student "'.$fName.' '.$lName.'" added successfully!';
				}
				else {printf('errno: %d, error: %s', $mysqli->errno, $mysqli->error);}

				$mysqli->close();
			}
			else { echo "That student name already exists!"; }
			break;
		case 'course';
			$deptCode = $_POST['dept'];
			$courseId = $deptCode . $_POST['courseId'];
			$courseName = $_POST['courseName'];
			$genEdCat = ($_POST['genEdCat'] == "" ? null : $_POST['genEdCat']);
			$preReq = ($_POST['preReq'] == "" ? null : $_POST['preReq']);
			$coReq = ($_POST['coReq'] == "" ? null : $_POST['coReq']);
			$credits = $_POST['credits'];
			$fee = $_POST['fee'];
			$courseDesc = ($_POST['courseDesc'] == "" ? null : $_POST['courseDesc']);
			
			$sql = "SELECT strCourseID FROM tblCourse WHERE strCourseID = '" . $courseId . "'";
			if (!mysqli_fetch_row(queryDB($sql)))
			{
				$mysqli = new mysqli("localhost", "root", "camprecon", "camprecon");
				$sql = "INSERT INTO tblCourse VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$stmt = $mysqli->prepare($sql);
				if ($stmt) {
					$stmt->bind_param('ssssssids', $courseId, $courseName, $deptCode, $genEdCat, $preReq, $coReq, $credits, $fee, $courseDesc);
					$stmt->execute();
					$stmt->close();
					echo 'Course "'.$courseName.'" added successfully!';
				}
				else {printf('errno: %d, error: %s', $mysqli->errno, $mysqli->error);}

				$mysqli->close();
			}
			else { echo "That course ID already exists!"; }
			break;
		default:
			echo 'Bad request type';
			break;
	}
}
else { echo 'Bad request method'; }
?>