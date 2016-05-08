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
   <script src="<?php echo base_url();?>/src/skdslider.min.js"></script>
<link href="<?php echo base_url();?>/src/skdslider.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>
    <script>

<?php
$session_data = $this->session->userdata('logged_in');
$im = $this->db->query("SELECT * FROM simple_map  WHERE id='" . $this->uri->segment(4) . "' AND user_id='" . $session_data['user_id'] . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {
	?>
var berlin = new google.maps.LatLng(<?php echo $row['latitude'];?>, <?php echo $row['longitude'];?>);
<?php }
?>
var neighborhoods = [
<?php
$im = $this->db->query("SELECT * FROM simple_map  WHERE id='" . $this->uri->segment(4) . "' AND user_id='" . $session_data['user_id'] . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {
	?>
  new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>),
  <?php }
?>
];

var pin_images=[
<?php
$im = $this->db->query("SELECT * FROM simple_map WHERE id='" . $this->uri->segment(4) . "' AND user_id='" . $session_data['user_id'] . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {
	$im = $this->db->query("SELECT * FROM images  WHERE id IN(" . $row['image_file'] . ")");
	$k = $im->result_array();
	foreach ($im->result_array() as $row) {
		?>
  '<?php echo $row['image_file'];?>',
  <?php }}
?>
];

var pop_image=[
<?php
$im = $this->db->query("SELECT * FROM simple_map WHERE id='" . $this->uri->segment(4) . "' AND user_id='" . $session_data['user_id'] . "'");
$k = $im->result_array();
foreach ($im->result_array() as $row) {
	/*$im= $this->db->query("SELECT * FROM images  WHERE id IN(".$row['image_file'].")");
	$k=$im->result_array();
	foreach($im->result_array() as $row){*/?>
  '<h3><?php echo 'Test Here';?></h3><hr><ul id="demo"><?php $ir = $this->db->query("SELECT * FROM images  WHERE id IN(" . $row['image_file'] . ")");
	foreach ($ir->result_array() as $row) {
		$imgel = '<li><img src="' . base_url() . 'upload/' . $row['image_file'] . '" height="200" width="200"/></li>';
		echo $imgel;
	}
	?></ul>',
 <?php /*}*/}
?>
];
//alert(pop_image);
var markers = [];
var map;

function initialize() {
  var mapOptions = {
    zoom: 6,
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
        new google.maps.Point(38, 38));

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
    labelText: "<img src='"+image.url+"' height='42' width='65'/>",
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

    jQuery('#demo').skdslider({delay:5000, animationSpeed: 2000,showNextPrev:true,autoSlide:false,animationType:'fading'});
   });
}
  /*=====================*/

/*function clearMarkers() {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(null);
  }
  markers = [];
   }*/

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
            <div class="right-button"><a href="#"><img src="<?php echo base_url();?>/images/edit.png" alt=""></a>
             <a href="#"><img src="<?php echo base_url();?>/images/drop.png" alt=""></a> <a href="#">
             <img src="<?php echo base_url();?>/images/enlarge.png" alt=""></a> <a href="#"><img src="<?php echo base_url();?>/images/cross.png" alt=""></a></div>

        <!--=========Simple Map List==================-->
        <div class="covername">Saved Simple Map</div>
        <div class="wrl">
            <?php
$session_data = $this->session->userdata('logged_in');
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
$im = $this->db->query("SELECT DISTINCT `name`,`parent` FROM `multimap` WHERE `parent`!=0 AND user_id='" . $session_data['user_id'] . "'");
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
        </div>





       </div>

    </div>
 </div>
 </div>

</body>
</html>
<!-- ====Simple Map Js Script========== -->
<script type="text/javascript">
  $(document).on('click','.bot',function(e){ e.preventDefault();
    if(confirm('Sure to delete this image?')){
        $(this).hide();
        $('#hid_'+$(this).data('del')).hide();
        $.ajax({
                      url: '<?php echo base_url();?>'+'ps/pages/delete_unset_image/'+$(this).data('id')+'/',
                      type: 'GET',
                      success: function(data){
                        if(data=='success'){
                          window.location='<?php echo base_url();?>'+'ps/pages/view_simple_map';
                        }
                      }
                  });
    }
  });
</script>
<!-- ====Multi Map Js Script========== -->
<script type="text/javascript">
  $(document).on('click','.boty',function(e){ e.preventDefault();
    if(confirm('Sure to delete this image?')){
        $(this).hide();
        $('#hid_'+$(this).data('del')).hide();
        $.ajax({
                      url: '<?php echo base_url();?>'+'ps/pages/multiimage_unset_image/'+$(this).data('id')+'/',
                      type: 'POST',
                      success: function(data){
                        if(data=='success'){
                          window.location='<?php echo base_url();?>'+'ps/pages/view_simple_map';
                        }
                      }
                  });
    }
  });
</script>
<!-- ====Trip Map Js Script========== -->
<script type="text/javascript">
  $(document).on('click','.del_img',function(e){ e.preventDefault();
    if(confirm('Sure to delete this trip?')){
        $(this).hide();
        $('#hid_'+$(this).data('del')).hide();
        $.ajax({
                      url: '<?php echo base_url();?>'+'ps/pages/del_trip/'+$(this).data('id')+'/',
                      type: 'GET',
                      success: function(data){
                        if(data=='success'){
                          window.location='<?php echo base_url();?>'+'ps/pages/view_trip/';
                        }
                      }
                  });
    }
  });
</script>

<style>
      html, body, #map-canvas {
      /* height: 100%;
     margin: 0px;
        padding: 0px*/
      }
      .wrl{
        position: relative;
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
    .gm-style-iw{
      left:25px !important;
    }
    .gmnoprint{
      border:3px solid white;
    }
    .plex{
      margin-bottom: 5px;padding:10px;border:0px;background-color:#69F;color:#FFF;
    }
    .labels{
    background-color:white !important;
    padding:2px 2px 0px 2px  !important;
        border-radius: 3px;
      /*box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);*/
      background: url(../images/arrow.png) no-repeat top left;
    }

    </style>

