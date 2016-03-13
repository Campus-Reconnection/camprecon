<?php
	require("../library/system.php");
	
	function popDropDown() {
		
		// Spit out default option
		echo '<option value="-1">---</option>';
		
		// Retrieve options from db
		if ($result = dbGetAll("SELECT intFacilityId as id, strFacilityName as name FROM tblFacility;"))
		{
			foreach ($result as $row)
			{
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection - Add Room</title>
<style>
	.initiallyHidden { display: none; }
	.error { color: red; }
</style>
<script SRC="../javascript/jquery-2.1.4.min.js"></script>
<script>
	function buildingSelected(buildingId) {
		if (buildingId >= 0) {
			document.getElementById("Form").style.display = "inline";
		}
		else {
			document.getElementById("Form").style.display = "none";
		}
	}
	
    $(function(){
		$("#submitRoom").submit(function(event) {
			event.preventDefault();
			var $form = $( this ),
				url = $form.attr( 'action' );
			if (isNaN($('#seats').val()))
			{
				alert("Submit failed: Seats not a number.");
			}
			else
			{
				$.ajax({
					type: "post",
					url: url,
					data: {type: "room", facilityId: $('#selBuilding').val(), roomNumber: $('#roomNumber').val(), seats: $('#seats').val() },
					success: function(responseData, textStatus, jqXHR) {
						$('#roomNumber').val('');
						$('#seats').val('');
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

<P><select id="selBuilding" form="submitRoom" onchange="buildingSelected(this.value)"><?php popDropDown(); ?></select>
	<div ID = "Form" CLASS="initiallyHidden">
		<form id="submitRoom" method ="POST" action ="add.php">
				<p>
					Room Number: <input type='text' id='roomNumber' maxlength='5'><br />
					Seats: <input type='TEXT' id='seats' maxlength="3">
				</p>
				<p><input type="submit" value="Add!"></p>
			</form>
	</div>
			
</body>
</html>