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
			</form>
			<br />
			<table class="schedule">
				<?php
					if(isset($_GET['search']))
					{
						searchCourses($_GET['searchbar']);
					}
				?>
			</table>
			<br />
			<?php
				//if(isset($_POST['add']))
				//{

				//}
			?>
		</div>
	</body>
</html>
