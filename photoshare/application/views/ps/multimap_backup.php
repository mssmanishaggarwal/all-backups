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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url();?>js/multi_map.js"></script>



<?php /*?><script src="<?php echo base_url();?>/src/skdslider.min.js"></script>
<link href="<?php echo base_url();?>/src/skdslider.css" rel="stylesheet"><?php */?>
	<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>-->
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        z-index: 5;
        /*background-color: #fff;*/
        padding: 5px;
        /*border: 1px solid #999;*/
      }



      #panel, .panel {
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }

      #panel select, #panel input, .panel select, .panel input {
        font-size: 15px;
      }

      #panel select, .panel select {
        width: 100%;
      }

      #panel i, .panel i {
        font-size: 12px;
      }
	   #mapname{
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
	  .disabledelete{
		  border: 0;
    background-color: #69F;
    color: white;
    padding: 5px;
	  }
	  .mark_this{
    background-color: #69F !important;
    color: white !important;
    padding: 5px !important;
	  }
	  .active_this{
		  background-color: white !important;
    color: #69F !important;
    padding: 5px !important;
	  }

    </style>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>    
<script>
var geocoder;
var map;
var markers = [];
var searchBox;
var input;
var disableListener=false;
var dragmarker=true;
function initialize() {
			geocoder = new google.maps.Geocoder();
     		map = new google.maps.Map(document.getElementById('map-canvas'),{
    		mapTypeId: google.maps.MapTypeId.ROADMAP,
			zoom: 1,
  			});
		
	

			  var defaultBounds = new google.maps.LatLngBounds(
			  new google.maps.LatLng(34.052235, -118.243683),
			  new google.maps.LatLng(25.799891182,-105.1171875));
			  map.fitBounds(defaultBounds);
			  var uniqueId = 1; 
			  google.maps.event.addListener(map, 'click', function(event) {
				  $('.setpoint').on('click',function(){
					dragmarker=false;
				});
				  if (disableListener && !dragmarker){
                       return;
			      }//Disabble Click on map
                
			  var image = new google.maps.MarkerImage('<?php echo base_url().'marker_images/';?>'+'icon_02.png');
					image.size = new google.maps.Size( 60, 60 );
					image.origin = new google.maps.Point( 0, 0 );
					image.scaledSize = new google.maps.Size( 60, 60 );
			  var marker = new google.maps.Marker({
				position: event.latLng,
				map: map,
				draggable: dragmarker,
				icon:image,
            });
		
            markers.push(marker);
            var bounds = new google.maps.LatLngBounds();
			google.maps.event.addListener(marker, 'dragend', function (evt) { 
			 if( !dragmarker){
					 return true;
				 }
            geocodePosition(marker.getPosition(),marker.id);
         
		 console.log(evt.latLng.lat());
	     $('#tab_'+marker.id).attr('data-lat',evt.latLng.lat());
		 $('#tab_'+marker.id).attr('data-lng',evt.latLng.lng());
          
         });
          // console.log(uniqueId);
	       google.maps.event.addListener(marker, "click", function (e) { 
		    if (disableListener){
                       return;
			      }
		   $('.setpoint').on('click',function(){
			   disableListener=true;
			   dragmarker=false;
                  if (!marker.index == 0){
                  marker.setMap(null);
				  }//Disabble Click on map
		   });
              var content = '<h3 class="hedaddr">Marking# '+marker.id+'</h3>';
			  	content +='<p id="addr_'+marker.id+'" class="addrl"></p>';
                content += "<input type = 'button' onclick = 'DeleteMarker(" + marker.id + ");' value = 'Delete' class='disabledelete'/>";
				
                var infoWindow = new google.maps.InfoWindow({
                    content: content,
					draggable: true,
                });
                infoWindow.open(map, marker);
				geocodePosition(marker.getPosition(),marker.id);
		$('.image_tabs').append('<span id="tab_'+marker.id+'" class="mark_this" data-markno="'+marker.id+'" data-lat="'+event.latLng.lat()+'" data-lng="'+event.latLng.lng()+'">Marker#'+marker.id+'</span>');
		/*$('.form_maker').append('<form id="form_'+marker.id+'" method="post"><input type="hidden" name="selected_images" id="selected_images_'+marker.id+'" value=""/><input type="hidden" name="latitude" value="" id="lat_'+marker.id+'" /><input type="hidden" name="longitude" value="" id="lng_'+marker.id+'" /><input type="submit" value="Submit_'+marker.id+'"/></form>');*/
				$('.setpoint').show();
				
				/*$('.image_tabs').after('<div id="#tabs-'+marker.id+'"><div id="trash" class="ui-widget-content ui-state-default"></div></div>');
				get_tab_active();*/
          });
		  
/*	google.maps.event.addListener(marker, 'dblclick', function(event) {
     return false;
});*/
			 
			//geocodePosition(marker.getPosition(),marker.id);
       //   console.log(event.latLng.lat());
		//  console.log(event.latLng.lng());
			marker.id = uniqueId;
            uniqueId++;
        });// end of click
  
       var input =(
       document.getElementById('pac-input'));
       var searchBox = new google.maps.places.SearchBox((input));
       google.maps.event.addListener(searchBox, 'places_changed', function() { //toggleBounce();
			var places = searchBox.getPlaces();
				if (places.length == 0) {
				  return;
				}
			for (var i = 0, marker; marker = markers[i]; i++) {
			  marker.setMap(null);
			}

    var bounds = new google.maps.LatLngBounds();
    for (var i = 0, place; place = places[i]; i++) {

      	bounds.extend(place.geometry.location);
    	}

    	map.fitBounds(bounds);
 	 });
  
	  google.maps.event.addListener(map, 'bounds_changed', function() {
		var bounds = map.getBounds();
		searchBox.setBounds(bounds);
	  });
  
 }


	

	function setAllMap(map) {
	  for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
		
	  }
	}


	function clearMarkers() {
	  setAllMap(null);
	}


	function deleteMarkers() {
	  clearMarkers();
	  markers = [];
	  $('.image_tabs').empty();
	 
	}


google.maps.event.addDomListener(window, 'load', initialize);



   function DeleteMarker(id) {
	   $('.image_tabs > span#tab_'+id).remove();
        //Find and remove the marker from the Array
        for (var i = 0; i < markers.length; i++) {
            if (markers[i].id == id) {
                //Remove the marker from Map                  
                markers[i].setMap(null);
 
                //Remove the marker from array.
                markers.splice(i, 1);
                return;
            }
        }
    }
	
   function geocodePosition(pos,idd) {
	  geocoder.geocode({
		latLng: pos
	  }, function(responses) {
		if (responses && responses.length > 0) {
			//console.log(responses[0].formatted_address);
			document.getElementById('addr_'+idd).innerHTML = 'Current Address : ' + responses[0].formatted_address ;
		  //updateMarkerAddress(responses[0].formatted_address);
		} else {
		  document.getElementById('current').innerHTML = '<p>Current Address : Not Found</p>';
		}
	  });
 }

    </script>

<script>
$(document).ready(function() {
    $(document).on('click','.mark_this',function(){
		$('.mark_this').removeClass('active_this');
		$('.check_mark').text($(this).data('markno'));
		$('#tab_'+$(this).data('markno')).addClass('active_this');
		/*$('#m >#m2 >#images').attr('data-marker',$(this).data('markno'));*/
		$('#m >#m2 >#images').val($(this).data('markno'));
		
		
		$('#m >#m2 >:checked').each(function() {
       $(this).removeClass();
     });
		//$('#m >#m2 >#images').removeClass();
		$('#m >#m2 >#images').addClass('im_'+$(this).data('markno'));
		$('#lat_'+$(this).data('markno')).val($(this).data('lat'));
	    $('#lng_'+$(this).data('markno')).val($(this).data('lng'));
		updateTextArea($(this).data('markno'));
	});
	/*$(document).each('click','.mark_this',function(){
		
		 document.getElementById('lat').value=$(this).data('lat');
		  document.getElementById('lng').value=$(this).data('lng');
	});*/
	 /*$(document).one('click','.mark_this',function(){
	  $('#sbmt').append('<input type="hidden" name="lat" value="'+$(this).data('lat')+'"/>'); 
	  $('#sbmt').append('<input type="hidden" name="lng" value="'+$(this).data('lng')+'"/>'); 
	 });*/
	$(document).on('click','.disabledelete',function(){
		  if($('.mark_this').length==0){
	                	$('.setpoint').hide();
          }
	})
	
	$('#m >#m2 >input[type=checkbox]').on('click',function(pro){ 
			if($(this).val()==''){
				$('#msg').html('Please choose atleast one marker tab at a time, then choose images.');
				pro.preventDefault();
				$(this).prop('checked',false);
			}else{
				$('#msg').html('');
				if ($(this).is(':checked')) {
					/*$('#m >#m2 >.show_'+$(this).data('id')).html($(this).data('marker')).show(); */
					$('#m >#m2 >.show_'+$(this).data('id')).html($(this).val()).show(); 
					$(this).prop('checked',true);
				}else{
					$(this).prop('checked',false);
					$('#m >#m2 >.show_'+$(this).data('id')).empty().hide();
				}
			}
		});
	$(document).on( 'click','.setpoint',function(){
		if($('.pr').val()==''){ 
			$('#msg').html('Please set Map Name first.');
		}else{
			$('#msg').html('');
			$('.disabledelete').hide();
			$('.pr').prop('disabled',true);
			//$('.leb').hide();
			$('#panel').hide();
			$('#m > #m2 >#images').show();
			$('#map-canvas').unbind( "click" );
			$('#pac-input').hide();
			$('#final_pointing').show();
			$(this).hide();
			$.ajax({
						  url: '<?php echo base_url();?>ps/pages/insert_blank/',
						  type: 'POST',
						  success: function(data){
										$('.insert_id').html(data);
						  }
			});
		}
  
    });
	
	$('#m >#m2 >input[type=checkbox]').click(function(){   
			  var param=[];
			 param={'parentr':$('.insert_id').html(),
			 'latitude':$('.active_this').data('lat'),
			 'longitude':$('.active_this').data('lng'),
			 'image_file':$(this).data('image'),
			 'name':$('.pr').val()};
			 console.log(param);
			 	$.ajax({
                      url: '<?php echo base_url();?>ps/pages/add_images_multi/?id='+JSON.stringify(param),
                      type: 'POST',
                      success: function(data){
						 $('.next_page').attr('href','<?php echo base_url();?>ps/pages/view_multi_map/'+data);
					  }
		         });
			 });
	
	
});
	

  
  function updateTextArea(id) {  
		 $('#m >#m2 >input[type=checkbox]').click(function(){       
			 var allVals = [];
			 $('#m >#m2 >.im_'+id+':checked').each(function() {
			   allVals.push($(this).data('image'));//$(this).removeClass('.im_'+id);
			 
			 $('#selected_images_'+id).val(allVals);
			 	
				 $(this).hide();
			  });
		 });
  }
  

</script>
  
</head>

<body >
<?php $this->load->view('header_menu');?>
 <div class="iframe-map1">
 <div class="iframe-map">

  <div id="panel">
      <input onclick="deleteMarkers();" type=button value="Delete All Markers" class="mrkt">
    </div>
<div id="map-canvas" style="width:100%; height:680px;"></div>
</div>
<div class="rightbarmain">
 	<div class="rightbar" style="height:587px;">
    <div class="covername"></div>
    <div class="covername">Search to get location, Then place marker by clicking on map, after place marker click on marker</div>
    <span class="setpoint">I have done with Marker</span>
    <p id="msg" style="color:white;margin-top: 18px;"></p>
<div style="padding:5px;width:320px;float:left;margin-top:10px;">
<div class="image_tabs"></div>

<hr>
<!--<input type="button" value="Save Waypoints" onClick="save_waypoints();" style="padding:10px;border:0px;background-color:#69F;color:#FFF;">-->
 

<div style="clear:both;"></div>
<div class="insert_id" style="display:none;"></div>
<form action="<?php echo base_url();?>ps/pages/multi_map/" id="makeform"/>
<div class="====image_container" id="m" style="height: 289px; overflow-x: auto;display:block;width: 94%;margin-left:10px;">
<?php
$count=1;
$im= $this->db->query("SELECT * FROM images");
 foreach($im->result_array() as $row){?>
<div class="image_container" id="m2">
<img src="<?php echo base_url().'upload/'.$row['image_file'];?>" height="80" width="80"/><br />
<input name="image" type="checkbox" value="" id="images" data-marker="" data-id="<?php echo $count; ?>" data-image="<?php echo $row['image_file'];?>" style="display:none;">
<span class="numbering show_<?php echo $count; ?>" style="display:none;"></span>
</div>
 <?php $count++;} ?><i class="check_mark"></i>
 <div style="clear:both;"></div>
</div>
</form>
<label style="padding-left:12px;font-family: 'OpenSansBold';
    font-size: 16px;
    color: #fff;" class="leb">Map Name</label>
<input type="text" name="name" id="mapname start_point" class="pr" value="" style="background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 264px;
    height: 25px;"/>
<div class="form_maker"></div>
</br>

<a href="<?php echo base_url();?>ps/pages/view_multi_map/" class="next_page"><input type="submit" name="final_pointing" value="Finished Selecting Photos" id="final_pointing" style="padding:10px;border:0px;background-color:#69F;margin-top:12px;display:none;color: white;" /></a>

<input id="pac-input" class="controls" type="text" placeholder="Enter your address or placename or zipcode" autocomplete="off" style="z-index: 0; position: absolute; left: 0px; top: 0px; width: 321px;">
<div id="current" class="covername"></div>


<!--======================-->
 <div style="clear:both;"></div>
</div>
</div>
</div>
 </div>

</body>
</html>
    <?php
	$count=0;
$im= $this->db->query("SELECT * FROM `waypoints` WHERE  id='".$this->uri->segment(4)."'");
 foreach($im->result_array() as $row){
	//echo '<pre>'; 
	 $obj=json_decode($row['waypoints']);
	$waypoints=$obj->waypoints;
	 //print_r($obj->waypoints);
	//echo '</pre>'; 
$count++; }/*echo count($obj->start);echo $count;*/?>



<style>
#flupload,.flu_but{
padding:10px;border:0px;background-color:#69F;color:#FFF;
margin-top:20px;
}

.image_container{
	margin: 3px !important;
    padding: 3px !important;
    border: 1px solid #66F !important;
    width: 80px !important;
    position: relative;
    float: left;
	background-color:white;
}
.mark_this{
	background-color:white;
	color:red;
	/*border:1px solid yellow;*/
	margin:2px;
	cursor: pointer;
}
.image_tabs{
	    width: 330px !important;
    overflow-y: auto;
}
.setpoint{
	display:none;
	padding: 10px;
    background-color: #69F;
	padding: 10px;
	cursor:pointer;
	color:white;
	margin-left: 14px;
}
.active_this{
	background-color:blue;
	color:white;
	border:1px solid yellow;
	margin:2px;
	cursor: pointer;
}
.numbering{
	opacity: 0.7;
    padding: 10px 15px 10px 15px;
    border-radius: 25px 25px 25px 25px;
    background-color: #69F;
    position: absolute;
    margin-top: -66px;
    color: white;
    font-size: 19px;
    font-weight: bold;
    margin-left: 20px;
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
	  .mrkt{
		      border: 0;
    background-color: #69F;
    color: white;
    padding: 10px;
	  }

.image_container > input[type=checkbox]{
		    position: absolute;
  margin-top: -20px;
  margin-left: 5px;
}
.labels{
	background-color:white;
	padding:20px;
	width:10px;
}
.addrl{
	width:150px;
}
.hedaddr{
	    font-weight: bold;
}
.check_mark{
	display:none;
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

  #gallery { /*float: left;*/ width: 100%; min-height: 12em; }
  .gallery.custom-state-active { background: #eee; }
  .gallery li { float: left; width: 78px; padding: 0.4em; margin: 0 0.4em 0.4em 0; text-align: center; }
  .gallery li h5 { margin: 0 0 0.4em; cursor: move; }
  .gallery li a { float: right; }
  .gallery li a.ui-icon-zoomin { float: left; }
  .gallery li img { width: 100%; cursor: move; }
 
  #trash { width: 96%;
    height: 10em;
    padding: 1%;
    margin-top: 40px;
    overflow-x: auto; }
  #trash h4 { line-height: 16px; margin: 0 0 0.4em; }
  #trash h4 .ui-icon { float: left; }
  #trash .gallery h5 { display: none; }
  
    
#images{
	z-index:10000;
}
/*=========================*/

    </style>
