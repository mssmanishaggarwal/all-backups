@extends('layouts.dashboard')
@section('script')
  <script type="text/javascript">

    window.onload = function() {

      //  getLocation();
       // getProvince();
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

  </script>
  <script type="text/javascript">
     $(document).on('submit keyup', '.edit-prof', function(event) {
            event.preventDefault();
            if(event.type=='submit' ||event.type=='keyup' ){
              var values = {};
              $.each($('.edit-prof').serializeArray(), function(i, field) {
                  values[field.name] = field.value;
              });
              for(var keys in values){
                if(values[keys]!=''){ //console.log(keys);
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
           /* if($('#sum').val()==11){*/

            $.ajax({
              url:baseUrl+"/dashboard/update-profile",
              type: "POST",
              data: values,
              success: function(result) {
               // $.parseJSON(re.responseText);
               $('.btnloader').hide();
               var reslt=$.parseJSON(result);
             $('.sub-contact').html('<div class="alert alert-success orange"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>'+reslt.success+'</strong></div>')
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
     /* }else{*/

     /* }*/
     }
        });


</script>
@endsection
@section('content')
<section class="dash-main clearfix">
<div class="col-md-12 dash-top-second">
	<div class="col-md-6">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_40')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_40')}}</li>
	</ul>
	</div>
	<div class="col-md-6">
		<div class="dash-day">Wed
		</div>
		<div class="dash-date">02-02-2531
		</div>
	</div>
</div>

<div class="col-md-12 dash-container p-t-20 p-b-20">
@if (session('status'))
<div class="alert alert-success orange">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('status') }}</strong>
</div>
@endif
        <form class="form-horizontal edit-prof clearfix p-t-20" role="form" method="POST" action="{{ url('/dashboard/update-profile') }}">
            {!! csrf_field() !!}
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6 first_name {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="Firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_1')}}<span>*</span></label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ Auth::user()->first_name }}"/>
                        @if ($errors->has('first_name'))
                        <span class="help-block">
                            {{ $errors->first('first_name') }}
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 last_name {{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <label for="Lastname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_2')}}<span>*</span></label>
                        <input type="text" name="last_name" id="last_name" class="form-control"
                        value="{{ Auth::user()->last_name }}"/>
                        @if ($errors->has('last_name'))
                        <span class="help-block">
                            {{ $errors->first('last_name') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6  email {{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_3')}}<span>*</span></label>
                        <input type="text" name="email" id="email" value="{{ Auth::user()->email }}" class="form-control" disabled="disabled" />
                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 contact_number {{ $errors->has('contact_number') ? ' has-error' : '' }}">
                        <label for="mobile">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_4')}}<span>*</span></label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" value="{{ Auth::user()->contact_number }}" disabled="disabled"/>
                        @if ($errors->has('contact_number'))
                        <span class="help-block">
                            <strong>{{ $errors->first('contact_number') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 m-b-15 ">
                <div class="row">
                    <div class="col-md-12 address {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_7')}}<span>*</span></label>
                        <textarea class="fulladdress" name="address" >{{ Auth::user()->address }}</textarea>
                        @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-4 col-sm-4 city ">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}<span>*</span></label>
                        <select name="city" id="reg_city" >
                         <option value="">Select Location</option>
                         @foreach($data['locationList'] as $location)
                             <option value="{{ $location->location_id }}" @if($location->location_id == Auth::user()->city) selected @endif>{{ $location->location_name }}</option>
                         @endforeach
                     </select>
                 </div>
                 <div class="col-md-4 col-sm-4 state">
                    <label for="firstname">
                    {{ Sitevariable::setVariables($data['language_val'],'eventus_9')}}<span>*</span></label>
                    <select name="state" id="province" >
                     <option value="">Select Province</option>
                     @foreach($data['getprovince'] as $val)
                             <option value="{{ $val->id }}" @if($val->id == Auth::user()->state) selected @endif>{{ $val->province_name }}</option>
                         @endforeach
                 </select>
             </div>
             <div class="col-md-4 col-sm-4 postcode">
                <label for="postcode">
                {{ Sitevariable::setVariables($data['language_val'],'eventus_10')}}<span></span></label>
                <input type="text" name="postcode" id="postcode" value="{{ Auth::user()->postcode }}" class="form-control"/>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-b-35">
        <div class="row">
          <div class="col-md-4 col-sm-4">
           <!--  <label for="captcha">Type the words in the box <span>*</span></label> -->

           <!--  {{ Html::image('public/images/site/captcha.jpg','Banner4') }} -->
            <!-- <img src="images/captcha.jpg" width="278" height="51" alt=""> -->
        </div>
        <!-- <div class="col-md-5 col-sm-6">
            <input type="text" id="captcha" class="form-control"/>
        </div> -->
      </div>
    </div>

  <div class="col-md-12 m-b-20">
    <input type="submit" class="orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_33')}}"  />
    <span class="btnloader">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
    <div class="sub-contact"></div>
 </div>
</form>
<!-- Profile picture Uploading  -->


<!-- End Profile picture Uploading  -->
</div>


</section>

@endsection