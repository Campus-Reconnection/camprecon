<?php
	require("../library/system.php");
	
	function popDropDown() {
		
		$sql = "SELECT intDeptID as id, strDeptCode as code
				FROM tblDepartment;";
		$result = queryDB($sql);
		
		// Spit out default option
		echo '<option value="-1">---</option>';
		// For each returned row, spit out drop-down code.
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				echo '<option value="' . $row['id'] . '">' . $row['code'] . '</option>';
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection - Add Faculty</title>
<style>
	.initiallyHidden { display: none; }
	.error { color: red; }
</style>
<script SRC="../javascript/jquery-2.1.4.min.js"></script>
<script>
    $(function(){
		$("#submitFaculty").submit(function(event) {
			event.preventDefault();
			var $form = $( this ),
				url = $form.attr( 'action' );
			if ($('#firstName').val() == '' || $('#lastName').val() == '')
			{
				alert("Submit failed: first and last names required.");
			}
			else if ($('#department').val() == '-1')
			{
				alert("Submit failed: department required.");
			}
			else if ($('#position').val() == '')
			{
				alert("Submit failed: position required.");
			}
			else
			{
				var mName = $('#middleName').val() == '' ? null : $('#mName').val();
				var isAdv = $('#isAdvisor').checked ? 1 : 0;
				$.ajax({
					type: "post",
					url: url,
					data: {	type: "faculty",
							fName: $('#firstName').val(),
							lName: $('#lastName').val(),
							mName: mName,
							department: $('#department').val(),
							pos: $('#position').val(),
							isAdv: isAdv },
					success: function(responseData, textStatus, jqXHR) {
						$('#firstName').val('');
						$('#middleName').val('');
						$('#lastName').val('');
						if ($('#isAdvisor').checked) { $('#isAdvisor').toggle(this.checked); }
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
<p>
	<form id="submitFaculty" method ="post" action ="add.php">
			<p>
				First Name: <input type='text' id='firstName' maxlength='24'><br />
				Middle Name: <input type='text' id='middleName' maxlength='24'><br />
				Last Name: <input type='text' id='lastName' maxlength='24'>
			</p>
			<p>
				Department: <select id="department" form="submitFaculty"><?php popDropDown(); ?></select>
			</p>
			<p>
				Position: <input type='text' id='position' maxlength='40' value='Professor'>
				Is Advisor: <input type='checkbox' id='isAdvisor' value='1'>
			</p>
			<p><input type="submit" value="Add!"></p>
	</form>
</p>
</body>
</html>