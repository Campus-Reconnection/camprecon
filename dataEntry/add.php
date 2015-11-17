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
				
				echo 'Faculty member added successfully!';
			}
			else { echo "That faculty member already exists!"; }
			break;
		default:
			echo 'Bad request type';
			break;
	}
	
}
else { echo 'Bad request method'; }
?>