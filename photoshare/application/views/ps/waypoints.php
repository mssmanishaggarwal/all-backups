<html>
<head><title></title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<script src="json2.js"></script>
<script>
var map, ren, ser;
var data = {};
function goma()
{
		var start_point=document.getElementById('start_point').value;
	var end_point1=document.getElementById('end_point1').value;
	var end_point2=document.getElementById('end_point2').value;
	/*===================*/
	map = new google.maps.Map( document.getElementById('mappy'), {
		'zoom':12, 
		'mapTypeId': google.maps.MapTypeId.ROADMAP, 
		'center': new google.maps.LatLng(20.5728457, 86.36398370000006) })

	ren = new google.maps.DirectionsRenderer( {'draggable':true} );
	ren.setMap(map);
	ser = new google.maps.DirectionsService();
	
	ser.route({
	'origin': start_point,
    'destination': end_point2,
	'optimizeWaypoints': true,
	'travelMode': google.maps.DirectionsTravelMode.DRIVING},function(res,sts) {
		if(sts=='OK')ren.setDirections(res);
		var rleg = ren.directions.routes[0].legs[0];
		//console.log(ren);
		//console.log(rleg.start_location.A);
		call_to_marker(rleg.start_location.A-0.005,rleg.start_location.F-0.005)	
	})
		
}



/*'travelMode': google.maps.DirectionsTravelMode.DRIVING*/
function save_waypoints()
{
	var w=[],wp;
	var rleg = ren.directions.routes[0].legs[0];
	data.start = {'lat': rleg.start_location.lat(), 'lng':rleg.start_location.lng()}
	data.end = {'lat': rleg.end_location.lat(), 'lng':rleg.end_location.lng()}
	var wp = rleg.via_waypoints	
	for(var i=0;i<wp.length;i++){w[i] = [wp[i].lat(),wp[i].lng()]	}
	data.waypoints = w;
	//console.log(data.waypoints);
	var str = JSON.stringify(data);
    alert(str);
		//var obj =jQuery.parseJSON(str); 
		//var obj2 =jQuery.parseJSON(str); 
		//getmarker(obj.start.lat,obj2.start.lng);
		/*=================*/
		/*var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(obj.start.lat,obj.start.lng),
      new google.maps.LatLng(obj.end.lat,obj.end.lng));
  map.fitBounds(defaultBounds);*/
  /*=====================*/
	var jax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	jax.open('POST','process.php');
	jax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	jax.send('command=save&mapdata='+str)
	jax.onreadystatechange = function(){ if(jax.readyState==4) {
		if(jax.responseText.indexOf('bien')+1)/*alert('Updated')*/;
		else alert(jax.responseText)
	}}
	
		
	//call();
}

function call_to_marker(latty,longy){

 var image = new google.maps.MarkerImage('<?php echo base_url().'marker_images/';?>'+'marker.jpg');
			image.size = new google.maps.Size( 60, 60 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 60, 60 );
			
var myMarker = new google.maps.Marker({
    position: new google.maps.LatLng(latty, longy),
    draggable: true,
	icon: image,
	content: 'Place me',
});

google.maps.event.addListener(myMarker, 'dragend', function (evt) {
    document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';
});

google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
    document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
});

map.setCenter(myMarker.position);
myMarker.setMap(map);
    }

</script>

 <script>
 $(document).ready(function() {
    $('#sbmt').submit(function(kaushik){
		if($('#latitude2').val()=='' || $('#longitude2').val()=='' ){
		kaushik.preventDefault();
		$('#msg').html('Please Drag the map marker to select Longitude and Latitude of the image where you point.');
		}
		});
		$('#map_point').submit(function(k){ k.preventDefault();});
});
 </script>  
</head>

<body onLoad="goma()">
<div id="mappy" style="width:900px; height:550px; margin:0px auto 0px auto; border:1px solid #cecece; background:#F5F5F5"></div>
<div style="width:900px; text-align:center; margin:0px auto 0px auto; margin-top:10px;">
 <div id="current">Nothing yet...</div>
	<form id="map_point" method="post" >
<label>Start Point</label>
<input type="text" name="start_point" id="start_point" value="kolkata"/><br>
<label style="display:none;">End Point</label>
<input type="text" name="end_point1" id="end_point1" value="mumbai" style="display:none;"/><br>
<label>Way points</label>
<input type="text" name="end_point2" id="end_point2" value="chennai"/><br>
<input type="submit" value="Get Location" onClick="goma()"/>

</form>
<input type="button" value="Save Waypoints" onClick="save_waypoints();">
</div>
</body>
</html>
