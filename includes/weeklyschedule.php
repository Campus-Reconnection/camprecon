<?php
echo "<table class=\"schedule\">\r\n";
echo "<tr>\r\n<th>Time</th><th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th>\r\n</tr>";

//Print 8am to 11am.
for ($i = 8; $i < 12; $i++)
{
	echo "<tr>\r\n<td class=\"ws\">" . $i . ":00am</td><td class=\"ws\" rowspan=\"2\"></td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td>\r\n</tr>";
}

//Print 12:00pm.
echo "<tr>\r\n<td class=\"ws\">12:00pm</td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td>\r\n</tr>";

//Print 1:00pm to 7pm.
for ($i = 1; $i < 8; $i++)
{
	echo "<tr>\r\n<td class=\"ws\">" . $i . ":00pm</td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td><td class=\"ws\"></td>\r\n</tr>";
}

echo "</table>\r\n";
?>