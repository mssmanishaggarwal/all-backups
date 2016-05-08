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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
<!--<script src="json2.js"></script>-->
<script>
var geocoder;
var map, ren, ser;
var data = {};
geocoder = new google.maps.Geocoder();
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
		//call_to_marker(rleg.start_location.A-0.005,rleg.start_location.F-0.005)	
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
	console.log( ren.directions.routes[0].legs[0]);
	var str = JSON.stringify(data);
    //alert(str);
	document.getElementById('waypoints').value=str;	
  /*=====================*/
	/*var jax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	jax.open('POST','process.php');
	jax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	jax.send('command=save&mapdata='+str)
	jax.onreadystatechange = function(){ if(jax.readyState==4) {
		if(jax.responseText.indexOf('bien')+1)/*alert('Updated')*/;
		/*else alert(jax.responseText)
	}}*/
	
		
	//call();
}

<?php /*?>function call_to_marker(latty,longy){

 var image = new google.maps.MarkerImage('<?php echo base_url().'marker_images/';?>'+'marker.jpg');
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
    document.getElementById('latitude2').value=evt.latLng.A.toString();
	document.getElementById('longitude2').value=evt.latLng.F.toString();
	///document.getElementById('current').innerHTML = '<p>Current Address : ' + addr  + '</p>';
});

google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
    document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
});

map.setCenter(myMarker.position);
myMarker.setMap(map);

   }<?php */?>

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
</script>

 <script>
 $(document).ready(function() {
   /* $('#sbmt').submit(function(kaushik){  
	kaushik.preventDefault();
	$('#sbmt').submit();
	});*/
		$('#map_point').submit(function(k){ k.preventDefault();});
		

});	
		

/*$(document).each(function(index, element) {
    	$('#images').click(function(){
		var checkedValues = $('input:checkbox:checked').map(function() {
          console.log(this.value);
         }).get();
       });
});*/
/*function updateTextArea() {         
     var allVals = [];
     $('#m >#m2 :checked').each(function() {
       allVals.push($(this).val());
     });
     document.getElementById('selected_images').value=allVals;
  }
 $(function() {
   $('#m >#m2 input').click(updateTextArea);
   updateTextArea();
 });*/
 </script> 
</head>

<body onLoad="goma()">
 <?php $this->load->view('header_menu');?>
 <div class="iframe-map1">
 <div class="iframe-map">


<div id="mappy" style="width:100%; height:680px;"></div>
<div id="directionsPanel" style="width:30%;height 100%"></div>
</div>
<div class="rightbarmain">
 	<div class="rightbar" style="height:587px;">
    <div class="covername">This is a Trip Map</div>
    <div class="covername">Choose a starting and ending location, you can edit the directions by dragging and dropping in the map.</div>
<?php $tm=$this->session->userdata('selected_images');
//echo '<pre>';
//print_r($tm);
//echo '</pre>';
if(!isset($tm['image_id'])){
  //echo '<script>alert("You have not select any image to carry on Trip On Map")</script>';
  redirect(base_url().'ps/pages/add_images');
  //echo "<meta http-equiv='refresh' content='0;url='localhost/photoshare/ps/pages/add_images'>";
}
?> 
<div style="padding:20px;width:320px;float:left;">
<form id="map_point" method="post" action="<?php echo base_url();?>ps/pages/set_trip/">
<label style="padding-left:12px;">Start Point</label>
<input type="text" name="start_point" id="start_point" value="los angeles" required/><br>
<label style="display:none;">End Point</label>
<input type="text" name="end_point1" id="end_point1" value="mumbai" style="display:none;"/><br>
<label style="padding-left:12px;">End Point</label>
<input type="text" name="end_point2" id="end_point2" value="new york" required/><br>
<br>
<p></p>
<input type="submit" value="Set Location" onClick="goma()" style="padding:10px; margin:0 0 15px 13px; border:0px;background-color:#69F;color:#FFF;"/>
</form>
<form id="sbmt" method="post" action="<?php echo base_url();?>ps/pages/set_trip/">
<label style="padding-left:15px;">Trip Name</label>
<input type="text" name="trip_name" id="trip_name" value="" required/><br>
<input type="hidden" name="waypoints" id="waypoints" value=""/>
<input type="submit" value="Save Trip Route" onClick="save_waypoints();" style="padding:10px; margin:15px 0 0 13px; border:0px;background-color:#69F;color:#FFF;">
</form>
<br>
<hr>

<div style="clear:both;"></div>
<div class="====image_container" id="m" style="height: 250px; overflow-x: auto;">

<?php
/*$im= $this->db->query("SELECT * FROM images");
 foreach($im->result_array() as $row){?>
<div class="image_container" id="m2">
<img src="<?php echo base_url().'upload/'.$row['image_file'];?>" height="80" width="80"/><br />

    <input name="image" type="checkbox" value="<?php echo $row['image_file'];?>" id="images">
</div>
 <?php } */?>
<br />
<div style="clear:both;"></div>

</div>
<p id="msg" style="color:red;"></p>
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
	//echo '<pre>';  
	//print_r($_POST);
	//$images=explode(',',$_POST['selected_images']);
	//print_r($images);
	//echo '<pre>';
$session_data=$this->session->userdata('logged_in');
	$datanew = array(
							'trip_name'=>$_POST['trip_name'],
						  'waypoints'=>$_POST['waypoints'],
              'user_id'=>$session_data['user_id']
						  );
	$this->db->insert('waypoints', $datanew);  
	$insert_id=$this->db->insert_id();
	

	redirect(base_url().'ps/pages/set_images/'.$insert_id);

	/*echo("INSERT INTO `waypoints` ('image_file','latitude','longitude','waypoints')VALUES
	 ('".$_POST['selected_images']."','".$_POST['waypoints']."','".$_POST['latitude']."','".$_POST['longitude']."')");*/
}
?>
<?php /*?><form method="post" action="http://localhost/photoshare/ps/pages/set_trip/" id="sbmt">
<!--<label>Image Title</label>
<input type="text" name="image_title" value="<?php //echo $row['image_title'];?>" id="image_title" required/>-->
<p></p>
<input type="hidden" name="selected_images" id="selected_images" value=""/>
<input type="hidden" name="waypoints" id="waypoints" value=""/>
<!--<input type="submit" name="individual_pointing" value="Point This/Those Image" style="padding:10px;border:0px;background-color:#69F;margin-top:12px;" />-->
<input type="submit" name="final_pointing" value="I have done it." style="padding:10px;border:0px;background-color:#69F;margin-top:12px;" />
</form><?php */?>
 <div style="clear:both;"></div>
</div>
</div>
</div>
 </div>

</body>
</html>


<style>
#flupload,.flu_but{
padding:10px;border:0px;background-color:#69F;color:#FFF;
margin-top:20px;
}
.image_container{
	float:righ !important;
	margin:3px !important;
	padding:3px !important;
	border:1px solid #66F !important;
	width:80px !important;
	position:relative;
	float:left;
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

 #latitude2,#image_title,#longitude2,#start_point,#end_point2,#trip_name{
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
	  #sbmt,#map_point > label{
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
.image_container > input[type=checkbox]{
		    position: absolute;
  margin-top: -20px;
  margin-left: 5px;
}
    </style>
    