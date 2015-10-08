<!DOCTYPE html>
<html>
<head>
<title>Campus Reconnection</title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script>
function initialize()
{
  var mapProp = {
    center:new google.maps.LatLng(46.896824, -96.8033365),
    zoom:15,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
 
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}

google.maps.event.addDomListener(window,"load",initialize);
</script>
</head>
<body>
<img src="images/campusreconnectionlogo.png" />
<div id="pagediv">
<div id="googleMap" style="width:960px;height:640px;"></div>
</div>
</body>
</html>