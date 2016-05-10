@extends('layouts.dashboard')
@section('script')
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp&signed_in=true&libraries=places"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn-history/r131/trunk/markerwithlabel/src/markerwithlabel_packed.js"></script>
<!-- Form Validation Code start -->

 {{ Html::script('public/js/site/jquery.validate.js') }}
<!-- Form Validation Code ended -->
<script type="text/javascript">

  window.onload = function() {

   getLocation();
   getProvince();
   autoCompleteCompobox();
   $(function() {
    $( "#reg_city" ).combobox();
    $( "#toggle" ).click(function() {
     $( "#reg_city" ).toggle();
   });
  });
   $(function() {
    $( "#province" ).combobox();
    $( "#toggle" ).click(function() {
     $( "#province" ).toggle();
   });
  });
}
   /*=====================================*/

        $(document).on('submit keyup', '.form-horizontal', function(event) {
            event.preventDefault();
            var accommodation_ids = [];
            var hall_types = [];
            $("input[name='hall_type']:checked").each(function ()
            {
              hall_types.push(parseInt($(this).val()));
            });
			var facilities_array = [];
            $("input[name='facilities']:checked").each(function ()
            {
              facilities_array.push(parseInt($(this).val()));
            });
            if(event.type=='submit' ||event.type=='keyup' ){
              var values = {};
              $.each($('.form-horizontal').serializeArray(), function(i, field) {
                  values[field.name] = field.value;
              });
              for(var keys in values){
                if(values[keys]!=''){
                  /*if(values[keys]==hall_type[]){
                    continue;
                  }*/
                 $('.'+keys+'.has-error').removeClass('has-error');
                 $('.'+keys+'>.help-block').remove();
                 $('.'+keys+'>.help-block').removeClass('help-block');
               }
              }

            }



          if(event.type=='submit'){
          	$('.btnloader').show();
            $('.has-error').removeClass('has-error');
            $('.help-block').remove();
            $('.help-block').removeClass('help-block');
            $.ajax({
              url:baseUrl+"/dashboard/addhall-validate",
              type: "POST",
              data:{
                 hall_name:$('input:text[name=hall_name]').val(),
                 hall_type:hall_types,
				 facilities:facilities_array,
                 hall_description:$('textarea[name=hall_description]').val(),
                 hall_address:$('input:text[name=hall_address]').val(),
                 hall_province:$('select[name=hall_province]').val(),
                 location_id:$('select[name=location_id]').val(),
                 hall_postcode:$('input:text[name=hall_postcode]').val(),
                 lat:$('input:text[name=lat]').val(),
                 lng:$('input:text[name=lng]').val(),
                 g_address:$('input:hidden[name=g_address]').val(),
                 contact_email:$('input:text[name=contact_email]').val(),
                 contact_mobile:$('input:text[name=contact_mobile]').val(),
                 official_name:$('input:text[name=official_name]').val(),
                 contact_name:$('input:text[name=contact_name]').val(),
                 rental_amount:$('input:text[name=rental_amount]').val(),
                 _token:$('input:hidden[name=_token]').val(),
          },
              success: function(result) {
               //console.log(result);
               //window.location.href=baseUrl+'/register-thanks';
               $('.btnloader').hide();
               location.reload();
           }
       }).error(function(re){
       			$('.btnloader').hide();
                var returnable=$.parseJSON(re.responseText);
                var count=1;
                for(var key in returnable){
                    if(count==1){
                      $('#'+key).focus();
                    }
                    $('.'+key).addClass('has-error');
                    $('.'+key).append('<span class="help-block">'+returnable[key]+'</span>');
                    count++;
                }
              // console.log(Object.keys(returnable).length);

       });
     }
        });
/*=====================================*/
</script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
@endsection
@section('content')
<style type="text/css">
  input[type=checkbox]+ span{
    border:1px solid black;
  }
  .modal-open .modal {
    overflow-x: hidden;
    overflow-y: auto;
    z-index: 10000 !important;
  }
</style>
<section class="dash-main clearfix">
  <div class="col-md-12 dash-top-second p-b-10">
   <div class="col-md-12 p-l-none">
     <h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</h2>
     <ul>
      <li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
      <li><a href="{{url('dashboard/my-hall')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</a></li>
      <li>{{ Sitevariable::setVariables($data['language_val'],'eventus_124')}}</li>
    </ul>
  </div>
</div>

<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">
@if (session('status'))
  <div class="alert alert-success orange">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <strong>{{ session('status') }}</strong>
 </div>
@endif
@if (session('fails'))
 <div class="alert alert-danger">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
   <strong>{{ session('fails') }}</strong>
 </div>
@endif
 <ul class="nav nav-tabs custom-tab" role="tablist">
  <li role="presentation" class="active"><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
  <li role="presentation"><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
  <li role="presentation"><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
  <li role="presentation"><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
   <li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-calendar"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
  <li role="presentation" ><a href="{{url('/dashboard/hall/subscription/')}}" class="disable_link"><span class="fa fa-cube"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
</ul>
<div class="tab-content clearfix">
<script type="text/javascript">
jQuery(document).ready(function($) {
<?php if (array_key_exists('fetched_hall_type', $data)) {
	//print_r($data['fetched_hall_type']);
	foreach ($data['fetched_hall_type'] as $key => $value) {
		?>
    $('#hall_id_'+<?php echo $value->hall_type_id; ?>).attr('checked', 'checked');

    <?php
}?>
    $('.button-name').val("{{ Sitevariable::setVariables($data['language_val'],'eventus_153')}}");
<?php
} else {?>
    $(document).on('click','.disable_link',function(stop){
        stop.preventDefault();
    });
<?php
}
?>
});
</script>
  <h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</h5>
  <form class="form-horizontal hallform clearfix" id="addhall" role="form" method="POST" action="{{ url('/dashboard/addhall-validate') }}" >

    {!! csrf_field() !!}
    <div class="col-md-12 m-b-15">
      <div class="row">
        <div class="col-md-7 col-sm-7 hall_name {{ $errors->has('hall_name') ? ' has-error' : '' }}">
          <label for="Firstname">
            {{ Sitevariable::setVariables($data['language_val'],'eventus_126')}}<span>*</span></label>
            <input type="text" name="hall_name" id="hall_name" class="form-control" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->hall_name;}
?>"/>
            @if ($errors->has('hall_name'))
            <span class="help-block">
              {{ $errors->first('hall_name') }}
            </span>
            @endif
          </div>

        </div>
      </div>
      <div class="col-md-12 m-b-15">
        <div class="row">
          <div class="col-md-12 col-sm-12 hall_type {{ $errors->has('hall_type') ? ' has-error' : '' }}">
            <label for="Firstname">
              {{ Sitevariable::setVariables($data['language_val'],'eventus_20')}}<span>*</span></label>
              <?php $count = 0; foreach ($data['halltype'] as $val) {
	?>
              <div class="col-md-2 m-b-20 p-l-none">
                <input type="checkbox" name="hall_type" value="<?php echo $val->id; ?>" id="hall_id_<?php echo $val->id; ?>" >
                <?php echo $val->hall_type_name; ?>

              </div>
              <?php $count++;}
?>
              @if ($errors->has('hall_type'))
              <span class="help-block">
                {{ $errors->first('hall_type') }}
              </span>
              @endif
            </div>
          </div>
        </div>
				
				
				 <div class="col-md-12 m-b-15">
        <div class="row">
          <div class="col-md-12 col-sm-12 facilities {{ $errors->has('facilities') ? 'facilities' : '' }}">
            <label for="Facilities">
              {{ Sitevariable::setVariables($data['language_val'],'eventus_187')}}</label>
              <?php $count = 0; foreach ($data['facilitiesList'] as $val) {
				$checked = ''?>
				@if( in_array($val->facilities_id, $data['hall_fac_selected']) ) 
					<?php $checked='checked' ?>
				@endif
              <div class="col-md-2 m-b-20 p-l-none">
                <input type="checkbox" name="facilities" value="<?php echo $val->facilities_id; ?>" id="facilities_<?php echo $val->facilities_id; ?>" {{$checked}} />
                <?php echo $val->facilities_name; ?>
              </div>
              <?php $count++;}
?>			
				@if ($errors->has('hall_type'))
				  <span class="help-block">
					{{ $errors->first('hall_type') }}
				  </span>
				@endif
            </div>
          </div>
        </div>
				
				
				
				
				
        <div class="col-md-12 m-b-15 ">
          <div class="row">
            <div class="col-md-12 hall_description {{ $errors->has('hall_description') ? ' has-error' : '' }}">
              <label for="firstname">{{ Sitevariable::setVariables($data['language_val'],'eventus_140')}}<span>*</span></label>
              <textarea class="fulladdress" name="hall_description" ><?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->hall_description;}
?></textarea>
              @if ($errors->has('hall_description'))
              <span class="help-block">
                {{ $errors->first('hall_description') }}
              </span>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-12 m-b-15">
          <div class="row">
            <div class="col-md-6 col-sm-6  hall_address {{ $errors->has('hall_address') ? ' has-error' : '' }}">
              <label for="email">
                {{ Sitevariable::setVariables($data['language_val'],'eventus_7')}}<span>*</span></label>
                <input type='text' class="form-control"  name="hall_address" id="hall_address"value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->hall_address;}
?>" />
                @if ($errors->has('hall_address'))
                <span class="help-block">
                  {{ $errors->first('hall_address') }}
                </span>
                @endif
              </div>

              <div class="col-md-6 col-sm-6 hall_province">
                <label for="firstname">
                  {{ Sitevariable::setVariables($data['language_val'],'eventus_9')}}<span>*</span></label>
                  <select name="hall_province" id="province" >
                   <option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_141')}}</option>
                      <?php foreach ($data['getprovince'] as $val2) {
	?>
                             <option value="<?php echo $val2->id ?>"  <?php if (array_key_exists('hall_details', $data)) {if ($data['hall_details'][0]->hall_province == $val2->id) {echo "selected";}}
	?>><?php echo $val2->province_name ?></option>
                      <?php }
?>                 </select>
                 @if ($errors->has('hall_province'))
                 <span class="help-block">
                  {{ $errors->first('hall_province') }}
                </span>
                @endif
              </div>

            </div>
          </div>
          <div class="col-md-12 m-b-15">
            <div class="row">

              <div class="col-md-6 col-sm-6 location_id ">
                <label for="firstname">
                  {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}<span>*</span></label>
                  <select name="location_id" id="reg_city" >
                   <option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_142')}}</option>
                      <?php foreach ($data['locationList'] as $location) {
	?>
                             <option value="<?php echo $location->location_id ?>"  <?php if (array_key_exists('hall_details', $data)) {if ($data['hall_details'][0]->location_id == $location->location_id) {echo "selected";}}
	?>><?php echo $location->location_name ?></option>
                      <?php }
?>
                 </select>
                 @if ($errors->has('location_id'))
                 <span class="help-block">
                  {{ $errors->first('location_id') }}
                </span>
                @endif
              </div>
              <div class="col-md-6 col-sm-6 hall_postcode">
                <label for="postcode">
                  {{ Sitevariable::setVariables($data['language_val'],'eventus_10')}}<span></span></label>
                  <input type="text" name="hall_postcode" id="hall_postcode" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->hall_postcode;}
?>" class="form-control"/>
                </div>


              </div>
            </div>
            <div class="col-md-12 m-b-15 set-location">
              <div class="row">
                <div class="col-md-3 col-sm-5">
                  <h5 class="hall_location_marker p-l-30">{{ Sitevariable::setVariables($data['language_val'],'eventus_143')}}</h5>
                </div>
                <div class="col-md-3 col-sm-5">
                  <a class="orange" data-toggle="modal" href='#modal-id'>{{ Sitevariable::setVariables($data['language_val'],'eventus_144')}}</a>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <p class="hall_location">{{ Sitevariable::setVariables($data['language_val'],'eventus_145')}}.</p>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-6 col-sm-6 lat {{ $errors->has('lat') ? ' has-error' : '' }}">
                  <label for="Lat">
                    {{ Sitevariable::setVariables($data['language_val'],'eventus_147')}}<span>*</span></label>
                    <input type="text" name="lat" id="lat" class="form-control" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->lat;}
?>" READONLY />
                    @if ($errors->has('lat'))
                    <span class="help-block">
                      {{ $errors->first('lat') }}
                    </span>
                    @endif
                  </div>
                  <input type="hidden" name="g_address" id="g_address" value="">
                  <div class="col-md-6 col-sm-6 lat {{ $errors->has('lng') ? ' has-error' : '' }}">
                    <label for="Lng">
                      {{ Sitevariable::setVariables($data['language_val'],'eventus_147')}}<span>*</span></label>
                      <input type="text" name="lng" id="lng" class="form-control" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->lng;}
?>"
                      READONLY />
                      @if ($errors->has('lng'))
                      <span class="help-block">
                        {{ $errors->first('lng') }}
                      </span>
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-md-12 m-b-15">
                  <div class="row">

                    <div class="col-md-6 col-sm-6  contact_email {{ $errors->has('contact_email') ? ' has-error' : '' }}">
                      <label for="email">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_148')}}<span>*</span></label>
                        <input type='text' class="form-control"  name="contact_email" id="contact_email" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->contact_email;} else {
	?>{{ Auth::user()->email }}<?php }
?>" />
                        @if ($errors->has('contact_email'))
                        <span class="help-block">
                          {{ $errors->first('contact_email') }}
                        </span>
                        @endif
                      </div>
                      <div class="col-md-6 col-sm-6 contact_mobile {{ $errors->has('contact_mobile') ? ' has-error' : '' }}">
                        <label for="mobile">{{ Sitevariable::setVariables($data['language_val'],'eventus_149')}}<span>*</span></label>
                        <input type="text" name="contact_mobile" id="contact_mobile" class="form-control" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->contact_mobile;} else {
	?>{{ Auth::user()->contact_number }}<?php }
?>"/>
                        @if ($errors->has('contact_mobile'))
                        <span class="help-block">
                          {{ $errors->first('contact_mobile') }}
                        </span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 m-b-15">
                    <div class="row">
                      <div class="col-md-6 col-sm-6  official_name {{ $errors->has('official_name') ? ' has-error' : '' }}">
                        <label for="email">
                          {{ Sitevariable::setVariables($data['language_val'],'eventus_150')}}<span>*</span></label>
                          <input type='text' class="form-control"  name="official_name" id="official_name" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->official_name;} else {
	?>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<?php }
?>"/>
                          @if ($errors->has('official_name'))
                          <span class="help-block">
                            {{ $errors->first('official_name') }}
                          </span>
                          @endif
                        </div>
                        <div class="col-md-6 col-sm-6 contact_name {{ $errors->has('contact_name') ? ' has-error' : '' }}">
                          <label for="mobile">{{ Sitevariable::setVariables($data['language_val'],'eventus_151')}}<span>*</span></label>
                          <input type="text" name="contact_name" id="contact_name" class="form-control" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->contact_name;} else {
	?>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}<?php }
?>"/>
                          @if ($errors->has('contact_name'))
                          <span class="help-block">
                            {{ $errors->first('contact_name') }}
                          </span>
                          @endif
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 m-b-20">
                      <div class="row">
                        <div class="col-md-6 col-sm-6 rental_amount {{ $errors->has('rental_amount') ? ' has-error' : '' }}">
                          <label for="mobile">{{ Sitevariable::setVariables($data['language_val'],'eventus_92')}}<span>*</span></label>
                          <input type="text" name="rental_amount" id="rental_amount" class="form-control" value="<?php if (array_key_exists('hall_details', $data)) {echo $data['hall_details'][0]->rental_amount;}
?>"/>
                          @if ($errors->has('rental_amount'))
                          <span class="help-block">
                            {{ $errors->first('rental_amount') }}
                          </span>
                          @endif
                          <span class="currencyval">AOA</span>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-12 m-b-35">
                      <input type="submit" class="orange button-name" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_139')}}"  />
                      <span class="btnloader">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
                    </div>
                  </form>
                </div>
              </div>
            </section>

            <!-- ================Boot Strap Modal For Map ========================-->
            <style type="text/css">
              .pac-container .pac-logo{
                display:block !important;
                z-index:10001 !important;
              }
            </style>
<script type="text/javascript">
    $(document).on('keyup','#pac-input',function(){ //alert();
      $('.pac-container').css({
        display: 'block !important',
        'z-index': '10001'
      });
    });
    jQuery(document).ready(function($) {
        $('#modal-id').on('shown.bs.modal',function(){ //alert();
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

</script>
    <div class="modal fade" id="modal-id">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close map_reset" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">{{ Sitevariable::setVariables($data['language_val'],'eventus_143')}}</h4>
            <small>{{ Sitevariable::setVariables($data['language_val'],'eventus_152')}}.</small>
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
            <input type="hidden" name="lat" id="lats" value="">
            <input type="hidden" name="lng" id="lngs" value="">
            <input type="hidden" name="g_address" id="g_address" value="">



          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary map_reset">{{ Sitevariable::setVariables($data['language_val'],'eventus_143')}}</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ==============Boot Strap Modal For Map ended======================== -->

    @endsection