<?php
if (session_status() == PHP_SESSION_NONE) session_start();
loginHandler();

echo "<table class=\"schedule\">\r\n";
echo "<tr>\r\n<td class=\"thr\">Time</td><td class=\"thr\">Monday</td><td class=\"thr\">Tuesday</td><td class=\"thr\">Wednesday</td><td class=\"thr\">Thursday</td><td class=\"thr\">Friday</td>\r\n</tr>";

// Fetch class data
$eid = $_SESSION['cruser'];
$sql = "SELECT sec.strCourseID AS id, sch.strDayFormat AS timeSlot, tim.timStartTime AS timeStart, tim.timEndTime AS timeEnd
		FROM tblSection sec
		JOIN tblSectionSchedule sch ON sch.intDaySlotID = sec.intScheduleID
		JOIN tblSectionTimes tim ON tim.intTimeSlotID = sec.intTimeSlotID
		JOIN tblStudentEnrollment enr ON sec.intSectionID = enr.intSectionID
		JOIN tblStudent stu ON stu.intStudentID = enr.intStudentID
		WHERE stu.strStudentEID = ?";
$newSchedule = dbGetAll($sql, 's', $eid);

$times = array('8:00am','9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm','3:00pm','4:00pm','5:00pm','6:00pm','7:00pm','8:00pm');

// Create the table
for ($y = 0; $y < 13; $y++)
{
	$theTime = $y + 8; // The hour of the current loop iteration
	echo "<tr>\r\n<td class=\"tws\">" . $times[$y] . "</td>";
	
	for ($x = 0; $x < 5; $x++)
	{
		// Get day of the week for the current loop iteration
		$day;
		switch ($x) {
			case 0:
				$day = 'M';
				break;
			case 1:
				$day = 'T';
				break;
			case 2:
				$day = 'W';
				break;
			case 3:
				$day = 'H';
				break;
			case 4:
				$day = 'F';
				break;
		}
		$found = false; // Flag for if a class is found this hour
		
		// Loop over the data rows
		for ($w = 0; $w < count($newSchedule); $w++)
		{
			$days = $newSchedule[$w]['timeSlot'];
			$startTime = intval(substr($newSchedule[$w]['timeStart'], 0, 2), 10); // Only get the hour
			$endTime = intval(substr($newSchedule[$w]['timeEnd'], 0, 2), 10); // Only get the hour
			
			// Early break loop if a multi-hour class overflows into this hour
			if (strpos($days, $day) !== FALSE && $theTime > $startTime && $theTime <= $endTime) 
			{
				$found = true;
				break;
			}
			// If the day and start time match
			if (strpos($days, $day) !== FALSE && $startTime == $theTime)
			{
				// Check if class is multi-hour
				$i = 0;
				while ($endTime >= $theTime + $i) {$i++;}
				if ($i > 0)
				{
					// Class is multi-hour
					echo "<td class=\"fws\" rowspan=\"".$i."\">" . $newSchedule[$w]['id'] . "</td>";
				}
				else
				{
					// Class is one hour
					echo "<td class=\"fws\">" . $newSchedule[$w]['id'] . "</td>";
				}
				$found = true;
				break;
			}
		}
		if (!$found)
		{
			// No class found this hour.  Fill cell with alternating colors.
			if (($y % 2) == 0)
			{
				echo "<td class=\"ews\"></td>"; 
			}
			else
			{
				echo "<td class=\"aews\"></td>";
			}
		}
	}
	
	echo "\r\n</tr>";
}

echo "</table>\r\n";
?>