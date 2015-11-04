<?php
 
$servername = "localhost";
$username = "root";
$password = "camprecon";
$dbname = "camprecon";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

function getEmergencyContactInfo() {}

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

function getStudentMajor($conn, $id) {
	$sql = "SELECT major1, major2, major3
		FROM Student 
		WHERE StudentID = $id";
	$result = $conn->query($sql);
	return $result;
}

function getStudentMinor($conn, $id) {
	$sql = "SELECT minor1, minor2, minor3
		FROM Student 
		WHERE StudentID = $id";
	$result = $conn->query($sql);
	return $result;
}

function getAdviseeRoster() {}

function ValidateUserCredentials() {}

?>
