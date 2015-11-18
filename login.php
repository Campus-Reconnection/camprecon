<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php
require("includes/menustrip.php"); 
require("library/system.php");

//With this it won't log us out when traversing through pages.
if (!isset($_SESSION["crlogin"]))
{
	$_SESSION["crlogin"] = false;
}

echo "<span class=\"title\">Login:</span>";

$conn = openDB();
$error  = ""; //This string is displayed to the user upon fuck ups. 

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["crlogin"] == false)
{
	$username = strtolower(fixInput($_POST["username"]));
	$password = fixInput($_POST["password"]);
	
	$result = mysqli_query($conn,"SELECT * FROM tbluser WHERE strEID = '$username'");
	$row = mysqli_fetch_row($result);
	if ($password == $row[2] && $password != "")
	{
		$_SESSION["crlogin"] = true;
		$_SESSION["cruser"] = $username;
		
		$result = mysqli_query($conn,"SELECT strFirstName, strLastName FROM tblStudent WHERE strStudentEID = '$username'");
		$row = mysqli_fetch_row($result);
		$_SESSION["crname"] = $row[0]." ".$row[1];
		
		$result = mysqli_query($conn,"SELECT vntImage FROM tblPictureID WHERE strOwner = '$username' AND blnIsThumb = 1");
		$row = mysqli_fetch_row($result);
		$_SESSION["crphototb"] = $row[0].".jpg";
	}
	else
	{
		$_SESSION["crlogin"] = false;
		$error = "*Incorrect user and password combination!";
	}
}

if ($_SESSION["crlogin"] == true)
{
	header("Location:/index.php");
}
else
{
	echo "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\"><table>\r\n";
	echo "<tr><td>Username:</td><td><input type=\"text\" name=\"username\"></td></tr>\r\n";
	echo "<tr><td>Password:</td><td><input type=\"password\" name=\"password\"></td></tr>\r\n";
	echo "<tr><td></td><td><input type=\"submit\" value=\"Login\" /></td></tr>\r\n";
	echo "</table></form><br>\r\n";
	echo "<span style=\"font-size:12px; color:#7f0000;\">" . $error . "</span>";
}

closeDB($conn);
?>
</div>
</body>
</html>