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
					$('<td class="advcell">').text(course.id.substring(0,4) + " " + course.id.substring(4)),
					$('<td class="advcell">').text(course.name),
					$('<td class="advcell">').text((course.credits).toFixed(3)),
					$('<td class="advcell">').text((course.earnedCredits).toFixed(3)),
					$('<td class="advcell">').text(course.grade),
					$('<td class="advcell">').text((course.points).toFixed(3)))
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