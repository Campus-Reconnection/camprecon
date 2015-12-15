<?php
session_start();
require("library/system.php");
loginHandler();

function addmarker($Name,$Var,$Latitude,$Longitude)
{
	//-----------------------------------------------------------------//
	// Use me to place markers on the map.                             //
	//-----------------------------------------------------------------//
	// $Name is title of the building.                                 //
	// $Var is just basically a call sign, its used in the javascript. //
	// $Latitude and $Longitude are x and y coordinates respectively.  //
	//-----------------------------------------------------------------//
	
	echo "var " . $Var . "marker = new google.maps.Marker({position:{lat:" . $Latitude . ", lng:" . $Longitude . "}, map:map, title:\"" . $Name . "\"});\r\n";
	echo "var " . $Var . "info = new google.maps.InfoWindow({content:\"" . $Name . "\"}); " . $Var . "info.open(map," . $Var . "marker);\r\n";
	echo "google.maps.event.addListener(" . $Var . "marker,\"click\",function(){" . $Var . "info.open(map," . $Var . "marker);});\r\n";
}

function plotfromdatabase()
{
	$sql = "SELECT DISTINCT fac.strFacilityName, fac.intFacilityID, fac.intLatitude, fac.intLongitude
				FROM tblfacility AS fac
				JOIN tblRoom ON tblRoom.intFacilityID = fac.intFacilityID
				JOIN tblSection ON tblRoom.intRoomID = tblSection.intRoomID
				JOIN tblStudentEnrollment ON tblStudentEnrollment.intSectionID = tblSection.intSectionID
				JOIN tblStudent ON tblStudent.intStudentID = tblStudentEnrollment.intStudentID
				WHERE tblStudent.strStudentEID = ?";
	if ($result = dbGetAll($sql, "s", $_SESSION['cruser']))
		foreach ($result as $row)
			addmarker($row["strFacilityName"],strtolower(substr($row["strFacilityName"],0,1).$row["intFacilityID"]),$row["intLatitude"],$row["intLongitude"]);
}
?>

<!DOCTYPE html>
<html>
<head>
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
function initMap()
{
  var mapProp =
  {
    center: new google.maps.LatLng(46.894080,-96.802780),
    zoom: 16,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  
  <?php 
    plotfromdatabase();
  ?> 
}

google.maps.event.addDomListener(window,"load",initMap);
</script>
</head>
<body style="margin:0px;">
<div id="googleMap" style="width:960px; height:640px;"></div>
</body>
</html>