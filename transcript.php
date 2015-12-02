<?php
    if (session_status() == PHP_SESSION_NONE) session_start();
	require_once("library/system.php");
	loginHandler();
	
	function fillSelect() {
		$eid = $_SESSION['cruser'];
		$sql = "SELECT DISTINCT sec.intYear as iYear, sec.strSeason as sSeason
				FROM tblSection sec
				JOIN tblStudentEnrollment enr ON sec.intSectionID = enr.intSectionID
				JOIN tblStudent stu ON stu.intStudentID = enr.intStudentID
				WHERE stu.strStudentEID = ?
				ORDER BY iYear";
				
		if ($result = dbGetAll($sql, "s", $eid))
		{
			$i = 0;
			foreach ($result as $row)
			{
				echo '<option value="' . $i . '">' . $row['sSeason'] . ' ' . $row['iYear'] . '</option>';
				$i++;
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Campus Reconnection</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="javascript/jquery-2.1.4.min.js"></script>
  <script src="javascript/transcript.js"></script>
</head>
<body>
  <?php include("includes/loginfo.php"); ?>
  <a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
  <div id="pagediv">
	<?php include("includes/menustrip.php"); ?>
	<span class="title">Transcript</span>
	<br />
	Semester:
	<select id="selectSemester" onchange="semesterSelected(this.value)">
	<?php fillSelect() ?>
	</select>
	<br />
	<br />
	<div class="shadow-container">
	  <table id="transcriptA">
		<thead class="transcriptTableHead">
		  <tr>
		  <td class="thr">Course</td>
		  <td class="thr">Description</td>
		  <td class="thr">Attempted</td>
		  <td class="thr">Earned</td>
		  <td class="thr">Grade</td>
		  <td class="thr">Points</td>
		</thead>
	    <tbody>
	    </tbody>
	  </table>
	</div>
	<br />
	<div class="shadow-container">
	  <table id="transcriptB">
		<thead>
		  <tr>
			<td class="thr"></td>
			<td class="thr"></td>
			<td class="thr"></td>
			<td class="thr">Attempted</td>
			<td class="thr">Earned</td>
			<td class="thr">GPA Units</td>
			<td class="thr">Points</td>
		  </tr>
		</thead>
		<tbody>
		  <tr>
			<td class="advcell">Term GPA:</td>
			<td id="termGpa" class="advcell"></td>
			<td class="advcell">Term Totals:</td>
			<td id="termAttempted" class="advcell"></td>
			<td id="termEarned" class="advcell"></td>
			<td id="termGpaUnits" class="advcell"></td>
			<td id="termPoints" class="advcell"></td>
		  </tr>
		  <tr>
			<td class="advcell">Cum GPA:</td>
			<td id="cumlGpa" class="advcell"></td>
			<td class="advcell">Cum Totals:</td>
			<td id="cumlAttempted" class="advcell"></td>
			<td id="cumlEarned" class="advcell"></td>
			<td id="cumlGpaUnits" class="advcell"></td>
			<td id="cumlPoints" class="advcell"></td>
		  </tr>
		</tbody>
	  </table>
	</div>
	<div id='overlay'></div>
  </div>
</body>
</html>