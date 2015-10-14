<?php
echo "<table class=\"schedule\">\r\n";
echo "<tr>\r\n<th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th>\r\n</tr>";

$times = array('8:00am','9:00am','10:00am','11:00am','12:00pm','1:00pm','2:00pm','3:00pm','4:00pm','5:00pm','6:00pm','7:00pm','8:00pm');

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

for ($y = 0; $y < 13; $y++)
{
	echo "<tr>\r\n<td class=\"tws\">" . $times[$y] . "</td>";
	
	for ($x = 0; $x < 5; $x++)
	{
		if ($schedule[$y][$x] == "") //Cell is empty.
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
		elseif ($schedule[$y][$x] == "0") //Cell is overlapped.
		{
			//Be a freeloader. Do nothing.
		}
		else //Cell has data.
		{
			if ($schedule[$y+1][$x] == "0") //If there is cell overlap.
			{
				echo "<td class=\"fws\" rowspan=\"2\">" . $schedule[$y][$x] . "</td>";
			}
			else //If there is no cell overlap.
			{
				echo "<td class=\"fws\">" . $schedule[$y][$x] . "</td>";
			}
		}
	}
	
	echo "\r\n</tr>";
}

echo "</table>\r\n";
?>