<?php 
session_start(); 
require("library/system.php"); 
require("library/classqueries.php");
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
<span class="title">Weekly Schedule:</span>
<br />
<div class="shadow-container">
<?php include("includes/weeklyschedule.php"); ?>
</div>
<br />
<span class="title">Drop Classes:</span>
<br />
<div class="shadow-container">
<table class="schedule" id="schedule">
<?php returnCourses(); ?>
</table>
</div>
<br />
<input type="button" name="delete" value="Delete selected courses" onclick="removeRow('schedule')" style="float: right">

<?php
	if(isset($_GET['delete']))
	{
		foreach($_GET['check'] as $key=>$value)
		{
			deleteCourse($value);
		}				
	}
?>

<script>
function removeRow(id){
	var objTable = document.getElementById(id);
	var iRow = objTable.rows.length;
	var counter=0;
	if(objTable.rows.length>1 && confirm("Are you sure you want to drop the selected courses?")){
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