@extends('layouts.backend')
@section('content')
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> <div id="main">
	<form id="halls_form" name="halls_form" class="form-horizontal" method="POST" action="{{$data['url']}}">
		<input type="hidden" name="todo" id="todo" value="{{$data['todo']}}">
			<ul class="nav nav-tabs custom-tab" role="tablist">
				<li role="presentation" class="active"><a href="hall" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
				<li role="presentation"><a href="{{url('/admin/hall_uploadimage')}}/{{$data['hall_id']}}" @if($data['todo']=='addrec') class="disable_link" @endif><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
				<li role="presentation"><a href="{{url('/admin/hall_addon')}}/{{$data['hall_id']}}" @if($data['todo']=='addrec') class="disable_link" @endif><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
				<li role="presentation"><a href="{{url('/admin/hall_accommodation')}}/{{$data['hall_id']}}" @if($data['todo']=='addrec') class="disable_link" @endif><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
				<li role="presentation" ><a href="{{url('/admin/hall_subscription/')}}/{{$data['hall_id']}}" @if($data['todo']=='addrec') class="disable_link" @endif><span class="fa fa-cube"></span> Subscription</a></li>
				<li role="presentation" ><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}" @if($data['todo']=='addrec') class="disable_link" @endif><span class="fa fa-cube"></span> Calender</a></li>
			</ul>
			<div class="box box-warning">
				<div class="tab-content">
					<div role="tabpanel" class="tab-pane active" id="hallDetails">
						<div class="box-header with-border">
							<h3 class="box-title">Add Hall Details</h3>
						</div>
						<div class="box-body">            
						<div class="form-group">
							<label class="col-sm-2 text-right">Hall Name <span class="text-red">*</span></label>
							<div class="col-sm-4"><input type='text' value="{{isset($data['dataset'][0]->hall_name)?$data['dataset'][0]->hall_name:''}}" class="form-control "name="hall_name" id="hall_name"/></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 text-right">Hall Type <span class="text-red">*</span></label>
							<div class="col-sm-10">
								@foreach($data['halltypes'] as $hty) 
									<?php $checked = ''?>
									@if( in_array($hty->hall_type_id, $data['halltypeids']) ) 
										<?php $checked='checked' ?>
									@endif
									<div class="checkbox-inline no-top-padding">
										<label for="checkbox">
											<input type="checkbox" name="hall_type[]" id="hall_type_{{$hty->hall_type_id}}" value="{{$hty->hall_type_id}}" {{$checked}} class="hall_type"/> {{$hty->hall_type_name}}
										</label>
									</div>
								@endforeach
								<div class="hall_type_error"></div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 text-right">Hall Facilities <span class="text-red">*</span></label>
							<div class="col-sm-10">
								@foreach($data['facilities'] as $hfc) 
									<?php $checked = ''?>
									@if( in_array($hfc->facilities_id, $data['hall_fac_selected']) ) 
										<?php $checked='checked' ?>
									@endif
									<div class="checkbox-inline no-top-padding">
										<label for="checkbox">
											<input type="checkbox" name="hall_fac[]" id="$hall_fac_{{$hfc->facilities_id}}" value="{{$hfc->facilities_id}}" {{$checked}}/> {{$hfc->facilities_name}}
										</label>
									</div>
								@endforeach
							</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 text-right">Description <span class="text-red">*</span></label>
							<div class="col-sm-4"><textarea name="hall_description" id="hall_description" class="form-control" rows="5" cols="150">{{isset($data['dataset'][0]->hall_description)?$data['dataset'][0]->hall_description:''}}</textarea></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 text-right">Address<span class="text-red">*</span></label>
							<div class="col-sm-4"><input type='text' class="form-control" name="hall_address" id="hall_address" value="{{isset($data['dataset'][0]->hall_address)?$data['dataset'][0]->hall_address:''}}" /></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 text-right">Location<span class="text-red">*</span></label>
							<div class="col-sm-4">  
								<select class="form-control" id="location" name="location">
									<option value="">Select</option>
									@foreach($data['locations'] as $loc)
										<option {{isset($data['dataset'][0]->location_id)?($data['dataset'][0]->location_id==$loc->location_id)?'selected="selected"':'':''}} value="{{$loc->location_id}}">{{$loc->location_name}}</option>
									@endforeach 
								</select>	
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 text-right">Province<span class="text-red">*</span></label>
							<div class="col-sm-4">
								<select class="form-control" id="province" name="province">
									<option value="">Select</option>
									@foreach($data['province'] as $pro)
										<option {{isset($data['dataset'][0]->hall_province)?($data['dataset'][0]->hall_province==$pro->id)?'selected="selected"':'':''}} value="{{$pro->id}}">{{$pro->province_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
							<div class="form-group">
								<label class="col-sm-2 text-right">Post Code<span class="text-red"></span></label>
								<div class="col-sm-4"><input type='text' value="{{isset($data['dataset'][0]->hall_postcode)?$data['dataset'][0]->hall_postcode:''}}" class="form-control" name="hall_postcode" id="hall_postcode" /> </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 text-right">Set Location <span class="text-red">*</span></label>
								<div class="col-sm-4">
									<a class="orange" data-toggle="modal" href='#modal-id'>Click</a>
								</div>
							</div>
              <div class="form-group">
                <label class="col-sm-2 text-right">Latitude<span class="text-red">*</span></label>
                <div class="col-sm-4"><input type='text' class="form-control" name="lat" id="lat" value="{{isset($data['dataset'][0]->lat)?$data['dataset'][0]->lat:''}}" />
               	</div>
							</div>
              <div class="form-group">
                <label class="col-sm-2 text-right">Longitude<span class="text-red">*</span></label>
                <div class="col-sm-4"><input type='text' class="form-control" name="lng" id="lng" value="{{isset($data['dataset'][0]->lng)?$data['dataset'][0]->lng:''}}" />
               	</div>
							</div>
              <input type="hidden" name="g_address" id="g_address">
                <div class="form-group">
                  <label class="col-sm-2 text-right">Amount<span class="text-red">*</span></label>
                  <div class="col-sm-4">  
                  	<div class="input-group">
  <input type='text' class="form-control" name="rental_amount" value="{{isset($data['dataset'][0]->rental_amount)?$data['dataset'][0]->rental_amount:''}}" id="rental_amount" />
  <span class="input-group-addon">AOA</span>
</div>
                  </div>
                </div>
				<div class="form-group">
               		<label class="col-sm-2 text-right">Select User <span class="text-red">*</span></label>
                		<div class="col-sm-4">
                		<select class="form-control" name="user_id" id="user_id" onchange="get_user_details(this);">
                      <option value="">Select</option>
											@foreach($data['users'] as $us)
												<option {{isset($data['dataset'][0]->user_id)?($data['dataset'][0]->user_id==$us->id)?'selected="selected"':'':''}} value="{{$us->id}}">{{$us->first_name}} {{$us->last_name}}</option>
											@endforeach
                    </select>
					 </div>
                 </div>
                 <div class="form-group">
                        <label class="col-sm-2 text-right">Official Name <span class="text-red">*</span></label>
                         <div class="col-sm-4"><input type='text' class="form-control" name="official_name" id="official_name"value="{{isset($data['dataset'][0]->official_name)?$data['dataset'][0]->official_name:''}}" />
                         </div>
               	 </div>
                <div class="form-group">
                    <label class="col-sm-2 text-right">Contact Name <span class="text-red">*</span></label>
                    <div class="col-sm-4"><input type='text' class="form-control" name="contact_name" id="contact_name" value="{{isset($data['dataset'][0]->contact_name)?$data['dataset'][0]->contact_name:''}}" />
                	</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 text-right">Contact Email<span class="text-red">*</span></label>
                    <div class="col-sm-4"><input type='text' class="form-control" name="contact_email" id="contact_email" value="{{isset($data['dataset'][0]->contact_email)?$data['dataset'][0]->contact_email:''}}" />
                </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 text-right">Contact Mobile <span class="text-red">*</span></label>
                    <div class="col-sm-4"><input maxlength="50" type='number' class="form-control" name="contact_mobile" id="contact_mobile" value="{{isset($data['dataset'][0]->contact_mobile)?$data['dataset'][0]->contact_mobile:''}}"  />
                	</div>
                </div>
                <div class="form-group">
                   	<label class="col-sm-2 text-right">Is Active <span class="text-red"></span></label>
                    <div class="col-sm-4"><input type='checkbox' class="" name="is_active" id="is_active" checked="checked" /> </div>
                </div>


                </div>
                
                 <div class="box-footer text-right"><div class="spinner-loader_edit" style="display: none;">

                                {{ Html::image('public/images/loader.gif') }}
                            </div><span class="alert alert-success alert-sm save_msg" style="display: none;">{{ trans('messages.saved') }}</span>

                            <button type="submit" class="btn btn-primary add_more_button add_contact" id="cloneButton" onclick="updateHalls('{{ url('/admin/hall')}}/{{ $data['id']}}','halls_form','{{ url('/admin/hall_list')}}')"><span class="fa fa-save fa-fw"></span> {{$data['saveBtn']}}</button>
                            <button type="button" onclick="document.location.href='{{ url('/admin/hall_list') }}'" class="btn btn-default " id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
                    <p> <div id="error_msg"></div></p>
                  </div>


               </div>               
                   
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

jQuery(document).ready(function($){
	$('#halls_form').submit(function(e){
		if($('.hall_type:checked').length <= 0) {
			$('.hall_type_error').html('<span class="error_hall_type" style="color: red !important;">Required field.</span>');
		} else {
			$('.hall_type_error').html('');
		}
	});
	
	
});
</script>
{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection