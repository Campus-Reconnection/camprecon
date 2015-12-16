<?php
session_start(); 
require("library/system.php"); 
require("library/getClassSearch.php");
loginHandler();
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
			<span class="title">Class Search</span>
			<br />
			<form method="GET" action="classsearch.php">
				<?php
					if (isset($_GET["searchbar"]))
					{
						echo "<input type=\"text\" name=\"searchbar\" value=\"" . $_GET["searchbar"] . "\" size=\"64\" />";
					}
					else
					{
						echo "<input type=\"text\" name=\"searchbar\" value=\"\" size=\"64\" />";
					}
				?>
				<input type="submit" name="search" value="Search" />
				<br />
					<?php
						if(isset($_GET['search']))
						{
							echo "<br /><table class=\"schedule\">";
							searchCourses($_GET['searchbar']);
							echo "</table>";
							echo "<br /><input type=\"submit\" name=\"add\" value=\"Add\" />";
						}
					?>
				<br />
				<?php
					if(isset($_GET['add']))
					{
						$classesadded = 0;
						$sql = "SELECT intStudentID FROM tblStudent WHERE strStudentEID = ?;";
						$studenteid = dbGetFirst($sql, "s", $_SESSION["cruser"])[0];
						
						foreach($_GET['check'] as $key=>$value)
						{
							if (addCourse($studenteid, $value))
							{
								$classesadded = $classesadded + 1;
							}
						}
						
						if ($classesadded > 0)
						{
							echo "<table class=\"schedule\"><tr><td class=\"advcell\">You have successfully enrolled in " . $classesadded . " classes.</td></tr>";
						}
						else
						{
							echo "<table class=\"schedule\"><tr><td class=\"advcell\">No classes have been enrolled.</td></tr>";
						}
					}
				?>
			</form>
		</div>
	</body>
</html>
