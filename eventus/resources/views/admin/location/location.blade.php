@extends('layouts.backend')
@section('content')
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
        <div id="main">
            <form id="location_form" name="location_form" method="POST" class="form-horizontal">
            <input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
            <input type="hidden" name="id" id="id" value="{{$data['id']}}">
            <div class="box box-warning">

            <div class="box-header with-border">
                  <h3 class="box-title"> {{ $data['subHeading'] }}</h3>                  
                </div>
                <div class="box-body">
				<!--<div class="form-group">
					<label class="col-sm-2 text-right">Province <span class="text-red">*</span></label>
					<div class="col-sm-4">							
                                    <select name="province" id="province" class="form-control">
										<option>Select</option>
										@foreach($data['province'] as $prov)
											<option id="{{$prov->id}}">{{$prov->province_name}}</option>
										@endforeach
									</select>
                                </div>
				</div>-->					
                    @for($i=0; $i < count($data['language']); $i++)
                    <div class="form-group">
               <label class="col-sm-2 text-right">{{$data['language'][$i]->lang_name}} Name <span class="text-red">*</span></label>
                <div class="col-sm-4"> <input type="text" class="form-control" name="location_name_{{$data['language'][$i]->id}}" id="location_name_{{$data['language'][$i]->id}}" value="{{ isset($data['dataset'][$i]->location_name)?$data['dataset'][$i]->location_name:''}}" maxlength="50" /></div>
                </div> 					            
                    @endfor
                    
                    <div class="form-group">
									<label class="col-sm-2 text-right">Set Location <span class="text-red">*</span></label>
									<div class="col-sm-4">
										<a class="orange" data-toggle="modal" href='#modal-id'>Click</a>
									</div>
								</div>
                <div class="form-group">
                    <label class="col-sm-2 text-right">Latitude<span class="text-red">*</span></label>
                    <div class="col-sm-4"><input type='text' class="form-control" name="location_lat" id="lat" value="{{isset($data['dataset'][0]->location_lat)?$data['dataset'][0]->location_lat:''}}" />
                		</div>
								</div>
                <div class="form-group">
                    <label class="col-sm-2 text-right">Longitude<span class="text-red">*</span></label>
                    <div class="col-sm-4"><input type='text' class="form-control" name="location_lng" id="lng" value="{{isset($data['dataset'][0]->location_lng)?$data['dataset'][0]->location_lng:''}}" />
                		</div>
								</div>
                    <div class="form-group">
               <label class="col-sm-2 text-right">Is Active</label>
                            <div class="col-sm-4">							
                                    <input type="checkbox" value="{{isset($data['dataset'][0]->is_active)?$data['dataset'][0]->is_active:1}}" class="" name="is_active" id="is_active" {{isset($data['dataset'][0]->is_active)?($data['dataset'][0]->is_active)?'checked="checked"':'':'checked="checked"'}} />
                                </div>
                            </div> 
            </div>
        
            
               
           <div class="box-footer text-right">
          
          		
							@if($data['todo']=='saverec')
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateLocation('{{ url('/admin/location')}}/{{ $data['id']}}','location_form','{{ url('/admin/location_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@else
							<button type="submit" class="btn btn-primary add_more_button add_contact" onclick="updateLocation('{{ url('/admin/location')}}','location_form','{{ url('/admin/location_list')}}')" ><span class="fa fa-save fa-fw"></span>{{ $data['saveBtn'] }}</button>
							@endif
							
                            <button type="button" onclick="document.location.href='{{ url('/admin/location_list') }}'" class="btn btn-default "><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                  	</div>
					</div>
            </form> 
						<div class="modal fade" id="modal-id">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close map_reset" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Set Location</h4>
            <small>First Search your location from search bar, then drag the map marker to exact location.</small>
          </div>
          <div class="modal-body">
          <input id="pac-input" class="controls form-control" type="text" style="width:65%;z-index: 50003;display: block !important;" placeholder="Enter your address or placename or zipcode">

            <div class="map-div">
              <div id="map-canvas" style="width:100%; height:380px;"></div>
            </div>
            <div class="post-map">
              <div id="hall_lat"></div>
              <div id="hall_lng"></div>
              <div id="current_addr"></div>
            </div>
            <div class="clear"></div>
           



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary map_reset">Set Location</button>
          </div>
        </div>
      </div>
    </div>           
        </div>
				<style type="text/css">
	    .pac-container .pac-logo{
	      display:block !important;
	      z-index:10001 !important;
	    }
			.modal-dialog {
				width:800px;
			}
	  </style>
@endsection
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>

<script>
/*$(function(){
   var baseUrl = $('#baseUrl').val();
   alert(baseUrl);
 });*/
$(document).on('keyup','#pac-input',function(){ //alert();
    $('.pac-container').css({
      display: 'block !important',
      'z-index': '10001'
    });
});
    jQuery(document).ready(function($) {
        $('#modal-id').on('shown.bs.modal',function(){ //alert();
          var baseUrl = $('#baseUrl').val();
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
              new google.maps.LatLng(-10.2095571, 17.3465432),
              new google.maps.LatLng(-14.1392794, 17.3909768));
            map.fitBounds(defaultBounds);


            var input =( document.getElementById('pac-input'));
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            var searchBox = new google.maps.places.SearchBox((input));

            google.maps.event.addListener(searchBox, 'places_changed', function() {
              var places = searchBox.getPlaces();
              if (places.length == 0) {
                return;
              }
              for (var i = 0, marker; marker = markers[i]; i++) {
                marker.setMap(null);
              }


              markers = [];
              var bounds = new google.maps.LatLngBounds();
              for (var i = 0, place; place = places[i]; i++) {

                var image = new google.maps.MarkerImage(baseUrl+'/public/images/site/marker_big.png');
                image.size = new google.maps.Size( 40, 40 );
                image.origin = new google.maps.Point( 0, 0 );
                image.scaledSize = new google.maps.Size( 40, 40 );

                var marker = new google.maps.Marker({
                  map: map,
                  icon: image,
                  zoom:14,
                  draggable:true,
                  title: place.name,
                  position: place.geometry.location
                });
                google.maps.event.addListener(marker, 'mouseup', toggleBounce);
                markers.push(marker);
                bounds.extend(place.geometry.location);
              }

              map.fitBounds(bounds);
              map.set("zoom", 12);
            });

            google.maps.event.addListener(map, 'bounds_changed', function() {
              var bounds = map.getBounds();
              searchBox.setBounds(bounds);
            });


          }

          function toggleBounce(e) {
            var str=e.latLng;

            geocodePosition(e.latLng);
            var ltolong=str.toString();
            var x = ltolong;
            var separators = [' ', '\\\+', '\\\(','\\\,', '\\\)', '\\*', '/', ':', '\\\?'];
            var tokens = x.split(new RegExp(separators.join('|'), 'g'));

            document.getElementById('hall_lat').innerHTML='Latitude :'+tokens[1];
            document.getElementById('hall_lng').innerHTML='Longitude :'+tokens[3];
            document.getElementById('lat').value=tokens[1];
            document.getElementById('lng').value=tokens[3];

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
          google.maps.event.trigger(map,'resize',initialize());
        });
        $(document).on('click','.map_reset',function(){ //alert();
         $("#modal-id").unbind('shown.bs.modal');
         $(".close").trigger('click');
       });
      });

function get_user_details(user) {
	var baseUrl = $('#baseUrl').val();
	var user_id = user.value;
	$.ajax({
	  url: baseUrl+"/admin/hall_getuserdetails",
	  data:{user_id:user_id},
	  type: "POST",
	  dataType: "application/json",
  	  accept: "application/json",
	}).error(function(err){
		var get=$.parseJSON(err.responseText);
		for(var user in get) {
			$('#official_name').val(get[user].first_name + get[user].last_name);
			$('#contact_name').val(get[user].first_name + get[user].last_name);
			$('#contact_email').val(get[user].email);
			$('#contact_mobile').val(get[user].contact_number);
			$('#user_id').val(user_id);
		}
	});
}
</script>
  {{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
	{{ Html::script('public/js/admin/common.js') }}
@endsection