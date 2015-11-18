<?php
require("library/system.php");
/*
session_start();
if (!(isset($_SESSION['crlogin']) && $_SESSION['crlogin'] != '')) {
	header ("Location: login.php");
	exit();
}

$eId = $_SESSION['cruser'];
*/

$eId = 'girl.nobody';
$sql = "SELECT sec.strCourseID AS id, sch.strDayFormat AS timeSlot, tim.timStartTime AS timeStart, tim.timEndTime AS timeEnd
		FROM tblSection sec
		JOIN tblSectionSchedule sch ON sch.intDaySlotID = sec.intScheduleID
		JOIN tblSectionTimes tim ON tim.intTimeSlotID = sec.intTimeSlotID
		JOIN tblStudentEnrollment enr ON sec.intSectionID = enr.intSectionID
		JOIN tblStudent stu ON stu.intStudentID = enr.intStudentID
		WHERE stu.strStudentEID = '".$eId."'";

$result = queryDB($sql);
$newSchedule = mysqli_fetch_all($result, MYSQLI_BOTH);




echo "<table class=\"schedule\">\r\n";
echo "<tr>\r\n<td class=\"thr\">Time</td><td class=\"thr\">Monday</td><td class=\"thr\">Tuesday</td><td class=\"thr\">Wednesday</td><td class=\"thr\">Thursday</td><td class=\"thr\">Friday</td>\r\n</tr>";

$times = array('8:00am','9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm','3:00pm','4:00pm','5:00pm','6:00pm','7:00pm','8:00pm');

/*
$schedule = array(
	array("","","","",""), //8am
	array("","","","",""), //9am
	array("PHYS211","","PHYS211","","PHYS211"), //10am
	array("","CSCI413","","CSCI413",""), //11am
	array("","0","","0",""), //12pm
	array("","","","",""), //1pm
	array("CSCI213","STAT367","CSCI213","STAT367","CSCI213"), //2pm
	array("","0","","0",""), //3pm
	array("CSCI222","","CSCI222","",""), //4pm
	array("0","","0","",""), //5pm
	array("","","","",""), //6pm
	array("","","","",""), //7pm
	array("","","","","") //8pm
);
*/

for ($y = 0; $y < 13; $y++)
{
	$theTime = $y + 8;
	echo "<tr>\r\n<td class=\"tws\">" . $times[$y] . "</td>";
	
	for ($x = 0; $x < 5; $x++)
	{
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
		$found = false;
		for ($w = 0; $w < mysqli_num_rows($result); $w++)
		{
			$days = $newSchedule[$w]['timeSlot'];
			$startTime = intval(substr($newSchedule[$w]['timeStart'], 0, 2), 10);
			$endTime = intval(substr($newSchedule[$w]['timeEnd'], 0, 2), 10);
			
			if (strpos($days, $day) !== FALSE && $theTime > $startTime && $theTime <= $endTime) 
			{
				$found = true;
				break;
			}
			if (strpos($days, $day) !== FALSE && $startTime == $theTime)
			{
				$found = true;
				$i = 0;
				while ($endTime >= $theTime + $i) {$i++;}
				if ($i > 0) //If there is cell overlap.
				{
					echo "<td class=\"fws\" rowspan=\"".$i."\">" . $newSchedule[$w]['id'] . "</td>";
				}
				else //If there is no cell overlap.
				{
					echo "<td class=\"fws\">" . $newSchedule[$w]['id'] . "</td>";
				}
			}
			if ($found) break;
		}
		if (!$found) //Cell is empty
		{
			if (($y % 2) == 0) //Alternate color on empty cells in rows.
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