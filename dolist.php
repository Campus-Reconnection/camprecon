<?php session_start(); require("library/system.php"); loginHandler(); setlocale(LC_MONETARY, 'en_US')?>
<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="icon" type="image/ico" href="images/favicon.ico" />
 <script>
 function openWindow(message) {
	var h = 200;
	var w = 400;
	var left = (screen.width/2)-(w/2);
	var top = (screen.height/2)-(h);
	var myWindow = window.open("", "Instruction", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width="+w+", height="+h+", top="+top+", left="+left);
	myWindow.document.write(message);
 }
 </script>
</head>
<body>
<?php include("includes/loginfo.php"); ?>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<span class="title">Holds:</span>
<br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Item</td>
<td class="thr">Issued</td>
<td class="thr">Due</td>
<td class="thr">Reason</td>
<td class="thr">Amount</td>
<td class="thr">Department</td>
</tr>
<?PHP
	$sql = "SELECT typ.strTypeName AS taskType, tsk.dtmIssued AS dateIssued, tsk.dtmDue AS dateDue, tsk.dblAmount AS amountDue, tsk.strDepartment AS department, tsk.strReason AS reason, typ.strInstruction AS instruction
		FROM tblTask tsk
		JOIN tblTaskType typ ON tsk.intTaskTypeID = typ.intTaskTypeID
		JOIN tblStudent stu ON stu.strStudentEID = tsk.strEID
		WHERE stu.strStudentEID = ? AND typ.strTaskClass = 'H'
		ORDER BY taskType";
	$result = dbGetAll($sql, "s", $_SESSION['cruser']);
	foreach($result as $row) {
		$dateIssued = $row['dateIssued'] ? date_format(date_create($row['dateIssued']), "M/d/Y") : "---";
		$dateDue = $row['dateDue'] ? date_format(date_create($row['dateDue']), "M/d/Y") : "---";
		$amountDue = $row['amountDue'] ? sprintf("$%.2f", $row['amountDue']) : "---";
		$reason = $row['reason'] ? $row['reason'] : "---";
		echo '<tr>';
		echo '<td class="advcell"><a href="javascript:openWindow(&quot;'.$row['instruction'].'&quot;)">'.$row['taskType'].'</a></td>';
		echo '<td class="advcell">'.$dateIssued.'</td>';
		echo '<td class="advcell">'.$dateDue.'</td>';
		echo '<td class="advcell">'.$reason.'</td>';
		echo '<td class="advcell">'.$amountDue.'</td>';
		echo '<td class="advcell">'.$row['department'].'</td>';
	}
?>
</table>
</div>
<br />
<span class="title">To-Do:</span>
<br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Item</td>
<td class="thr">Issued</td>
<td class="thr">Due</td>
<td class="thr">Status</td>
<td class="thr">Department</td>
</tr>
<?PHP
	$sql = "SELECT typ.strTypeName AS taskType, tsk.dtmIssued AS dateIssued, tsk.dtmDue AS dateDue, tsk.strStatus AS status, tsk.strDepartment AS department, typ.strInstruction AS instruction
		FROM tblTask tsk
		JOIN tblTaskType typ ON tsk.intTaskTypeID = typ.intTaskTypeID
		JOIN tblStudent stu ON stu.strStudentEID = tsk.strEID
		WHERE stu.strStudentEID = ? AND typ.strTaskClass = 'T'
		ORDER BY taskType";
	$result = dbGetAll($sql, "s", $_SESSION['cruser']);
	foreach($result as $row) {
		$dateIssued = $row['dateIssued'] ? date_format(date_create($row['dateIssued']), "M/d/Y") : "---";
		$dateDue = $row['dateDue'] ? date_format(date_create($row['dateDue']), "M/d/Y") : "---";
		$status = $row['status'] ? $row['status'] : "---";
		echo '<tr>';
		echo '<td class="advcell"><a href="javascript:openWindow(&quot;'.$row['instruction'].'&quot;)">'.$row['taskType'].'</a></td>';
		echo '<td class="advcell">'.$dateIssued.'</td>';
		echo '<td class="advcell">'.$dateDue.'</td>';
		echo '<td class="advcell">'.$status.'</td>';
		echo '<td class="advcell">'.$row['department'].'</td>';
	}
?>
</table>
</div>
<br />
<span class="title">Milestones:</span>
<br />
<div class="shadow-container">
<table class="schedule">
<tr>
<td class="thr">Item</td>
<td class="thr">Issued</td>
<td class="thr">Department</td>
<td class="thr">&nbsp;</td>
</tr>
<?PHP
	$sql = "SELECT typ.strTypeName AS taskType, tsk.dtmIssued AS dateIssued, tsk.strDepartment AS department, typ.strInstruction AS instruction
		FROM tblTask tsk
		JOIN tblTaskType typ ON tsk.intTaskTypeID = typ.intTaskTypeID
		JOIN tblStudent stu ON stu.strStudentEID = tsk.strEID
		WHERE stu.strStudentEID = ? AND typ.strTaskClass = 'M'
		ORDER BY taskType";
	$result = dbGetAll($sql, "s", $_SESSION['cruser']);
	foreach($result as $row) {
		$dateIssued = $row['dateIssued'] ? date_format(date_create($row['dateIssued']), "M/d/Y") : "---";
		echo '<tr>';
		echo '<td class="advcell"><a href="javascript:openWindow(&quot;'.$row['instruction'].'&quot;)">'.$row['taskType'].'</a></td>';
		echo '<td class="advcell">'.$dateIssued.'</td>';
		echo '<td class="advcell">'.$row['department'].'</td>';
		echo '<td class="advcell">&nbsp;</td>';
	}
?>
</table>
</div>
</div>
</body>
</html>