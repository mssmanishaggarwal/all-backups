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
<?php /*?><script src="<?php echo base_url();?>/src/skdslider.min.js"></script>
<link href="<?php echo base_url();?>/src/skdslider.css" rel="stylesheet"><?php */?>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script>
jQuery(document).ready(function(){
//jQuery('#demo').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,autoSlide:false,animationType:'fading'});
		/*	jQuery('#demo2').skdslider({delay:5000, animationSpeed: 1000,showNextPrev:true,showPlayButton:false,autoSlide:true,animationType:'sliding'});
			jQuery('#demo3').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,showPlayButton:true,autoSlide:true,animationType:'fading'});
			*/
			/*jQuery('#responsive').change(function(){
			  $('#responsive_wrapper').width(jQuery(this).val());
			  $(window).trigger('resize');
			});*/

		});

function updateTextArea() {
     var allVals = [];
     var allIds=[];
     $('#m >#m2 :checked').each(function() {
       allVals.push($(this).val());
       allIds.push($(this).data('imageid'));
     });
     document.getElementById('selected_images').value=allVals;
     document.getElementById('image_id').value=allIds;
  }
 $(function() {
   $('#m >#m2 input').click(updateTextArea);
   updateTextArea();
 });
  $(document).ready(function() {
    $('#sbmt').submit(function(kaushik){
    	var n = $( "input[type='checkbox']:checked" ).length;
		if($('#latitude2').val()=='' || $('#longitude2').val()=='' || n==''){
		kaushik.preventDefault();
		$('#msg').empty();
		$('#msg').html('Please Drag the map CAMERA marker to select Longitude and Latitude and select Ateast one image.');
		}else{
			return true;
		}
		});
		$('#map_point').submit(function(k){ k.preventDefault();});


});
</script>

</head>

<body >
<?php $this->load->view('header_menu');?>
 <div class="iframe-map1">
 <div class="iframe-map">


<div id="map_canvas" style="width:100%; height:680px;"></div>
<div id="directionsPanel" style="width:30%;height 100%"></div>
</div>
<div class="rightbarmain">
 	<div class="rightbar" style="height:587px;">
    <div class="covername">This is a Trip Map</div>
    <!--<div id="current" class="covername">Nothing yet...</div>-->
    <div class="covername">Select one or more images and drag the camera icon to the desired photo location</div>
<div style="padding:20px;width:320px;float:left;">


<br>
<hr>
<!--<input type="button" value="Save Waypoints" onClick="save_waypoints();" style="padding:10px;border:0px;background-color:#69F;color:#FFF;">-->
<?php
/*$count=1;
$im= $this->db->query("SELECT * FROM `waypoints`");
foreach($im->result_array() as $row){
$obj=json_decode($row['waypoints']);
$waypoints=$obj->waypoints;?>
<input type="button" value="View Route #<?php echo $count?>"
onClick="calcRoute(<?php echo $obj->start->lat?>,<?php echo $obj->start->lng?>,<?php echo $obj->end->lat?>,<?php echo $obj->end->lng?>,<?php echo json_encode($waypoints);?>);drop();" style="padding:10px;border:0px;background-color:#69F;color:#FFF;margin:2px;">
<?php $count++;} */?>
<div style="clear:both;"></div>
<!--===================-->
<!--<ul id="demo"><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li><li><img src="http://localhost/photoshare/upload/test12.jpg" height="200" width="200"/></li></ul>-->
<!--======================-->
<div class="image_container_wrsp" id="m" >
<?php $tm = $this->session->userdata('selected_images'); //print_r($tm);
$c = 1; //echo $tm['image_id']
$im = $this->db->query("SELECT * FROM images WHERE id IN(" . $tm['image_id'] . ")");
foreach ($im->result_array() as $row) {?>
<div class="image_container" id="m2">
<img src="<?php echo base_url() . 'upload/' . $row['image_file'];?>" height="80" width="80"/><br />
	 <div class="checkboxFive">
          <input type="checkbox" data-imageid="<?php echo $row['id'];?>" value="<?php echo $row['image_file'];?>" id="checkboxFiveInput_<?php echo $c;?>" name="image" class="iamgem"/>
          <label for="checkboxFiveInput_<?php echo $c;?>"></label>
     </div>
    <!-- <input name="image" type="checkbox" value="<?php //echo $row['image_file'];?>" id="images"> -->
</div>
 <?php $c++;}
?>


 <?php
$session_data = $this->session->userdata('logged_in');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	//echo '<pre>';
	//print_r($_POST);
	$images = explode(',', $_POST['selected_images']);
	//print_r($images);
	$img_id = explode(',', $_POST['image_id']);
	$itm = explode(',', $tm['image_id']);
	$set_id = implode(',', array_diff($itm, $img_id));
	//print_r($img_id);
	//print_r($itm);
	//print_r(array_diff($itm,$img_id));
	//echo '<pre>';
	$this->session->set_userdata('selected_images', array(
		'image_id' => $set_id,
	));
	if ($_POST['parent'] == 0) {
		$datanew = array(
			'parent' => $_POST['id'],
			'trip_name' => $_POST['trip_name'],
			'image_file' => $images[0],
			'latitude' => $_POST['latitude'],
			'longitude' => $_POST['longitude'],
			'user_id' => $session_data['user_id'],
		);
		$this->db->where('id', $_POST['id']);
		$this->db->update('waypoints', $datanew);
		$this->db->query("UPDATE `images` SET assigned='1', map_type='trip' WHERE id IN(" . $_POST['image_id'] . ")");
		foreach ($images as $v => $k) {
			if ($v == 0) {continue;}
			$datanew1 = array(
				'way_id' => $_POST['id'],
				'image_file' => $k,
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude'],
				'user_id' => $session_data['user_id'],
			);
			$this->db->insert('waypoints_images', $datanew1);
			$this->db->query("UPDATE `images` SET assigned='1', map_type='trip' WHERE id IN(" . $_POST['image_id'] . ")");
		}
	} else {
		$datanew2 = array(
			'parent' => $_POST['id'],
			'trip_name' => $_POST['trip_name'],
			'image_file' => $images[0],
			'latitude' => $_POST['latitude'],
			'longitude' => $_POST['longitude'],
			'waypoints' => $_POST['waypoints'],
			'user_id' => $session_data['user_id'],
		);
		$this->db->insert('waypoints', $datanew2);
		$insert_id = $this->db->insert_id();
		foreach ($images as $v => $k) {
			if ($v == 0) {continue;}
			$datanew1 = array(
				'way_id' => $insert_id,
				'image_file' => $k,
				'latitude' => $_POST['latitude'],
				'longitude' => $_POST['longitude'],
				'user_id' => $session_data['user_id'],
			);
			$this->db->insert('waypoints_images', $datanew1);
			$this->db->query("UPDATE `images` SET assigned='1', map_type='trip' WHERE id IN(" . $_POST['image_id'] . ")");
		}
	}

	if (isset($_POST['final_pointing']) && !empty($_POST['final_pointing'])) {
		$data = array('update' => 'empty caption',
			'map_caption' => $_POST['trip_name'],
			'user_id_fk' => $session_data['user_id'],
			'map_ac_id' => $_POST['id'],
			'map_type' => 'trip',
			'post_date' => date("Y-m-d H:i:s"),
		);
		/*$this->load->model('profile/newes', 'profile_model');
		$this->profile_model->create_text_post($data);
		exit();*/
		$this->db->insert('updates', $data);
		redirect(base_url() . 'ps/pages/view_trip/' . $_POST['id']);
	} else {
		redirect(base_url() . 'ps/pages/set_images/' . $_POST['id']);
	}
	/*echo("INSERT INTO `waypoints` ('image_file','latitude','longitude','waypoints')VALUES
('".$_POST['selected_images']."','".$_POST['waypoints']."','".$_POST['latitude']."','".$_POST['longitude']."')");*/
}
?>
<br />
<div style="clear:both;"></div>

</div>
<script>
	$(document).ready(function(){
		var check_box_count=$('.iamgem').length;
		$('.final_pointing').hide() ;
		//alert(check_box_count);
		$(document).on('click','.iamgem',function(){ //alert();
			var checked_number=$('[name="image"]:checked').length;
			//alert(checked_number);
			if(check_box_count==checked_number){
			     $('.individual_pointing').hide() ;
			     $('.final_pointing').show() ;
		     }else{
		     	 $('.individual_pointing').show() ;
		     	 $('.final_pointing').hide() ;
		     }
		});

	});
</script>
<form method="post" action="<?php echo base_url();?>ps/pages/set_images/" id="sbmt">
<input type="hidden" name="selected_images" id="selected_images" value=""/>
<input type="hidden" name="image_id" id="image_id" value=""/>
<input type="hidden" name="latitude" value="" id="latitude2" />
<input type="hidden" name="longitude" value="" id="longitude2" />
<input type="hidden" name="id" value="<?php echo $this->uri->segment(4);?>"/>
<?php $kl = mysql_fetch_array(mysql_query("SELECT * FROM waypoints WHERE id='" . $this->uri->segment(4) . "'"));?>
<input type="hidden" name="parent" value="<?php echo $kl['parent'];?>">
<input type="hidden" name="trip_name" value="<?php echo $kl['trip_name'];?>">
<input type="hidden" name="waypoints" value='<?php echo $kl['waypoints'];?>'>
<input type="submit" name="individual_pointing" class="individual_pointing" value="Set Photo Location" style="padding:10px;border:0px;background-color:#69F;margin-top:12px;" />
<input type="submit" name="final_pointing" class="final_pointing" value="Finished Selecting Photos" style="padding:10px;border:0px;background-color:#69F;margin-top:12px;" />
</form>

<div id="current" class="covername">Please drag the map CAMERA marker to select Longitude and Latitude. Select at least one image.</div>

<p id="msg" style="color:red;"></p>
<!--======================-->
 <div style="clear:both;"></div>
</div>
</div>
</div>
 </div>

</body>
</html>
    <?php
$count = 0;
$im = $this->db->query("SELECT * FROM `waypoints` WHERE  id='" . $this->uri->segment(4) . "'");
foreach ($im->result_array() as $row) {
	//echo '<pre>';
	$obj = json_decode($row['waypoints']);
	$waypoints = $obj->waypoints;
	//print_r($obj->waypoints);
	//echo '</pre>';
	$count++;} /*echo count($obj->start);echo $count;*/?>
<script type="text/javascript">
var geocoder;
geocoder = new google.maps.Geocoder();
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
		//console.log(route.legs[0].start_location.A);
	  call_to_marker(route.legs[0].start_location.lat()-0.005 ,route.legs[0].start_location.lng()-0.005);
      } else {
        alert("directions response "+status);
      }
    });
  }
  /*===========Starting Image Marker Placement=============*/
<?php /*?>  var neighborhoods = [
<?php
$im= $this->db->query("SELECT * FROM `waypoints`");
$k=$im->result_array();
foreach($im->result_array() as $row){?>
new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>),
<?php } ?>
];

var pin_images=[
<?php
$im= $this->db->query("SELECT * FROM `waypoints`");
$k=$im->result_array();
foreach($im->result_array() as $row){?>
'<?php echo str_replace(",","','",$row['image_file']);?>',
<?php } ?>
];

var pop_image=[
<?php
$im= $this->db->query("SELECT * FROM `waypoints`");
$k=$im->result_array();
$c=1;
foreach($im->result_array() as $row){?>
'<h3><?php echo 'Test Here';?></h3><hr><ul id="demo"><li><img src="http://localhost/photoshare/upload/<?php echo $row['image_file'];?>" height="200" width="200"/></li><?php 	$ir= $this->db->query("SELECT * FROM `waypoints_images` WHERE `way_id`='".$row['id']."'");
foreach($ir->result_array() as $row){
$imgel='<li><img src="http://localhost/photoshare/upload/'.$row['image_file'].'" height="200" width="200"/></li>';
echo $imgel;
}?></ul>',
<?php $c++;} ?>
];<?php */?>
//alert(pop_image);
var map;
/*var markers = [];

function drop() {
  //clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
   // addMarkerWithTimeout(neighborhoods[i], i * 200,i);
	//popit_out(marker,i);
	        var image = new google.maps.MarkerImage('<?php //echo base_url().'upload/';?>'+pin_images[i]);
			image.size = new google.maps.Size( 20, 20 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 20, 20 );
    var marker = new google.maps.Marker({
      position: neighborhoods[i],
      map: map,
	  animation: google.maps.Animation.DROP,
	  icon:image,
	  strokeOpacity:1,
    });

   // marker.setTitle((i + 1).toString());
    attachSecretMessage(marker, i);

    }
 }*/


 /*======================*/
function attachSecretMessage(marker, num) {
 // var pop_image = ['This', 'is', 'the', 'secret', 'message'];
  var infowindow = new google.maps.InfoWindow({
    content: pop_image[num]
  });
//var infowindow = infoWindow.setContent(pop_image[num]);
/* infowindow = new google.maps.InfoWindow({
                content: "holding..."
            });*/
//var userLi1 = '<div>Some awesome content for the 1st list item</div>';

            // add some content userLi2
           // var userLi2 = '<div>Some awesome content for the 2nd list item</div>'
              // set marker content
             // marker.html = '<div class="carausal_4">' + userLi1 + userLi2 + '</div>';
             // add listener

  google.maps.event.addListener(marker, 'click', function() {
	//infowindow.setContent(marker.html);
    infowindow.open(marker.get('map'), marker);
  });

 google.maps.event.addListener(infowindow, 'domready', function(){
    // initiate slider here
      /*$('.carausal').slick({
			   dots: false,
  infinite: true,
  speed: 500,
  fade: true,
  cssEase: 'linear'
      });*/
	  jQuery('#demo').skdslider({delay:500, animationSpeed: 500,showNextPrev:true,autoSlide:false,animationType:'fading'});
   });


}
/*========listen marker=============*/
function call_to_marker(latty,longy){

 var image = new google.maps.MarkerImage('<?php echo base_url() . 'marker_images/';?>'+'marker.jpg');
			image.size = new google.maps.Size( 60, 60 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 60, 60 );

var myMarker = new google.maps.Marker({
    position: new google.maps.LatLng(latty, longy),
    draggable: true,
	icon: image,
	content: 'Place me',
	location : new google.maps.LatLng(latty, longy),
});

google.maps.event.addListener(myMarker, 'dragend', function (evt) {
  //var addr=updateMarkerStatus('dragend');
   geocodePosition(myMarker.getPosition());
//console.log(evt.latLng.A);
    document.getElementById('latitude2').value=evt.latLng.lat().toString();
	document.getElementById('longitude2').value=evt.latLng.lng().toString();
	///document.getElementById('current').innerHTML = '<p>Current Address : ' + addr  + '</p>';
});

google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
    document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
});

map.setCenter(myMarker.position);
myMarker.setMap(map);

   }
   /*==========================*/
  function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
		//console.log(responses[0].formatted_address);
		document.getElementById('current').innerHTML = '<p>Current Address : ' + responses[0].formatted_address + '</p>';
      //updateMarkerAddress(responses[0].formatted_address);
    } else {
      document.getElementById('current').innerHTML = '<p>Current Address : Not Found</p>';
    }
  });
}
  /*===========Ending of Image Marker Placement=============*/
  google.maps.event.addDomListener(window, 'load', initialize);
  /*======================================*/

</script>


<style>
#flupload,.flu_but{padding:10px;border:0px;background-color:#69F;color:#FFF; margin-top:20px; }
.image_container{float:righ !important; margin:3px !important; padding:3px !important; border:1px solid #66F !important; width:80px !important; position:relative; float:left; }
html, body, #map-canvas {height: 100%; margin: 0px; padding: 0px } /*==============*/
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
.image_container_wrsp{ height: inherit; max-height: 250px; overflow-y: auto; margin-right: 2%;}
.image_container_wrsp::-webkit-scrollbar {width: 12px; }
.image_container_wrsp::-webkit-scrollbar-track {-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); border-radius: 10px; }
.image_container_wrsp::-webkit-scrollbar-thumb {border-radius: 10px; -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5); }
.checkboxFive{position: absolute; color: red; font-size: 24px; margin-top: -31px; margin-left: 62%; }
.checkboxFive label {cursor: pointer; position: absolute; width: 25px; height: 25px; top: 0; left: 0; background: #69F; /*border:1px solid #137ec3;*/ }
.checkboxFive label:after {opacity: 0.2; content: ''; position: absolute; width: 9px; height: 5px; background: transparent; top: 6px; left: 7px; border: 3px solid #fff; border-top: none; border-right: none; -webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); -o-transform: rotate(-45deg); -ms-transform: rotate(-45deg); transform: rotate(-45deg); }
.checkboxFive label:hover::after {opacity: 0.5; }
.checkboxFive input[type=checkbox]:checked + label:after {opacity: 1; }
</style>
