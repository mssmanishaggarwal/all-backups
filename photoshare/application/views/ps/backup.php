<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Marker animations with <code>setTimeout()</code></title>
    <style>
      html, body, #map-canvas {
       height: 100%;  
	   margin: 0px;
        padding: 0px
      }
      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: 180px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
// If you're adding a number of markers, you may want to drop them on the map
// consecutively rather than all at once. This example shows how to use
// window.setTimeout() to space your markers' animation.

var berlin = new google.maps.LatLng(22.71539, 88.571777);

var neighborhoods = [
<?php
$im= $this->db->query("SELECT * FROM images");
$k=$im->result_array();
 foreach($im->result_array() as $row){?>
  new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>),
  <?php } ?>
];

var pin_images=[
<?php
$im= $this->db->query("SELECT * FROM images");
$k=$im->result_array();
 foreach($im->result_array() as $row){?>
  '<?php echo $row['image_name'];?>',
  <?php } ?>
];
alert(neighborhoods.length);
var markers = [];
var map;

function initialize() {
  var mapOptions = {
    zoom: 3,
    center: berlin,
	mapTypeId: google.maps.MapTypeId.TERRAIN,
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);
}

function drop() {
  clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
    addMarkerWithTimeout(neighborhoods[i], i * 200,i);
	//popit_out(marker,i);

    }
 }
 
function addMarkerWithTimeout(position, timeout,c) {
	        var image = new google.maps.MarkerImage('<?php echo base_url().'upload/';?>'+pin_images[c]);
			image.size = new google.maps.Size( 20, 20 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 20, 20 );
  
    markers.push(new google.maps.Marker({
      position: position,
      map: map,
      animation: google.maps.Animation.DROP,
	  icon:image,
	  strokeOpacity:1,
    }));
///attachSecretMessage(markers, c)	

  }
 /*======================*/ 
function attachSecretMessage(marker, num) {
  var message = ['This', 'is', 'the', 'secret', 'message'];
  var infowindow = new google.maps.InfoWindow({
    content: message[num]
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });
}
  /*=====================*/

function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
   }

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body onLoad="drop();">
    <div id="panel" style="margin-left: -52px">
      <!--<button id="drop" onclick="drop()">Drop Markers</button>-->
     </div>
    <div id="map-canvas"></div>
  </body>
</html>