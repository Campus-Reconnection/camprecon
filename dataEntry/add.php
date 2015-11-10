<?php
require('../library/system.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$type = $_POST['type'];
	
	if ($type == 'room')
	{
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
	}
	else { echo 'Bad request type'; }
	
}
else { echo 'Bad request method'; }
?>