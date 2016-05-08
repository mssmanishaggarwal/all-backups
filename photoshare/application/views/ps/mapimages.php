<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Photo Sharing</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>/favicon.ico">
<link rel="stylesheet" href="<?php echo base_url();?>/css/style.css">
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script>
  document.createElement('header');
  document.createElement('section');
  document.createElement('article');
  document.createElement('aside');
  document.createElement('nav');
  document.createElement('footer');
</script>
<script src="js/jquery-1.11.0.min.js"></script> 
</head>

<body>
 <?php $this->load->view('header_menu');?>
 <div class="iframe-map1">
 <div class="iframe-map">
<?php $tm=$this->session->userdata('selected_images'); //echo $tm['image_id']?>
<input id="pac-input" class="controls" type="text" placeholder="Enter your address or placename or zipcode">
<div id="map-canvas" style="width:100%; height:680px;"></div>
</div>
<div class="rightbarmain">
 	<div class="rightbar" style="height:587px;">
    <div class="covername">Drag and drop the camera icon on the map to assign the image a location. Choose a title then click Set Image Location to update the image.</div>
<div style="padding:20px;width:320px;float:left;">
<form method="post" action="<?php echo base_url();?>ps/pages/simple_map/" id="sbmt">
<?php
$c=1;
$im= $this->db->query("SELECT * FROM images WHERE id  IN (".$tm['image_id'].")");
 foreach($im->result_array() as $row){?>
<div class="image_container">
<img src="<?php echo base_url().'upload/'.$row['image_file'];?>" height="60" width="60"/>
<div class="checkboxFive">
                <input type="checkbox" value="<?php echo $row['id'];?>" id="checkboxFiveInput_<?php echo $c;?>" name="chk_image[]" />
                <label for="checkboxFiveInput_<?php echo $c;?>"></label>
            </div>
</div>

<?php $c++;} ?>
<div style="clear:both;"></div>
<p id="msg" style="color:red;"></p>
<form method="post" action="<?php echo base_url();?>ps/pages/update_image/" id="sbmt">
<label style="padding:0 0 10px 12px;">Image Title</label>
<input type="text" name="image_title" value="<?php echo $row['image_title'];?>" id="image_title" placeholder="Album Title" required/>
<p></p>
<label style="padding:0 0 10px 12px;">Picture latitude</label>
<input type="text" name="latitude" value="<?php echo $row['latitude'];?>" id="latitude2"  readonly="readonly"/>
<p></p>
<label style="padding:0 0 10px 12px;">Picture longitude</label>
<input type="text" name="longitude" value="<?php echo $row['longitude'];?>" id="longitude2"  readonly="readonly"/>

<input type="submit" value="Set Image Location" style="padding:10px;border:0px;background-color:#69F;margin:12px 0 0 12px;" />
</form>

 
 <div style="clear:both;"></div>
</div>
</div>
</div>
 </div>

</body>
</html>





 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
 <script>
 $(document).ready(function() {
    $('#sbmt').submit(function(kaushik){
      var n = $( "input[type='checkbox']:checked" ).length; 
		if($('#latitude2').val()=='' || $('#longitude2').val()=='' || n==''){
		kaushik.preventDefault();
		$('#msg').html('Please Drag the map marker to select Longitude and Latitude of the image where you point.Or Put album Title');
		}
		});
});
 </script>  

<script>

//var stockholm = new google.maps.LatLng(21.237812, 18.770594);
//var parliament = new google.maps.LatLng(59.327383, 18.06747); 

var marker;
var map;
var markers=[];
var latitude;
var longitude;
var NewMapCenter;
function initialize() {

  var map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
	zoom: 3,
  });


var defaultBounds = new google.maps.LatLngBounds(
      new google.maps.LatLng(-33.8902, 151.1759),
      new google.maps.LatLng(-33.8474, 151.2631));
  map.fitBounds(defaultBounds);
  /*=====///===========*/
//console.log(defaultBounds);
/*====////==========*/

  var input =(
      document.getElementById('pac-input'));
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var searchBox = new google.maps.places.SearchBox((input));

  google.maps.event.addListener(searchBox, 'places_changed', function() { //toggleBounce();
    var places = searchBox.getPlaces();
    if (places.length == 0) {
      return;
    }
    for (var i = 0, marker; marker = markers[i]; i++) {
      marker.setMap(null);
    }

    // For each place, get the icon, place name, and location.
    markers = [];
    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {
      /*var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
      };*/
 var image = new google.maps.MarkerImage('<?php echo base_url().'marker_images/';?>'+'marker.jpg');
			image.size = new google.maps.Size( 60, 60 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 60, 60 );
      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
		zoom:3,
       draggable:true,
        title: place.name,
        position: place.geometry.location
      });
	google.maps.event.addListener(marker, 'mouseup', toggleBounce);
      markers.push(marker);

      bounds.extend(place.geometry.location);
    }

    map.fitBounds(bounds);
  });
  // [END region_getplaces]

  // Bias the SearchBox results towards places that are within the bounds of the
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
/*========///=======*/

}

google.maps.event.addDomListener(window, 'load', initialize);

	function toggleBounce(e) {
		var str=e.latLng;
		var ltolong=str.toString();
		var x = ltolong;
        var separators = [' ', '\\\+', '\\\(','\\\,', '\\\)', '\\*', '/', ':', '\\\?'];
        var tokens = x.split(new RegExp(separators.join('|'), 'g'));
       //console.log(tokens[1]);
       //console.log(tokens[3]);
	   document.getElementById('latitude2').value=tokens[1];
	   document.getElementById('longitude2').value=tokens[3];
	
}
</script>
<style>
.image_container{float:left; margin:3px; padding:3px; /*border:1px solid #66F;*/ width:56px; }
html, body, #map-canvas {height: 100%; margin: 0px; padding: 0px; } 
.controls {margin-top: 16px; border: 1px solid transparent; border-radius: 2px 0 0 2px; box-sizing: border-box; -moz-box-sizing: border-box; height: 32px; outline: none; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); }
#latitude2,#image_title,#longitude2{background-color: #fff; font-family: Roboto; font-size: 15px; font-weight: 300; margin-left: 12px; padding: 0 11px 0 13px; text-overflow: ellipsis; width: 264px; height: 25px; }
#pac-input {	  background-color: #fff; font-family: Roboto; font-size: 15px; font-weight: 300; margin-left: 12px; padding: 0 11px 0 13px; text-overflow: ellipsis; width: 484px; height:33px; }
#sbmt > label{font-family: 'OpenSansBold'; font-size: 16px; color: #fff; }
#pac-input:focus {border-color: #4d90fe; }
.pac-container {font-family: Roboto; }
#type-selector {color: #fff; background-color: #4d90fe; padding: 5px 11px 0px 11px; }
#type-selector label {font-family: Roboto; font-size: 13px; font-weight: 300; }
#target {width: 345px; }
.checkboxFive{position: absolute; color: red; font-size: 24px; margin-top: -31px; margin-left: 10%; }
.checkboxFive label {cursor: pointer; position: absolute; width: 25px; height: 25px; top: 0; left: 0; background: #69F; /*border:1px solid #137ec3;*/ }
.checkboxFive label:after {opacity: 0.2; content: ''; position: absolute; width: 9px; height: 5px; background: transparent; top: 6px; left: 7px; border: 3px solid #fff; border-top: none; border-right: none; -webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); -o-transform: rotate(-45deg); -ms-transform: rotate(-45deg); transform: rotate(-45deg); }
.checkboxFive label:hover::after {opacity: 0.5; }
.checkboxFive input[type=checkbox]:checked + label:after {opacity: 1; } 
</style>