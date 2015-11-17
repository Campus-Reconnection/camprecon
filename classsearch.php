<!DOCTYPE html>
<html>
	<head>
	<title>Campus Reconnection</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
	<div id="pagediv">
		<?php include("includes/menustrip.php"); ?>
		<span class="title">Class Search</span>
		<br />
		<select name = "department">
			<?php
				require("library/classqueries.php");
				$result = getAllDepartments();
				while ($row = mysql_fetch_array($result) {
					<option value="dep1"> echo $row['strDeparment']; </option>
				}
			?>
		</select>
		<p>Class Number
			<input type="text" name="classnumber" size="15" maxlength="30" />
		</p>
		</div>
		<div id='overlay'></div>
		<p>
			<input type="submit" name="search" value="Search" />
		</p>
		<table id = "SearchResults">
			<thead class="SearchHead">
				<tr>
					<td>CourseName</td>
					<td>Section Number</td>
					<td>Time</td>
					<td></td>
					<td>Days</td>
					<td>Dates</td>
					<td></td>
					<td>Instructor</td>
					<td>Location</td>
					<td></td>
				</tr>
		<?php
			require("library/getClassSearch.php");
			if(isset($_POST['search']))
			{
				$classnumber=$_POST['classnumber'];
				$department=$_POST['department'];
				searchCourseID($department, $classnumber);
			}
			else
			{
				echo "<p>Enter a valid search</p>";
			}
		?>

	</div>
</body>
</html>
