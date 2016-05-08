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
    <script>


var berlin = new google.maps.LatLng(45.460131, 24.147949);

var neighborhoods = [
<?php
$im= $this->db->query("SELECT * FROM images  WHERE latitude!='' AND longitude!=''");
$k=$im->result_array();
 foreach($im->result_array() as $row){?>
  new google.maps.LatLng(<?php echo $row['latitude'];?>,<?php echo $row['longitude'];?>),
  <?php } ?>
];

var pin_images=[
<?php
$im= $this->db->query("SELECT * FROM images WHERE latitude!='' AND longitude!=''");
$k=$im->result_array();
 foreach($im->result_array() as $row){?>
  '<?php echo $row['image_file'];?>',
  <?php } ?>
];

var pop_image=[
<?php
$im= $this->db->query("SELECT * FROM images  WHERE latitude!='' AND longitude!=''");
$k=$im->result_array();
 foreach($im->result_array() as $row){?>
  '<h3><?php echo $row['image_title'];?></h3><hr><img src="<?php echo base_url().'upload/'.$row['image_file'];?>" height="200" width="200"/>',
 <?php } ?>
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

    var pinImage = new google.maps.MarkerImage("<?php echo base_url().'images/down_arrow.png';?>",
        new google.maps.Size(38, 38),
        new google.maps.Point(0,0),
        new google.maps.Point(38, 38));

function drop() {
  //clearMarkers();
  for (var i = 0; i < neighborhoods.length; i++) {
   // addMarkerWithTimeout(neighborhoods[i], i * 200,i);
	//popit_out(marker,i);
	//var newIcon = MapIconMaker.createMarkerIcon({width: 20, height: 34, primaryColor: "#0000FF", cornercolor:"#0000FF"});
	        var image = new google.maps.MarkerImage('<?php echo base_url().'upload/';?>'+pin_images[i]);
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
                    Gary Seloff
                </div>
                <div class="righttop-right"><a href="#">Logout</a></div>
            </div>
            <div class="right-button"><a href="#"><img src="<?php echo base_url();?>/images/edit.png" alt=""></a>
             <a href="#"><img src="<?php echo base_url();?>/images/drop.png" alt=""></a> <a href="#">
             <img src="<?php echo base_url();?>/images/enlarge.png" alt=""></a> <a href="#"><img src="<?php echo base_url();?>/images/cross.png" alt=""></a></div>
            <div class="covername">Upload Images<!--to the Gallery--></div>
            <!--<div class="choosename">CHOOSE A TYPE OF ALBUM</div>-->
            <!--<div class="namediv">
            	<div class="namediv1">
                	<div class="tripbuttn"><a href="#">Trip</a></div>
                </div>
                <div class="namediv2">
                	<div class="tripbuttn"><a href="#">Map</a></div>
                </div>
            </div>
            <div class="buttndiv1">
            	<div class="tripbuttn"><a href="#">Multi Map</a></div>
            </div>-->
            <a href="<?php echo base_url();?>ps/pages/add_images/" style="margin-left:105px;margin-top:0px;">
        <input type="button" value="Add Images" style="padding:10px;border:0px;background-color:#69F;color:#FFF;"></a>
       <h1 class="covername">All Images</h1> 
        <div class="wrl">
            <?php
                $count=1;
                $im= $this->db->query("SELECT * FROM images  WHERE latitude!='' AND longitude!=''");
                $k=$im->result_array();
               foreach($im->result_array() as $row){?>
          <span class="innerw">
<img src="<?php echo base_url().'upload/'.$row['image_file'];?>" height="50" width="50" id="hid_<?php echo $count;?>"/>
          <a href="" class="bot" title="DELETE" data-id="<?php echo $row['id'];?>" data-del="<?php echo $count;?>">x</a></span>
               <?php $count++;} ?>
        </div>

       </div>

    </div>
 </div>
 </div>

</body>
</html>
<script type="text/javascript">
  $(document).on('click','.bot',function(e){ e.preventDefault();
    if(confirm('Sure to delete this image?')){
        $(this).hide();
        $('#hid_'+$(this).data('del')).hide();
        $.ajax({
                      url: '<?php echo base_url();?>'+'ps/pages/del_single/'+$(this).data('id')+'/',
                      type: 'GET',
                      success: function(data){
                        if(data=='success'){
                          window.location='<?php echo base_url();?>'+'ps/pages/about';
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
	  .labels{
		background-color:white !important;
		padding:2px 2px 0px 2px  !important;  
		    border-radius: 3px;
			/*box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.5);*/
			background: url(../images/arrow.png) no-repeat top left;
	  }
		  
    </style>
 
