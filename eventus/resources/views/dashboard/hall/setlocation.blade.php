@extends('layouts.dashboard')
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>
<script>

//var stockholm = new google.maps.LatLng(21.237812, 18.770594);
//var parliament = new google.maps.LatLng(59.327383, 18.06747);
var geocoder;
var marker;
var map;
var markers=[];
var latitude;
var longitude;
var NewMapCenter;
function initialize() {
  geocoder = new google.maps.Geocoder();
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
 var image = new google.maps.MarkerImage('http://falconc.com/photoshare/marker_images/'+'marker.jpg');
      image.size = new google.maps.Size( 60, 60 );
      image.origin = new google.maps.Point( 0, 0 );
      image.scaledSize = new google.maps.Size( 60, 60 );
      // Create a marker for each place.
      var marker = new google.maps.Marker({
        map: map,
        icon: image,
        zoom:16,
        draggable:true,
        title: place.name,
        position: place.geometry.location
      });
  google.maps.event.addListener(marker, 'mouseup', toggleBounce);
      markers.push(marker);
      //geocodePosition(marker.getPosition());
      bounds.extend(place.geometry.location);
      console.log(place.geometry.location);
    }

    map.fitBounds(bounds);
    map.set("zoom", 12);
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

    geocodePosition(e.latLng);
    var ltolong=str.toString();
    var x = ltolong;
        var separators = [' ', '\\\+', '\\\(','\\\,', '\\\)', '\\*', '/', ':', '\\\?'];
        var tokens = x.split(new RegExp(separators.join('|'), 'g'));
       //console.log(str);
       //console.log(tokens[3]);
     document.getElementById('hall_lat').innerHTML='Hall Latitude :'+tokens[1];
     document.getElementById('hall_lng').innerHTML='Hall Longitude :'+tokens[3];
     document.getElementById('lats').value=tokens[1];
     document.getElementById('lngs').value=tokens[3];

  }
  function geocodePosition(pos) {
    geocoder.geocode({
    latLng: pos
    }, function(responses) {
    if (responses && responses.length > 0) {
      document.getElementById('current_addr').innerHTML = 'Current Address : ' + responses[0].formatted_address ;
      document.getElementById('g_address').value = responses[0].formatted_address ;
    } else {
        document.getElementById('current_addr').innerHTML = '<p>Current Address : Not Found</p>';
    }
    });
   }
</script>
@endsection
<!-- =================Google Map Loading======================= -->
<style type="text/css">
#map-canvas{
      width: 57% !important;
    height: 478px !important;
  }
.map-div{
  width:58%;
  float:left;
}
.post-map{
  width:40%;
      float: right;
}
.clear{
  clear: both;
}
#map-canvas{
  width: 100% !important;
}
</style>
@section('content')
<style type="text/css">
    input[type=checkbox]+ span{
        border:1px solid black;
    }
</style>
<section class="dash-main clearfix">
<div class="col-md-12 dash-top-second">
	<div class="col-md-6">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_169')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_169')}}</li>
	</ul>
	</div>
</div>
<div class="col-md-12 dash-container hallformwrap p-t-20 p-b-20">
@if (session('status'))
<div class="alert alert-success orange">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('status') }}</strong>
</div>
@endif
@if (session('fails'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('fails') }}</strong>
</div>
@endif
  <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
    <li role="presentation" class="active"><a href="{{url('/dashboard/hall/set-location')}}" class="disable_link"><span class="fa fa-map"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_170')}}</a></li>
    <li role="presentation"><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
    <li role="presentation"><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
     <li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-cube"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/subscription/')}}" ><span class="fa fa-cube"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
  </ul>
<div class="tab-content">
<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_170')}}</h5>
    <form class="form-horizontal hallform sing-up clearfix" role="form" method="POST" action="{{ url('/dashboard/addhall-validate') }}">
                {!! csrf_field() !!}
<input id="pac-input" class="controls form-control" type="text" style="width:70%;" placeholder="Enter your address or placename or zipcode">
<div class="map-div">
      <div id="map-canvas" style="width:100%; height:680px;"></div>
</div>
<div class="post-map">
    <div id="hall_lat"></div>
    <div id="hall_lng"></div>
    <div id="current_addr"></div>
</div>
<div class="clear"></div>
<input type="hidden" name="lat" id="lats" value="">
<input type="hidden" name="lng" id="lngs" value="">
<input type="hidden" name="g_address" id="g_address" value="">
</div>

                 <div class="col-md-12 m-b-35">
        <input type="submit" class="orange" value="Add"  />
       </div>
    </form>
</div>
</div>


</section>

@endsection