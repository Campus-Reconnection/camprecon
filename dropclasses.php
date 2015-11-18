<?php //session_start(); require("library/system.php"); loginHandler(); ?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Weekly Schedule:</span>
<br />
<div class="shadow-container">
<?php include("includes/weeklyschedule.php"); ?>
</div>
<br />
<span class="title">Drop Classes:</span>
<br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Select</td>
<td class="thr">Class</td>
<td class="thr">Description</td>
<td class="thr">Days/Times</td>
<td class="thr">Room</td>
<td class="thr">Instructor</td>
</tr>
<form action="dropclasses.php" method="get">
<tr>	
<td class="advcell"><input type="checkbox" name="class0"</td>
<td class="advcell">PHYS211</td>
<td class="advcell">Physics</td>
<td class="advcell">MoWeFr 10:00AM - 10:50AM</td>
<td class="advcell">South Engineering, 116 </td>
<td class="advcell">Warren Christensen</td>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="class1"</td>
<td class="advcell">CSCI213</td>
<td class="advcell">Modern Software Development</td>
<td class="advcell">MoWeFr 2:00PM - 2:50PM</td>
<td class="advcell">Quentin Burdick Bldg, 102</td>
<td class="advcell">Oksana Myronovych</td>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="class2"</td>
<td class="advcell">CSCI222</td>
<td class="advcell">Discrete Math</td>
<td class="advcell">MoWeFri 4:00PM-4:50PM</td>
<td class="advcell">Quentin Burdick Bldg, 102</td>
<td class="advcell">Vasasant Ubhaya</td>
</tr>
<tr>
<td class="advcell"><input type="checkbox" name="class3"</td>
<td class="advcell">CSCI413</td>
<td class="advcell">Principles of Software Engineering</td>
<td class="advcell">TuTh 11:00AM-12:15PM</td>
<td class="advcell">Quentin Burdick Bldg, 102</td>
<td class="advcell">Alex Radermacher</td>
</tr>
<td class="advcell"><input type="checkbox" name="class4"</td>
<td class="advcell">STAT367</td>
<td class="advcell">Statistics</td>
<td class="advcell">TuTh 2:00PM - 2:50PM</td>
<td class="advcell">Van Es, 101</td>
<td class="advcell">Tatjana Miljkovic</td>
</tr>
</table>
</div>
<br />
<input type="button" value="Delete selected courses" onclick="removeRow('schedule')" style="float: right">
<script>
function removeRow(id){
	var objTable = document.getElementById(id);
	var iRow = objTable.rows.length;
	var counter=0;
	if(objTable.rows.length>1){
		for(var i=0;i<objTable.rows.length; i++){
			var chk=objTable.rows[i].cells[0].childNodes[0];
			if(chk.checked){
				objTable.deleteRow(i);
				iRow--;
				i--;
				counter=counter+1;
			}
		}
	}
}

</script>
</form>
</body>
</html>