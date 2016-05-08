
<html>
<head> <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/><title></title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
var map;
var directionsService;
var data = {};
var marker;
var infowindow;
var directionsDisplay;
var wayA = [];
var wayB = [];
var directionResult = [];
var oldDirections = [];
var currentDirections = null;

function goma()
{
	
	var mapDiv = document.getElementById('mappy');

	var mapOptions = {
	zoom: 12, 
	
	center: new google.maps.LatLng(-23.563594, -46.654239),
	mapTypeId : google.maps.MapTypeId.ROADMAP
	}
	map = new google.maps.Map( mapDiv, mapOptions );
	
 google.maps.event.addListener(map, "click", function(event) {
        if (wayA.length == wayB.length) {
        wayA.push(new google.maps.Marker({
	      draggable: true,		
          position: event.latLng,
          map: map  	  
        }));
        } else {
        wayB.push(new google.maps.Marker({
	      draggable: true,	
          position: event.latLng,
          map: map	  
        }));  

	directionsDisplay = new google.maps.DirectionsRenderer( {
	'map': map,
	'preserveViewport': true,
	'draggable':true/*, 
	'suppressMarkers' : true */} 
	);
	directionsDisplay.setMap(map);
	directionsDisplay.setPanel(document.getElementById("directionsPanel"));
	directionsService = new google.maps.DirectionsService();	
        }
    });
 
  google.maps.event.addListener(directionsDisplay, 'directions_changed',
      function() {
        if (currentDirections) {
          oldDirections.push(currentDirections);
          setUndoDisabled(false);
        }
        currentDirections = directionsDisplay.getDirections();
      });
	   setUndoDisabled(true);
	   
       calcRoute();
 
}  
   
function save_waypoints()
{
      var inicio = wayA[wayA.length-1].getPosition();
	
	  var final = wayB[wayB.length-1].getPosition(); 
	  alert(final);
       var url2 = "process.php?latA=" + inicio.lat() + "&lngA=" + inicio.lng() +
                "&latB=" + final.lat() + "&lngB=" + final.lng();
      downloadUrl(url2, function(data, responseCode) {
        if (responseText == 200 && data.length <= 1) {
          infowindow.close();
          document.getElementById("message").innerHTML = "Salvo";
		}
		});
		
		
		var str = JSON.stringify(data)
	  function downloadUrl(url2, callback) {
	  var jax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	jax.open('POST',url2);
	jax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	jax.send('command=save&tblroute='+str)
	jax.onreadystatechange = function(){ if(jax.readyState==4) {
		if(jax.responseText.indexOf('bien')+1)alert('Mapa Atualizado !');
		else alert(jax.responseText)		
	}}
	  }
}

function doNothing() {}

 function calcRoute() {
									
directionsService.route({ 'origin': wayA[wayA.length-1].getPosition(), 'destination':  wayB[wayB.length-1].getPosition(), 'travelMode': google.maps.DirectionsTravelMode.DRIVING},function(response,status) {
		if(status == google.maps.DirectionsStatus.OK) {
                    directionResult.push(response);
                    directionsDisplay.setDirections(response);	
					
                } else {
                    directionResult.push(null);
                }
				
	})
	clearOverlays();
 }
 
 f// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (wayA) {
    for (i in wayA) {
      wayA[i].setMap(null);
    }
  }
  if (wayB) {
    for (i in wayB) {
      wayB[i].setMap(null);
    }
  }
}
      





	  
</script>
</head>
		<body onLoad="goma()">
<div id="mappy" style="float:left;width:70%; height:100%"></div>
<input type="button" value="Salvar Waypoints" onClick="save_waypoints()">
<div id="directionsPanel" style="float:right;width:30%;height 100%"></div>
<select id="Escolha" onChange="calcRoute();">
  <option value= onchange= "markNow;">Marker</option>
  <option value="1 Wall St, New York, NY">Waypoint</option>
</select>
<div>
			<label>Endereco</label>
			<input type="text" id="endereco">
		</div>
		
		<input type="button" value="Marcar" id="marcar" onClick="marcar()">


</div>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript"> 
</script> 
<script type="text/javascript"> 
_uacct = "UA-162157-1";
urchinTracker();
</script> 
