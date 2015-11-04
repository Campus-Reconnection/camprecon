<?php
require("library/system.php");
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
	$sql = "SELECT strFacilityName, intFacilityID, intLatitude, intLongitude FROM tblfacility WHERE intFacilityID >= 33 AND intFacilityID < 72;";
	$result = queryDB($sql);
	
	if (mysqli_num_rows($result) > 0)
	{
		while($row = mysqli_fetch_assoc($result))
		{
			addmarker($row["strFacilityName"],strtolower(substr($row["strFacilityName"],0,1).$row["intFacilityID"]),$row["intLatitude"],$row["intLongitude"]);
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
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
<body>
<a href="./"><img src="images/campusreconnectionlogo.png" style="border:0px;" alt="Campus Reconnection" /></a>
<div id="pagediv">
<?php include("includes/menustrip.php"); ?>
<div id="googleMap" style="width:960px;height:640px; box-shadow:0px 0px 24px #4f4f4f;"></div>
</div>
</body>
</html>
