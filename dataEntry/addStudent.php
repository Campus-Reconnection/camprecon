<!DOCTYPE html>
<html>
<head>
<title>Add Student</title>
<script SRC="../javascript/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
		$("#submitStudent").submit(function(event) {
			event.preventDefault();
			var $form = $( this ),
				url = $form.attr( 'action' );
			if ($('#firstName').val() == '' || $('#lastName').val() == '')
			{
				alert("Submit failed: first and last names required.");
			}
			else
			{
				var major1 = $('#major1').val() == '' ? 'Undeclared' : $('#major1').val();
				var isAService = $('#activeService').checked ? 1 : 0;
				$.ajax({
					type: "post",
					url: url,
					data: {	type: "student",
							fName: $('#firstName').val(),
							lName: $('#lastName').val(),
							mName: $('#middleName').val(),
							status: $('#status').val(),
							enrStatus: $('#enrollStatus').val(),
							sType: $('#studentType').val(),
							major1: major1,
							major2: $('#major2').val(),
							major3: $('#major3').val(),
							minor1: $('#minor1').val(),
							minor2: $('#minor2').val(),
							minor3: $('#minor3').val(),
							gpa: $('#gpa').val(),
							credits: $('#credits').val(),
							aService: isAService },
					success: function(responseData, textStatus, jqXHR) {
						$('#firstName').val('');
						$('#middleName').val('');
						$('#lastName').val('');
						$('#major1').val('');
						$('#major2').val('');
						$('#major3').val('');
						$('#minor1').val('');
						$('#minor2').val('');
						$('#minor3').val('');
						if ($('#activeservice').checked) { $('#activeservice').toggle(this.checked); }
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
<h3>Student Creator</h3>
Required Fields = *
<br /><br />
<form action="add.php" method="post" id="submitStudent">
<table>
<tr><td>First Name:</td><td><input type = "text" id = "firstName">*</td><tr>
<tr><td>Last Name:</td><td><input type = "text" id="lastName">*</td><tr>
<tr><td>Middle Name:</td><td><input type = "text" id="middleName"></td><tr>
<tr><td>Status:</td><td><select id="status">
	<option value="active">Active</option>
	<option value="suspended">Suspended</option>
</select>*</td></tr>
<tr><td>Enrollment Status:</td><td><select id="enrollStatus">
	<option value="Fulltime">Full-Time</option>
	<option value="Parttime">Part-Time</option>
</select>*</td></tr>
<tr><td>Student Type:</td><td><select id="studentType">
	<option value="und">Undergraduate</option>
	<option value="grd">Graduate</option>
	<option value="phd">Ph.d</option>
	<option value="crt">Certificate</option>
</select>*</td></tr>
<tr><td>Major1:</td><td><input type="text" id="major1"></td></tr>
<tr><td>Major2:</td><td><input type="text" id="major2"></td></tr>
<tr><td>Major3:</td><td><input type="text" id="major3"></td></tr>
<tr><td>Minor1:</td><td><input type="text" id="minor1"></td></tr>
<tr><td>Minor2:</td><td><input type="text" id="minor2"></td></tr>
<tr><td>Minor3:</td><td><input type="text" id="minor3"></td></tr>
<tr><td>Cumulative GPA:</td><td><input type="text" id="gpa">*</td></tr>
<tr><td>Total Credits:</td><td><input type="text" id="credits">*</td></tr>
<tr><td>Active Service:</td><td><input type="checkbox" id="activeService" value="1">*</td></tr>
</table>
<br />
<input type="submit" value="Add Student!"></input>
</form>
</body>
</html>