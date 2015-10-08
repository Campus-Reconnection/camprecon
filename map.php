<?php
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
  
  //Markers go here:
  <?php 
    addmarker("Quenitin Burdick Building","qbb",46.893617,-96.803128);
	addmarker("Minard Hall","minard",46.891419,-96.802421);
  ?> 
}
google.maps.event.addDomListener(window,"load",initMap);

</script>
</head>
<body>
<img src="images/campusreconnectionlogo.png" />
<div id="pagediv">
<div id="googleMap" style="width:960px;height:640px;"></div>
</div>
</body>
</html>