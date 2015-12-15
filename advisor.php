<?php 
session_start();
require("library/system.php");
loginHandler();

function loadadvisors()
{
	$conn = openDB();
	$sql = "SELECT CONCAT(fac.strFirstName,' ',fac.strLastName) AS \"strAdvisor\",
			fac.strPhone AS \"strAdvPhone\",
			fac.strFacultyEID AS \"strFEID\",
			dep.strDeptName AS \"strDept\"
			FROM tblstudent stu
			JOIN tblfaculty fac ON stu.intFacultyID = fac.intFacultyID
			JOIN tbldepartment dep ON fac.intDeptID = dep.intDeptID
			WHERE strStudentEID = '" . $_SESSION["cruser"] . "';";
			
	$result = queryDB($sql);
	$row = mysqli_fetch_assoc($result);

	echo "<td class=\"advcell\">" . $row["strAdvisor"] . "</td>\r\n";
	echo "<td class=\"advcell\">" . preg_replace("/(\\d{3})(\\d{3})(\\d{4})/","(\\1) \\2-\\3",$row["strAdvPhone"]) . "</td>\r\n";
	echo "<td class=\"advcell\">" . $row["strFEID"] . "@ndsu.edu</td>\r\n";
	echo "<td class=\"advcell\">" . $row["strDept"] . "</td>\r\n";
	closeDB($conn);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" type="image/ico" href="images/favicon.ico" />
</head>
<body>
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Academic Advisor Information:</span>
<br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Name</td>
<td class="thr">Phone</td>
<td class="thr">Email</td>
<td class="thr">Program</td>
</tr>
<tr>
<?php loadadvisors(); ?>
</tr>
</table>
</div>
</div>
</body>
</html>