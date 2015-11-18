<?php
	require("library/system.php");
	
	function fillSelect() {
		$sql = "SELECT DISTINCT sec.intYear as iYear, sec.strSeason as sSeason
				FROM tblSection sec
				JOIN tblStudentEnrollment enr ON sec.intSectionID = enr.intSectionID
				WHERE enr.intStudentID = 0
				ORDER BY iYear;";
		$result = queryDB($sql);
	
		if (mysqli_num_rows($result) > 0)
		{
			$i = 0;
			while($row = mysqli_fetch_assoc($result))
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
	<script SRC="javascript/jquery-2.1.4.min.js"></script>
	<script>
		// Objects & Variables
		// =============================
		
		var mainTranscript;
		
		var Transcript = function(){
			this.semesters = [];
			
			this.calculateCumulative = function(){
				var cumlAttCredits = 0;
				var cumlEarCredits = 0;
				var cumlGpaUnits = 0;
				var cumlPoints = 0;
				for(semester of this.semesters){
					cumlAttCredits += semester.termAttemptedCredits;
					cumlEarCredits += semester.termEarnedCredits;
					cumlGpaUnits += semester.termGpaUnits;
					cumlPoints += semester.termPoints;
					
					semester.cumlAttemptedCredits = cumlAttCredits;
					semester.cumlEarnedCredits = cumlEarCredits;
					semester.cumlGpaUnits = cumlGpaUnits;
					semester.cumlPoints = cumlPoints;
					
					semester.cumlGpa = cumlPoints * 1.0 / cumlGpaUnits;
				}
			}
		}
		
		var Semester = function(season, year){
			this.season = season;
			this.year = year;
			this.termGpa = 0;
			this.termAttemptedCredits = 0;
			this.termEarnedCredits = 0;
			this.termGpaUnits = 0;
			this.termPoints = 0;
			this.cumlGpa = 0;
			this.cumlAttemptedCredits = 0;
			this.cumlEarnedCredits = 0;
			this.cumlGpaUnits = 0; // Discounts credits that do not count toward GPA calculation
			this.cumlPoints = 0;
			this.courses = [];
			
			this.calculateTerm = function(){
				for(course of this.courses){
					this.termAttemptedCredits += course.credits;
					this.termEarnedCredits += course.earnedCredits;
					this.termGpaUnits = this.termEarnedCredits; //TODO: support the ignoring of repeated courses
					this.termPoints += course.points;
				}
				this.termGpa = this.termPoints * 1.0 / this.termGpaUnits;
			}
		}
		
		var Course = function(id, name, grade, credits){
			this.id = id;
			this.name = name;
			this.grade = grade;
			this.credits = credits;
			this.earnedCredits = credits;
			
			var creditsMultiplier = 0;
			switch(grade){
				case "A":
					creditsMultiplier = 4;
					break;
				case "B":
					creditsMultiplier = 3;
					break;
				case "C":
					creditsMultiplier = 2;
					break;
				case "D":
					creditsMultiplier = 1;
					break;
				default:
					this.earnedCredits = 0;
					break;
			}
			this.points = credits * creditsMultiplier;
		}
		
		// Methods
		//=============================
		
		// Get transcript data on page load
		$(function(){
			var $loading = $("#overlay").hide();
			$(document)
				.ajaxStart(function () {
					$loading.show();
					console.log("Building transcript...");
				});
			$.ajax({
				type: "GET",
				url: "library/getTranscript.php",
				dataType: "json",
				success: function(json) {
					mainTranscript = buildTranscript(json);
					$loading.hide();
					console.log("Transcript built!");
					semesterSelected(0);
				}
			   });
		});
		
		// Builds the transcript using the response data
		function buildTranscript(json) {
			var t = new Transcript();
			var currentSemester;
			// set first semester to the earliest section season and year
			$.each(json.transcript, function(i, v){
				currentSemester = new Semester(v.sectionSeason, v.sectionYear);
				return false;
			});
			// fill semesters with courses
			$.each(json.transcript, function(i, v){
				if(currentSemester.season != v.sectionSeason || currentSemester.year != v.sectionYear)
				{
					currentSemester.calculateTerm();
					t.semesters.push(currentSemester);
					currentSemester = new Semester(v.sectionSeason, v.sectionYear);
				}
				currentSemester.courses.push(new Course(v.courseId, v.courseName, v.courseGrade, parseInt(v.courseCredits)));
			});
			currentSemester.calculateTerm();
			t.semesters.push(currentSemester);
			t.calculateCumulative();
			//console.log(t);
			return t;
		}
		
		// runs whenever the combo box changes
		function semesterSelected(sem) {
			sem = parseInt(sem);
			if (sem == -1){ return; } // if the default option is selected do nothing
			$("#transcriptA").find('tbody').find('tr').remove(); // delete all of the old data
			var semester = mainTranscript.semesters[sem];
			for(course of semester.courses){
				// re-fill the first table
				$("#transcriptA").find('tbody')
					.append($('<tr>')
						.append(
							$('<td>').text(course.id.substring(0,4) + " " + course.id.substring(4)),
							$('<td>').text(course.name),
							$('<td>').text((course.credits).toFixed(3)),
							$('<td>').text((course.earnedCredits).toFixed(3)),
							$('<td>').text(course.grade),
							$('<td>').text((course.points).toFixed(3)))
						);
			}
			// fill the second table
			$("#termGpa").text((semester.termGpa).toFixed(3));
			$("#termAttempted").text((semester.termAttemptedCredits).toFixed(3));
			$("#termEarned").text((semester.termEarnedCredits).toFixed(3));
			$("#termGpaUnits").text((semester.termGpaUnits).toFixed(3));
			$("#termPoints").text((semester.termPoints).toFixed(3));
			$("#cumlGpa").text((semester.cumlGpa).toFixed(3));
			$("#cumlAttempted").text((semester.cumlAttemptedCredits).toFixed(3));
			$("#cumlEarned").text((semester.cumlEarnedCredits).toFixed(3));
			$("#cumlGpaUnits").text((semester.cumlGpaUnits).toFixed(3));
			$("#cumlPoints").text((semester.cumlPoints).toFixed(3));
		}
		
	</script>
</head>
<body>
	<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
	<div id="pagediv">
		<?php include("includes/menustrip.php"); ?>
		<span class="title">Transcript</span>
		<br />
		<select id="selectSemester" onchange="semesterSelected(this.value)">
			<?php fillSelect() ?>
		</select>
		<br />
		<br />
		<br />
		<div id="transcriptDiv">
			<table id="transcriptA">
				<thead class="transcriptTableHead">
					<tr><td>Course</td><td>Description</td><td>Attempted</td><td>Earned</td><td>Grade</td><td>Points</td>
				</thead>
				<tbody>
				</tbody>
			</table>
			<br />
			<table id="transcriptB">
				<thead>
					<tr><td></td><td></td><td></td><td>Attempted</td><td>Earned</td><td>GPA Units</td><td>Points</td></tr>
				</thead>
				<tbody>
					<tr><td>Term GPA:</td><td id="termGpa"></td><td>Term Totals:</td><td id="termAttempted"></td><td id="termEarned"></td><td id="termGpaUnits"></td><td id="termPoints"></td></tr>
					<tr><td>Cum GPA:</td><td id="cumlGpa"></td><td>Cum Totals:</td><td id="cumlAttempted"></td><td id="cumlEarned"></td><td id="cumlGpaUnits"></td><td id="cumlPoints"></td></tr>
				</tbody>
			</table>
		</div>
		<div id='overlay'></div>
	</div>
</body>
</html>