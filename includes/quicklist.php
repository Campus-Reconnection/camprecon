<?php

$conn = openDB();

echo "<table id=\"quicklist\">\r\n";
echo "<tr><td>&nbsp;ACCOUNT HOLD:</td><td>Financial Obligation Agreement</td></tr>\r\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\r\n";

$sql = "SELECT dblDues FROM tblstudent WHERE strStudentEID = '" . $_SESSION["cruser"] . "';";
$result = queryDB($sql);
$row = mysqli_fetch_assoc($result);

echo "<tr><td>&nbsp;Future Due:</td><td>$" . $row["dblDues"] . " <span class=\"text-attn\">(Pay your bills deadbeat!)</span></td></tr>\r\n";

$sql = "SELECT CONCAT(fac.strFirstName,' ',fac.strLastName) AS \"strAdvisor\", fac.strPhone AS \"strAdvPhone\"
		FROM tblstudent stu
		JOIN tblfaculty fac ON stu.intFacultyID = fac.intFacultyID
		WHERE strStudentEID = '" . $_SESSION["cruser"] . "';";
$result = queryDB($sql);
$row = mysqli_fetch_assoc($result);

echo "<tr><td>&nbsp;Advisor:</td><td>" . $row["strAdvisor"] . " -- " . preg_replace("/(\\d{3})(\\d{3})(\\d{4})/","(\\1) \\2-\\3",$row["strAdvPhone"]) . "</td></tr>\r\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\r\n";

$sql = "SELECT strStreet, CONCAT(strCity,', ',strState,' ',strPostCode) AS \"strUserAddress\", strMobileNumber, strEmail
		FROM tblusercontact WHERE blnPermanent = true AND strExternalEID = '" . $_SESSION["cruser"] . "';";
$result = queryDB($sql);
$row = mysqli_fetch_assoc($result);

echo "<tr><td>&nbsp;Contact Info:</td><td>&nbsp;</td></tr>\r\n";
echo "<tr><td>&nbsp;&nbsp;-Address:</td><td>" . preg_replace("/\\d{3,4}\\s/", "*** ",$row["strStreet"]) . "</td></tr>\r\n";
echo "<tr><td>&nbsp;&nbsp;-City:</td><td>" . $row["strUserAddress"] . "</td></tr>\r\n";
echo "<tr><td>&nbsp;&nbsp;-Phone:</td><td>" . preg_replace("/(\\d).(\\d)(\\d).(\\d)(\\d)..(\\d)/","(\\1*\\2)\\3*\\4-\\5**\\6",$row["strMobileNumber"]) . "</td></tr>\r\n";
echo "<tr><td>&nbsp;&nbsp;-Email:</td><td>" . preg_replace("/([A-Za-z])\\w+(.)@/", "\\1*\\2@", $row["strEmail"]) . "</td></tr>\r\n";
echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
echo "<tr><td>&nbsp;Outages:</td><td>None planned at the moment.</td></tr>";
echo "</table>";

closeDB($conn);

?>