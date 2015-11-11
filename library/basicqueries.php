<?php
 
 // Server and DB Information
$servername = "134.129.125.206";
$username = "ecanton";
$password = "FishPants2015";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function getEmergencyContactInfo($id) {
	$sql = "SELECT intEmergencyNumber, strEmergencyContactLastName, strEmergencyContactFirstName
		FROM tblUserContact
		WHERE intExternalID = $id";
		$result = $conn->query($sql);
		return $result;
}

function getPermenantContactInfo() {}

function getWeeklySchedule() {}

function getAdvisorWeeklySchedule() {}

function getNotifications() {}

function getCurrentTerm() {}

function getDefaultInstitution() {}

function getCurrentStudentCourseList() {}

function getFacultySectionList() {}

function getSelectedCourseCoordinates() {}

function getAllStudentCoursesDone() {}

function getStudentMajor($id) {
	$sql = "SELECT major1, major2, major3
		FROM Student 
		WHERE StudentID = $id";
	$result = $conn->query($sql);
	return $result;
}

function getStudentMinor($id) {
	$sql = "SELECT minor1, minor2, minor3
		FROM Student 
		WHERE StudentID = $id";
	$result = $conn->query($sql);
	return $result;
}

function getAdviseeRoster() {}

function ValidateUserCredentials() {}

?>
