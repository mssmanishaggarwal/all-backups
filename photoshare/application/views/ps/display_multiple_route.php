<script>
/*var routes = [{origin: ..., destination: ...}, {origin: ..., destination: ...}, {origin: ..., destination: ...}];
var rendererOptions = {
    preserveViewport: true,         
    suppressMarkers:true,
    routeIndex:i
};
var directionsService = new google.maps.DirectionsService();

routes.each(function(route){
    var request = {
        origin: route.origin,
        destination: route.destination,
        travelMode: google.maps.TravelMode.DRIVING
    };

    var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);
    directionsDisplay.setMap(map);

    directionsService.route(request, function(result, status) {
        console.log(result);

        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(result);
        }
    });
  });*/
 /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/
  /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/ /* NOT WORKING CODE*/
</script>
<script>


var rendererOptions = {
	zoom: 3,
  draggable: true
};
var directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions);;
var directionsService = new google.maps.DirectionsService();
var map;

var australia = new google.maps.LatLng(-25.274398, 133.775136);

function initialize() {

  var mapOptions = {
    zoom: 3,
    center: australia
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById('directionsPanel'));

  google.maps.event.addListener(directionsDisplay, 'directions_changed', function() {
    computeTotalDistance(directionsDisplay.getDirections());
  });

  calcRoute();
}

function calcRoute() {
	
		var start_point=document.getElementById('start_point').value;
	var end_point1=document.getElementById('end_point1').value;
	var end_point2=document.getElementById('end_point2').value;

  var request = {
    origin: start_point,
    destination: end_point2,
    waypoints:[{location: end_point1}/*, {location: end_point2}*/],
    travelMode: google.maps.TravelMode.DRIVING
  };

  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
     });
   }

function computeTotalDistance(result) {
  var total = 0;
  var myroute = result.routes[0];
  for (var i = 0; i < myroute.legs.length; i++) {
    total += myroute.legs[i].distance.value;
  }
  total = total / 1000.0;
  document.getElementById('total').innerHTML = total + ' km';
   }

google.maps.event.addDomListener(window, 'load', initialize);

</script>