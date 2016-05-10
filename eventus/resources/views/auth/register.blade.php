@extends('layouts.app')
@section('script')

 <script src='https://www.google.com/recaptcha/api.js'></script>


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
        $(document).on('submit keyup', '.form-horizontal', function(event) {
            event.preventDefault();
            if(event.type=='submit' ||event.type=='keyup' ){
              var values = {};
              $.each($('.form-horizontal').serializeArray(), function(i, field) {
                  values[field.name] = field.value;
              });
              for(var keys in values){
                if(values[keys]!=''){ console.log(keys);
                 $('.'+keys+'.has-error').removeClass('has-error');
                 $('.'+keys+'>.help-block').remove();
                 $('.'+keys+'>.help-block').removeClass('help-block');
               }
              }

            if($('#password').val()!=$('#confirm').val()){
                $('.confirm').addClass('has-error');
                $('.confirm > .help-block').remove();
                $('.confirm').append('<span class="help-block">Confirm Password does not matched</span>');
            }else{
              $('.confirm > .help-block').remove();
            }

             if($('#confirm').val()==''){
                $('.confirm').addClass('has-error');
                $('.confirm > .help-block').remove();
                $('.confirm').append('<span class="help-block">Confirm Password should be Given.</span>');
            }else{
              $('.confirm > .help-block').remove();
            }
          }

          $(document).on('click','.has-error > #agree',function(){
              $('.tne').removeClass('has-error');
          });



          if(event.type=='submit'){
            $('.has-error').removeClass('has-error');
            $('.help-block').remove();
            $('.help-block').removeClass('help-block');
            $.ajax({
              url:baseUrl+"/register",
              type: "POST",
              data:{
                 first_name:$('input:text[name=first_name]').val(),
                 last_name:$('input:text[name=last_name]').val(),
                 email:$('input:text[name=email]').val(),
                 contact_number:$('input:text[name=contact_number]').val(),
                 password:$('input:password[name=password]').val(),
                 address:$('textarea[name=address]').val(),
                 city:$('select[name=city]').val(),
                 state:$('select[name=state]').val(),
                 postcode:$('input:text[name=postcode]').val(),
                 tne:$("input[name='tne']:checked").val(),
                 _token:$('input:hidden[name=_token]').val(),
          },
              success: function(result) {
               //console.log(result);
               window.location.href=baseUrl+'/register-thanks';
           }
       }).error(function(re){
                var returnable=$.parseJSON(re.responseText);
                var count=1;
                for(var key in returnable){
                    if(count==1){
                      $('#'+key).focus();
                    }
                    if(key=='tne'){
                      $('.'+key).addClass('has-error');
                      continue;
                    }
                    $('.'+key).addClass('has-error');
                    $('.'+key).append('<span class="help-block">'+returnable[key]+'</span>');
                    count++;
                }
              // console.log(Object.keys(returnable).length);

       });
     }
        });
        function get_action(form) {
            var v = grecaptcha.getResponse();
            if(v.length == 0)
            {
                document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
                return false;
            }
            if(v.length != 0)
            {
                document.getElementById('captcha').innerHTML="Captcha completed";
                return true;
            }
        }
    };
</script>
@endsection
@section('content')

<!-- <div class="banner">
    <ul class="bxslider">
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner1') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner2') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner3') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner4') }}</li>
    </ul>
</div> -->

<section class="signupmain">
    <div class="container">
        <h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_11')}}</h2>
        <p><span><strong>*</strong> {{ Sitevariable::setVariables($data['language_val'],'eventus_32')}}</span></p>

        <form class="form-horizontal sing-up rgstr clearfix" role="form" method="POST" action="{{ url('/register') }}">
            {!! csrf_field() !!}
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6 first_name {{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <label for="Firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_1')}}<span>*</span></label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" maxlength="50"/>
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
                        value="{{ old('last_name') }}" maxlength="50"/>
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
                        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" maxlength="100"/>
                        @if ($errors->has('email'))
                        <span class="help-block">
                            {{ $errors->first('email') }}
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 contact_number {{ $errors->has('contact_number') ? ' has-error' : '' }}">
                        <label for="mobile">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_4')}}<span>*</span></label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control" maxlength="15" value="{{ old('contact_number') }}"/>
                        @if ($errors->has('contact_number'))
                        <span class="help-block">
                            {{ $errors->first('contact_number') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6 password {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="pwd">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_5')}}<span>*</span></label>
                        <input type="password" name="password" id="password" class="form-control" maxlength="50"/>
                        @if ($errors->has('password'))
                        <span class="help-block">
                           {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                    <div class="col-md-6 col-sm-6 confirm">
                        <label for="confirm">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_6')}}<span>*</span></label>
                        <input type="password" id="confirm" class="form-control confirm" maxlength="50"/>
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-b-15 ">
                <div class="row">
                    <div class="col-md-12 address {{ $errors->has('address') ? ' has-error' : '' }}">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_7')}}<span>*</span></label>
                        <textarea class="fulladdress" name="address" value="{{ old('address') }}" maxlength="255"></textarea>
                        @if ($errors->has('address'))
                        <span class="help-block">
                            {{ $errors->first('address') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-4 col-sm-4 m-b-20 city ">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}<span>*</span></label>
                        <select name="city" id="reg_city" >
                         <option value="">Select Location</option>

                     </select>
                 </div>
                 <div class="col-md-4 col-sm-4 m-b-20 state">
                    <label for="firstname">
                    {{ Sitevariable::setVariables($data['language_val'],'eventus_9')}}<span>*</span></label>
                    <select name="state" id="province" >
                     <option value="">Select Province</option>
                 </select>
             </div>
             <div class="col-md-4 col-sm-4 m-b-20 postcode">
                <label for="postcode">
                {{ Sitevariable::setVariables($data['language_val'],'eventus_10')}}<span></span></label>
                <input type="text" name="postcode" id="postcode" class="form-control" maxlength="20"/>
            </div>
        </div>
    </div>
    <div class="col-md-12 m-b-20">
        <div class="row">
          <div class="col-md-4 col-sm-4">
           <!--  <label for="captcha">Type the words in the box <span>*</span></label> -->
            <div class="g-recaptcha" data-sitekey="6Lfr8RkTAAAAAK0BKAHqayCDv9uQcyCLXN-OtCte"></div>
           <!--  {{ Html::image('public/images/site/captcha.jpg','Banner4') }} -->
            <!-- <img src="images/captcha.jpg" width="278" height="51" alt=""> -->
        </div>
        <!-- <div class="col-md-5 col-sm-6">
            <input type="text" id="captcha" class="form-control"/>
        </div> -->
      </div>
    </div>
   <div class="col-md-12 m-b-20 tne">
    <input type="checkbox" value="1" name="tne" id="agree">
    <label class="terms" for="agree"><a href="{{ url('/terms-and-condition') }}" target="_blank">{{ Sitevariable::setVariables($data['language_val'],'eventus_12')}}</a></label>
  </span>
  </div>
  <div class="col-md-12 m-b-35">
    <input type="submit" class="orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_11')}}" onsubmit="get_action(this)" />
 </div>
</form>
</div>
</section>



@endsection
