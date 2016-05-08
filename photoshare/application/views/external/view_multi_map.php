<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Photo Sharing</title>
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
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
<!--<script src="js/jquery-1.11.0.min.js"></script> -->
   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>
    <script src="<?php echo base_url();?>/src/skdslider.min.js"></script>
<link href="<?php echo base_url();?>/src/skdslider.css" rel="stylesheet">

<script>


var berlin = new google.maps.LatLng(45.460131, 24.147949);

var neighborhoods = [
<?php
$im = $this->db->query("SELECT  multimap.*
FROM    multimap
        JOIN ( SELECT   MAX(id) AS id
               FROM     multimap
               GROUP BY latitude
               HAVING   COUNT(*) >= 1
             ) parent ON parent.id = multimap.id WHERE parent='" . $map_id . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {?>
  new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>),
  <?php }
?>
];

var pin_images=[
<?php
$im = $this->db->query("SELECT  multimap.*
FROM    multimap
        JOIN ( SELECT   MAX(id) AS id
               FROM     multimap
               GROUP BY latitude
               HAVING   COUNT(*) >= 1
             ) parent ON parent.id = multimap.id WHERE parent='" . $map_id . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {?>
  '<?php echo $row['image_file'];?>',
  <?php }
?>
];

var pop_image=[
<?php
$im = $this->db->query("SELECT  multimap.*
FROM    multimap
        JOIN ( SELECT   MAX(id) AS id
               FROM     multimap
               GROUP BY latitude
               HAVING   COUNT(*) >= 1
             ) parent ON parent.id = multimap.id WHERE parent='" . $map_id . "'");
$k = $im->result_array();
$c = 0;
foreach ($im->result_array() as $row) {
	$name = $row['name'];
	$ir = $this->db->query("SELECT * FROM `multimap` WHERE `latitude`='" . $row['latitude'] . "' AND `longitude`='" . $row['longitude'] . "' AND parent='" . $map_id . "'");
	$da = $ir->num_rows(); //echo $da;?>
  '<h3><?php echo $name;?></h3><hr><ul <?php if ($da > 1) {?>id="demo<?php echo $c;?>"<?php }
	?>><?php
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

function initialize() {
  var mapOptions = {
    zoom: 2,
    center: berlin,
	mapTypeId: google.maps.MapTypeId.ROADMAP,
	mapTypeControl: false
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
          mapOptions);
  }

var pinImage = new google.maps.MarkerImage("<?php echo base_url() . 'images/down_arrow.png';?>",
                new google.maps.Size(38, 38),
                new google.maps.Point(0,0),
                new google.maps.Point(38, 38)
                );

function drop() {
  //clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
   // addMarkerWithTimeout(neighborhoods[i], i * 200,i);
	//popit_out(marker,i);
	//var newIcon = MapIconMaker.createMarkerIcon({width: 20, height: 34, primaryColor: "#0000FF", cornercolor:"#0000FF"});
	  var image = new google.maps.MarkerImage('<?php echo base_url() . 'upload/';?>'+pin_images[i]);
			image.size = new google.maps.Size( 25, 25 );
			image.origin = new google.maps.Point( 0, 0 );
			image.scaledSize = new google.maps.Size( 25, 25 );
    var marker = new MarkerWithLabel({
      position: neighborhoods[i],
      map: map,
	  /*animation: google.maps.Animation.DROP,
	icon:false,
	    strokeOpacity:1,*/
	  labelText: "<img src='"+image.url+"' height='60' width='89'/>",
       labelClass: "labels", // the CSS class for the label
       labelStyle: {top: "-48px", left: "-35px", background:"#fff"},
       labelVisible: true
    });

   // marker.setTitle((i + 1).toString());
    attachSecretMessage(marker, i);

    }
	console.log(image);
 }


 /*======================*/
function attachSecretMessage(marker, num) {
 // var pop_image = ['This', 'is', 'the', 'secret', 'message'];
  var infowindow = new google.maps.InfoWindow({
    content: pop_image[num]
  });

  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(marker.get('map'), marker);
  });



 google.maps.event.addListener(infowindow, 'domready', function(){

	  jQuery('#demo'+num).skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,autoSlide:false,animationType:'fading'});
   });
 //alert(num);
}


google.maps.event.addDomListener(window, 'load', initialize);


    </script>
</head>

<body onLoad="drop();">
<?php $this->load->view('header_menu');?>
 <div class="iframe-map1">
 <div class="iframe-map">


<div style="padding:00px;">


    <div id="map-canvas" style="width: 100%; height:600px;"></div>


</div>
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
<?php /* ?>
<div class="covername">Saved Simple Map</div>
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
style="margin-left:105px;margin-top:0px;" class="plex"></a>
<a href="" class="del_img" data-del="<?php echo $count;?>" title="DELETE" data-id="<?php echo $row['id'];?>">
x</a>
</span>
</br>
<?php $count++;}
?>
</div><?php */?>




        </div>
    </div>
 </div>
 </div>

</body>
</html>

<style>
html, body, #map-canvas {/* height: 100%; margin: 0px; padding: 0px*/ }
#panel {position: absolute; top: 5px; left: 50%; margin-left: 180px; z-index: 5; background-color: #fff; padding: 5px; border: 1px solid #999; }
.gm-style-iw{left:25px !important; }
.gmnoprint{border:3px solid white; }
.labels{background-color:white !important; padding:2px 2px 0px 2px  !important; border-radius: 3px; /*box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);*/ background: url(../images/arrow.png) no-repeat top left; }
.wrl{position: relative; }
.bot{color: red !important; font-size: 18px !important; position: absolute; font-weight: bold; margin-left: -19px; }
.plex{margin-bottom: 5px;padding:10px;border:0px;background-color:#69F;color:#FFF; }
.labels{background-color:white !important; padding:2px 2px 0px 2px  !important; border-radius: 3px; /*box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);*/ background: url(../images/arrow.png) no-repeat top left; }
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
</style>

