<?php
	require("../library/system.php");
	
	function popDropDown() {
		
		$sql = "SELECT strDeptCode as code FROM tblDepartment;";
		$result = queryDB($sql);
		
		// Spit out default option
		echo '<option value="-1">---</option>';
		// For each returned row, spit out drop-down code.
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<option value="' . $row['code'] . '">' . $row['code'] . '</option>';
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Add Course</title>
<style>
	.initiallyHidden { display: none; }
	.error { color: red; }
</style>
<script SRC="../javascript/jquery-2.1.4.min.js"></script>
<script>
	function deptSelected(code) {
		if (code != "-1") {
			document.getElementById("Form").style.display = "inline";
		}
		else {
			document.getElementById("Form").style.display = "none";
		}
	}
	
    $(function(){
		$("#submitCourse").submit(function(event) {
			event.preventDefault();
			var $form = $( this ),
				url = $form.attr( 'action' );
			if ($('#courseId').val() == '' || $('#courseName').val() == '')
			{
				alert("Submit failed: course ID and name are required.");
			}
			else if (isNaN($('#credits').val()))
			{
				alert("Submit failed: credits is not a number.");
			}
			else if (isNaN($('#fee').val()))
			{
				alert("Submit failed: fee is not a number.");
			}
			else
			{
				$.ajax({
					type: "post",
					url: url,
					data: {	type: "course",
							dept: $('#selDept').val(),
							courseId: $('#courseId').val(),
							courseName: $('#courseName').val(),
							genEdCat: $('#genEdCat').val(),
							preReq: $('#preReq').val(),
							coReq: $('#coReq').val(),
							credits: $('#credits').val(),
							fee: $('#fee').val(),
							courseDesc: $('#courseDesc').val()
					},
					success: function(responseData, textStatus, jqXHR) {
						$('#courseId').val('');
						$('#courseName').val('');
						$('#genEdCat').val('');
						$('#preReq').val('');
						$('#coReq').val('');
						$('#credits').val('');
						$('#fee').val('');
						$('#courseDesc').val('');
						alert(responseData);
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert( "Sorry, there was a problem!" );
						console.log( "Error: " + errorThrown );
						console.log( "Status: " + textSatus );
						console.dir( jqXHR );
					}
				});
			}
		});
	});
</script>
</head>
<body>
<h3>Course Creator</h3>
Required Fields = *
<br /><br />
<p><select id="selDept" form="submitCourse" onchange="deptSelected(this.value)"><?php popDropDown(); ?></select></p>
<div id="Form" class="initiallyHidden">
<form id="submitCourse" action="add.php" method="post">
<table>
<tr><td>Course ID:</td><td><input type = "text" id = "courseId">* e.g. "161L" if you want "CSCI 161 Lab"</td><tr>
<tr><td>Course Name:</td><td><input type = "text" id="courseName">* e.g. Computer Science II</td><tr>
<tr><td>General Ed. Cat.:</td><td><input type="text" id="genEdCat"> F,C,R,S,A,B,W,D,G (Add all that apply, no spaces, max 3)</td></tr>
<tr><td>Prerequisite:</td><td><input type="text" id="preReq"> e.g. CSCI160</td></tr>
<tr><td>Corequisite:</td><td><input type="text" id="coReq"> e.g. CSCI161</td></tr>
<tr><td>Credit Number:</td><td><input type="text" id="credits">* e.g 3</td></tr>
<tr><td>Fee:</td><td><input type="text" id="fee">$</td></tr>
<tr><td>Description:</td><td><input type="text" id="courseDesc"> 140 characters</td></tr>
</table>
<br />
<input type="submit">
</form>
</div>
</body>
</html>