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
require("library/system.php");

//With this it won't log us out when traversing through pages.
if (!isset($_SESSION["crlogin"]))
{
	$_SESSION["crlogin"] = false;
}

$error  = ""; //This string is displayed to the user upon fuck ups. 

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["crlogin"] == false)
{
	$username = strtolower(fixInput($_POST["username"]));
	$password = fixInput($_POST["password"]);
	
	$row = dbGetFirst("SELECT * FROM tbluser WHERE strEID = ?", "s", $username);
	if ($password != "" && $password == $row[2])
	{
		$_SESSION["crlogin"] = true;
		$_SESSION["cruser"] = $username;
		
		$row = dbGetFirst("SELECT strFirstName, strLastName FROM tblStudent WHERE strStudentEID = ?", "s", $username);
		$_SESSION["crname"] = $row[0]." ".$row[1];
		
		$row = dbGetFirst("SELECT vntImage FROM tblPictureID WHERE strOwner = ?", "s", $username);
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
	exit();
}
else
{
	echo "<div style=\"width:304px; border:1px solid #2f2f2f; background-color:#e7e7e7; margin:auto; position:relative; height:112px; top:64px; padding:16px; box-shadow:0px 0px 24px #4f4f4f;\">";
	echo "<span class=\"title\">Login:</span>";
	echo "<form method=\"post\" action=\"" . htmlspecialchars($_SERVER["PHP_SELF"]) . "\"><table>\r\n";
	echo "<tr><td>Username:</td><td><input type=\"text\" name=\"username\" size=\"32\"></td></tr>\r\n";
	echo "<tr><td>Password:</td><td><input type=\"password\" name=\"password\" size=\"32\"></td></tr>\r\n";
	echo "<tr><td></td><td><input type=\"submit\" value=\"Login\" /></td></tr>\r\n";
	echo "</table></form><br /><br />\r\n";
	echo "<span style=\"font-size:12px; color:#af0000;\">" . $error . "</span>";
	echo "</div>";
}

?>
</div>
</body>
</html>