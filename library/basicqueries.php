<?php

function getStudentID($eid)
{
	$sql = "SELECT intStudentID AS id FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
		return sprintf('%08d', $result[0]);
	return false;
}

function getStudentFullName($eid)
{
	$sql = "SELECT strFirstName AS fName, strMiddleName AS mName, strLastName AS lName FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
	{
		if ($result['mName'] != "")
			return $result['fName']." ".$result['mName']." ".$result['lName'];
		return $result['fName']." ".$result['lName'];
	}
	return false;
}

function getStudentDateOfBirth($eid)
{
	$sql = "SELECT dtmDateOfBirth FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
		return $result[0];
	return false;
}

function getStudentStatus($eid)
{
	$sql = "SELECT strStatus FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
	{
		switch ($result[0])
		{
			case "act": return "Active";
			case "sus": return "Suspended";
		}
	}
	return false;
}

function getStudentEnrollment($eid)
{
	$sql = "SELECT strEnrollmentStatus FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
	{
		switch ($result[0])
		{
			case "Fulltime": return "Full Time";
			case "Parttime": return "Part Time";
		}
	}
	return false;
}

function getStudentType($eid)
{
	$sql = "SELECT strStudentType FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
	{
		switch ($result[0])
		{
			case "und": return "Undergraduate";
			case "grd": return "Graduate";
			case "phd": return "Ph. D";
			case "crt": return "Certificate";
		}
	}
	return false;
}

function getActiveService($eid)
{
	$sql = "SELECT blnActiveService FROM tblStudent WHERE strStudentEID = ?";
	if ($result = dbGetFirst($sql, "s", $eid))
		return true;
	return false;
}

function getEmergencyContacts($eid)
{
	$sql = "SELECT intContactID AS id,
			strEmergencyContactFirstName AS firstName,
			strEmergencyContactLastName AS lastName,
			strEmergencyContactType AS relation,
			strStreet AS street,
			strCity AS city,
			strState AS state,
			strCountry AS country,
			strPostCode AS postCode,
			strMobileNumber AS mobileNumber,
			strHomeNumber AS homeNumber
		FROM tblUserContact
		WHERE strExternalEID = ? AND blnEmergencyContact = 1";
	if ($result = dbGetAll($sql, "s", $eid))
		return $result;
	return false;
}

function getPermanentContactInfo($eid) {
	$sql = "SELECT intContactID AS id,
			strStreet AS street,
			strCity AS city,
			strState AS state,
			strCountry AS country,
			strPostCode AS postCode,
			strMobileNumber AS mobileNumber,
			strHomeNumber AS homeNumber,
			strEmail AS email
		FROM tblUserContact
		WHERE strExternalEID = ? AND blnEmergencyContact = 0 AND blnPermanent = 1";
	if ($result = dbGetFirst($sql, "s", $eid))
		return $result;
	return false;
}

function getSchoolContactInfo($eid) {
	$sql = "SELECT intContactID AS id,
			strStreet AS street,
			strCity AS city,
			strState AS state,
			strCountry AS country,
			strPostCode AS postCode,
			strMobileNumber AS mobileNumber,
			strHomeNumber AS homeNumber,
			strEmail AS email
		FROM tblUserContact
		WHERE strExternalEID = ? AND blnEmergencyContact = 0 AND blnPermanent = 0";
	if ($result = dbGetFirst($sql, "s", $eid))
		return $result;
	return false;
}

function getWeeklySchedule() {}

function getAdvisorWeeklySchedule() {}

function getNotifications() {}

function getCurrentTerm() {}

function getDefaultInstitution() {}

function getCurrentStudentCourseList() {}

function getFacultySectionList() {}

function getSelectedCourseCoordinates() {}

function getAllStudentCoursesDone() {}

function getStudentMajors($eid)
{
	$sql = "SELECT strMajor1, strMajor2, strMajor3 FROM tblstudent WHERE strStudentEID = ?";
	if ($result = dbGetAll($sql, "s", $eid))
		return $result;
	return false;
}

function getStudentMinors($eid)
{
	$sql = "SELECT strMinor1, strMinor2, strMinor3 FROM tblstudent WHERE strStudentEID = ?";
	if ($result = dbGetAll($sql, "s", $eid))
		return $result;
	return false;
}

function getAdviseeRoster() {}

function ValidateUserCredentials() {}

?>
