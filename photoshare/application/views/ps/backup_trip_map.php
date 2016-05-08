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
 <header>
 <div class="container">
 <figure class="logo"><a href="index.html"><img src="<?php echo base_url();?>/images/logo.png" alt="Photo Sharing" title="Photo Sharing"></a></figure>
 <div class="menu">
 	<ul>
    	<li><a href="#">Sign Up</a></li>
        <li><a href="#">Explore</a></li>
        <li><a href="#">Create</a></li>
        <li><a href="#">Upload</a></li>
    </ul>
 </div>
 <div class="searchdiv">
 	<form name="searchform" method="post" action="">
    	<input name="search" type="text" class="input1" placeholder="Photos, people, or groups" required>
        <input name="submit" type="submit" class="search-submit" value="">
    </form>
 </div>
 <span class="log">
 <a href="#" title="Sign Up">Sign Up</a>
 <a href="#" title="Log In">Log In</a>
 </span>
 </div>
 </header>
 <div class="iframe-map1">
 <div class="iframe-map">

<input id="pac-input" class="controls" type="text" placeholder="Enter your address or placename or zipcode">
<div id="map-canvas" style="width:100%; height:680px;"></div>
<divi id="directionPanel" style="width:300px;  margin-left:550px; top:30px;"></div><!--position:absolute;-->
</div>
<div class="rightbarmain">
 	<div class="rightbar" style="height:587px;">
    <div class="covername">Poit this image to desired location
    (1) You can search your location then change the marker to arrange location
    </div>
<div style="padding:20px;width:320px;float:left;">
<?php
$im= $this->db->query("SELECT * FROM images WHERE id='".$this->uri->segment(4)."'");
 foreach($im->result_array() as $row){?>
<div class="image_container">
<img src="<?php echo base_url().'upload/'.$row['image_file'];?>" height="300" width="300"/><br />
<p id="msg" style="color:red;"></p>
<form method="post" action="<?php echo base_url();?>ps/pages/update_image/" id="sbmt">
<label>Image Title</label>
<input type="text" name="image_title" value="<?php echo $row['image_title'];?>" id="image_title" required/>
<p></p>
<label>Picture latitude</label>
<input type="text" name="latitude" value="<?php echo $row['latitude'];?>" id="latitude2"  readonly="readonly"/>
<p></p>
<label>Picture longitude</label>
<input type="text" name="longitude" value="<?php echo $row['longitude'];?>" id="longitude2"  readonly="readonly"/>
<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
<input type="submit" value="Point This Image" style="padding:10px;border:0px;background-color:#69F;margin-top:12px;" />
</form>
</div>
 <?php } ?>
 <div style="clear:both;"></div>
</div>
</div>
</div>
 </div>

</body>
</html>





 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&sensor=false"></script>
     <!--<script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
 <script>
 $(document).ready(function() {
    $('#sbmt').submit(function(kaushik){
		if($('#latitude2').val()=='' || $('#longitude2').val()=='' ){
		kaushik.preventDefault();
		$('#msg').html('Please Drag the map marker to select Longitude and Latitude of the image where you point.');
		}
		});
});
 </script>  

<script>

if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
      } else {
        error('not supported');
      }

      var directionDisplay;
      var directionsService = new google.maps.DirectionsService();
      var map;

     function success(position) {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var latlng = new google.maps.LatLng(28.6139,77.2090);
        var mapOptions = {
          zoom:15,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
          center: latlng
        }
        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById("directionPanel"));

        var start = "19.0759,72.8776";
        var end =  position.coords.latitude + ',' + position.coords.longitude;
        var mode;

        switch ( 'driving' )
        {
          case 'bicycling' :
            mode = google.maps.DirectionsTravelMode.BICYCLING;
            break;
          case 'driving':
            mode = google.maps.DirectionsTravelMode.DRIVING;
            break;
          case 'walking':
            mode = google.maps.DirectionsTravelMode.WALKING;
            break;
        }
        var request = {
            origin:start,
            destination:end,
            travelMode: mode
        };
        
        directionsService.route(request, function(response, status) {
          if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
          }
        });

      }

      function error(msg) {
        var s = document.querySelector('#status');
        s.innerHTML = typeof msg == 'string' ? msg : "failed";
        s.className = 'fail';
  
        console.log(arguments);
       }

</script>
<style>
.image_container{
	float:left;
	margin:3px;
	padding:3px;
	/*border:1px solid #66F;*/
	width:300px;
}
  html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
	  /*==============*/
	  .controls {
        margin-top: 16px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

 #latitude2,#image_title,#longitude2{
        background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 264px;
  height: 25px;
      }
     #pac-input {	  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 484px;
  height:33px;
	 
      }
	  #sbmt > label{
		  font-family: 'OpenSansBold';
  font-size: 16px;
  color: #fff;
	  }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }

      #target {
        width: 345px;
      }
    </style>