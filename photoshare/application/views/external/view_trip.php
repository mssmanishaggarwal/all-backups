<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Photo Sharing</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>/favicon.ico">
<link rel="stylesheet" href="<?php echo base_url();?>/css/style.css">
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css"/>
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
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="<?php echo base_url();?>/src/skdslider.min.js"></script>
<link href="<?php echo base_url();?>/src/skdslider.css" rel="stylesheet">
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>

<?php
$im = $this->db->query("SELECT * FROM `waypoints` WHERE parent='" . $map_id . "' LIMIT 0,1");
foreach ($im->result_array() as $row) {
	$obj = json_decode($row['waypoints']);
	$waypoints = $obj->waypoints;}
?>
      <?php
$count = 0;
$im = $this->db->query("SELECT DISTINCT  parent FROM `waypoints` WHERE parent='" . $map_id . "'");
foreach ($im->result_array() as $row) {

	$count++;}
?>
<script type="text/javascript">
	  var a=<?php echo $obj->start->lat?>;
	  var b=<?php echo $obj->start->lng?>;
	  var c=<?php echo $obj->end->lat?>;
	  var d=<?php echo $obj->end->lng?>;
	  var wa=<?php echo json_encode($waypoints);?>


    var directionDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;

  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var chicago = new google.maps.LatLng(41.850033, -87.6500523);
    var myOptions = {
      zoom: 6,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: chicago
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    directionsDisplay.setMap(map);
    calcRoute(a,b,c,d,wa);
  }

  function calcRoute(a,b,c,d,wa) {
  	 var wayPoints=[];
  	 var first = new google.maps.LatLng(42.496403, -124.413128);
  	 var second = new google.maps.LatLng(42.496401, -124.413126);
	 //console.log(wa);

	 for(var i=0;i<wa.length;++i){
	wayPoints.push({location:new google.maps.LatLng(wa[i][0],wa[i][1]),
     stopover: false
      });
	 }

    var request = {
        origin: new google.maps.LatLng(a,b),
        destination: new google.maps.LatLng(c,d),
        waypoints:wayPoints,
        optimizeWaypoints: true,
        travelMode: google.maps.DirectionsTravelMode.WALKING
    };
	//console.log(request);
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
        var route = response.routes[0];

		//call_to_marker(rleg.start_location.A-0.005,rleg.start_location.F-0.005)
      } else {
        alert("directions response "+status);
      }
    });
  }
  /*===========Starting Image Marker Placement=============*/
var neighborhoods = [
<?php
$im = $this->db->query("SELECT * FROM `waypoints` WHERE parent='" . $map_id . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {?>
  new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>),
  <?php }
?>
];

var pin_images=[
<?php
$im = $this->db->query("SELECT * FROM  `waypoints` WHERE parent='" . $map_id . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {?>
  '<?php echo str_replace(",", "','", $row['image_file']);?>',
  <?php }
?>
];

var pop_image=[
<?php
$im = $this->db->query("SELECT * FROM  `waypoints`WHERE parent='" . $map_id . "'");
$k = $im->result_array();
$c = 0;
foreach ($im->result_array() as $row) {
	$ir = $this->db->query("SELECT * FROM `waypoints_images` WHERE `way_id`='" . $row['id'] . "'");
	$da = $ir->num_rows(); //echo $da;?>
  '<h3><?php echo 'Test Here';?></h3><hr><ul <?php if ($da > 0) {?>id="demo<?php echo $c;?>"<?php }
	?> class="imrc"><li><a href=""><img src="<?php echo base_url();?>upload/<?php echo $row['image_file'];?>" height="200" width="200"/></a></li><?php
foreach ($ir->result_array() as $row) {
		$imgel = '<li><a href=""><img src="' . base_url() . 'upload/' . $row['image_file'] . '" height="200" width="200"/></a></li>';
		echo $imgel;
	}
	?></ul>',
 <?php $c++;}
?>
];
//alert(pop_image);
var markers = [];
var map;
function drop() {
  //clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
	  var image = new google.maps.MarkerImage('<?php echo base_url() . 'upload/';?>'+pin_images[i]);
			image.size = new google.maps.Size( 20, 20 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 20, 20 );
    var marker = new MarkerWithLabel({
      position: neighborhoods[i],
      map: map,
      labelText: "<img src='"+image.url+"' height='60' width='89'/>",
      labelClass: "labels", // the CSS class for the label
      labelStyle: {top: "-48px", left: "-35px", background:"#fff"},
      labelVisible: true
    });

    attachSecretMessage(marker, i);

    }
 }


 /*======================*/
function attachSecretMessage(marker, num) {
  var infowindow = new google.maps.InfoWindow({
    content: pop_image[num]
  });


  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });

  google.maps.event.addListener(infowindow, 'domready', function(){

    jQuery('#demo'+num).skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,autoSlide:false,animationType:'fading'});
   });


}

  /*===========Ending of Image Marker Placement=============*/
  google.maps.event.addDomListener(window, 'load', initialize);
  /*======================================*/

 $(document).ready(function(){
    $('.imrc > li').each(function(){
        alert($(this).length);
    });
 });
</script>
</head>

<body onLoad="drop();">
 <?php $this->load->view('header_menu');?>
 <div class="iframe-map1">
 <div class="iframe-map">


<div id="map_canvas" style="width:100%; height:680px;"></div>
<div id="directionsPanel" style="width:30%;height 100%"></div>
</div>
 <?php $session_data = $this->session->userdata('logged_in');?>
<div class="rightbarmain">
 	  <div class="rightbar" style="height:609px;">
      <div class="righttop1">
          <div class="righttop">
              <div class="righttop-left">
                  <a href="#">Logged In</a><br>
                  <?php echo $session_data['fname']?>
                </div>
                <div class="righttop-right"><a href="#">Logout</a></div>
            </div>
            <div class="right-button"><a href="#"><img src="<?php echo base_url();?>/images/edit.png" alt=""></a> <a href="#"><img src="<?php echo base_url();?>/images/drop.png" alt=""></a> <a href="#"><img src="<?php echo base_url();?>/images/enlarge.png" alt=""></a> <a href="#"><img src="<?php echo base_url();?>/images/cross.png" alt=""></a></div>


        <!--=========Simple Map List==================-->

  <?php /*?>      <div class="covername">Saved Simple Map</div>
<div class="wrl">
<?php
$count = 1;
$im = $this->db->query("SELECT * FROM simple_map  WHERE latitude!='' AND longitude!='' AND user_id='" . $session_data['user_id'] . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {?>
<span class="innerw">
<a href="<?php echo base_url();?>ps/pages/view_simple_map/<?php echo $row['id'];?>/" id="hid_<?php echo $count;?>" style="margin-left:105px;margin-top:0px;">
<input type="button" value="<?php echo $row['name'];?>" class="plex"></a>
<a href="" class="bot" title="DELETE" data-id="<?php echo $row['id'];?>" data-del="<?php echo $count;?>">x</a></span></br>
<?php $count++;}
?>
</div>
<!--=========Multimap Map List==================-->
<div class="covername">Saved Multimap Map</div>
<div class="wrl">
<?php
$count = 1;
$im = $this->db->query("SELECT DISTINCT `name`,`parent` FROM `multimap` WHERE `parent`!=0  AND user_id='" . $session_data['user_id'] . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {?>
<span class="innerw">
<a href="<?php echo base_url();?>ps/pages/view_multi_map/<?php echo $row['parent'];?>/" id="hid_<?php echo $count;?>" style="margin-left:105px;margin-top:0px;">
<input type="button" value="<?php echo $row['name'];?>" class="plex"></a>
<a href="" class="boty" title="DELETE" data-id="<?php echo $row['parent'];?>" data-del="<?php echo $count;?>">x</a>
</span>
</br>
<?php $count++;}
?>
</div>
<!--=========Trip map Map List==================-->
<div class="covername">Saved Trip Map</div>
<div class="wrl">
<?php
$count = 1;
$im = $this->db->query("SELECT * FROM `waypoints` WHERE user_id='" . $session_data['user_id'] . "' group by trip_name");
foreach ($im->result_array() as $row) {
$obj = json_decode($row['waypoints']);
$waypoints = $obj->waypoints;?>
<span class="innerw">
<a href="<?php echo base_url();?>ps/pages/view_trip/<?php echo $row['parent']?>" id="hid_<?php echo $count;?>">
<input type="button" value="<?php echo $row['trip_name']?>"
onClick="calcRoute(<?php echo $obj->start->lat?>,<?php echo $obj->start->lng?>,<?php echo $obj->end->lat?>,
<?php echo $obj->end->lng?>,<?php echo json_encode($waypoints);?>);drop();"
style="margin-left:105px;margin-top:0px;" class="plex" ></a>
<a href="" class="del_img" data-del="<?php echo $count;?>" title="DELETE" data-id="<?php echo $row['id'];?>">
x</a>
</span>
</br>
<?php $count++;}
?>
</div><?php */?>
<!--===================-->
<!--<ul id="demo"><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li></ul>-->
<!--======================-->
 <div style="clear:both;"></div>
</div>
</div>
</div>
 </div>

</body>
</html>

<?php

function get_trip_images($wayid) {
	$ir = $this->db->query("SELECT * FROM `waypoints_images` WHERE `way_id`='" . $wayid . "'");
	foreach ($ir->result_array() as $row) {
		$imgel = '<li><img src="<?php echo base_url();?>' . '/upload/' . $row['image_file'] . '" height="200" width="200"/></li>';
		return $imgel;
	}
}
?>


<style>

#flupload,.flu_but{padding:10px;border:0px;background-color:#69F;color:#FFF; margin-top:20px; } .image_container{float:righ !important; margin:3px !important; padding:3px !important; border:1px solid #66F !important; width:80px !important; position:relative; float:left; }
html, body, #map-canvas {height: 100%; margin: 0px; padding: 0px }
.controls {margin-top: 16px; border: 1px solid transparent; border-radius: 2px 0 0 2px; box-sizing: border-box; -moz-box-sizing: border-box; height: 32px; outline: none; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3); }
#latitude2,#image_title,#longitude2,#start_point,#end_point2{background-color: #fff; font-family: Roboto; font-size: 15px; font-weight: 300; margin-left: 12px; padding: 0 11px 0 13px; text-overflow: ellipsis; width: 264px; height: 25px; }
#pac-input {	  background-color: #fff; font-family: Roboto; font-size: 15px; font-weight: 300; margin-left: 12px; padding: 0 11px 0 13px; text-overflow: ellipsis; width: 484px; height:33px; }
#sbmt,#map_point > label{font-family: 'OpenSansBold'; font-size: 16px; color: #fff; }
#pac-input:focus {border-color: #4d90fe; }
.pac-container {font-family: Roboto; }
#type-selector {color: #fff; background-color: #4d90fe; padding: 5px 11px 0px 11px; }
#type-selector label {font-family: Roboto; font-size: 13px; font-weight: 300; }
#target {width: 345px; }
.image_container > input[type=checkbox]{position: absolute; margin-top: -20px; margin-left: 5px; }
.labels{background-color:white !important; padding:2px 2px 0px 2px  !important; border-radius: 3px; /*box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);*/ background: url(../images/arrow.png) no-repeat top left; }
 .close {
                /*background:url(http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/images/ui-icons_222222_256x240.png) NO-REPEAT -96px -128px;
                text-indent:-10000px;
                width:20px;
                height:20px;*/
                color:red;
                font-size: bold;
            }
  .bot{
    color: red !important;
    font-size: 18px !important;
    position: absolute;
    font-weight: bold;
    margin-left: -19px;
      }
      .boty{
            color: red !important;
    font-size: 18px !important;
    position: absolute;
    font-weight: bold;
    margin-left: -19px;
      }
      .del_img{
      color: red !important;
    font-size: 18px !important;
    position: absolute;
    font-weight: bold;
    margin-left: -19px;

      }
      .plex{
      margin-bottom: 5px;padding:10px;border:0px;background-color:#69F;color:#FFF;
    }
</style>
