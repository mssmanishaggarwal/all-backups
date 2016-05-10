<script type="text/javascript">
    //window.onload = function() {

        $(document).on('submit keyup', '.form-popup-login', function(event) {
            event.preventDefault();
            if(event.type=='submit' || event.type=='keyup'){
              var values = {};
              $.each($('.form-popup-login').serializeArray(), function(i, field) {
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
              $('.has-error').removeClass('has-error');
              $('.help-block').remove();
              $('.help-block').removeClass('help-block');
            $.ajax({
              url:baseUrl+"/login",
              type: "POST",
              data:{
                 email:$('input:text[name=email]').val(),
                 contact_number:$('input:text[name=email]').val(),
                 password:$('input:password[name=password]').val(),
                 is_active: 1,
                 _token:$('input:hidden[name=_token]').val(),
          },
              success: function(result) {
               //console.log(result);
               if(result=='These credentials do not match our records.'){
               $('.email').addClass('has-error');
               $('.email').append('<span class="help-block"><strong>'+result+'</strong></span>');
               }else{
               	 authVal = 1;               	
               	 var clickEvent = getCookie('clickbtn').split('_');
               	 if(clickEvent[0] == 'booknow'){				 	
               	 	$('#book_button').click();
				 }
				 else if(clickEvent[0] == 'myfav')
				 {
				 	$('#login-id .close').click();
				 	setFavorite(clickEvent[1]);
				 } 
				 else if(clickEvent[0] == 'review') 
				 {				 	
				 	$('#login-id .close').click();				 	
				 	$('#review-id').modal('toggle');
				 }
				 else if(clickEvent[0] == 'enquiry')
				 {
				 	$('#login-id .close').click();
				 	$('#enquiry-id').modal('toggle');
				 } 
				  else if(clickEvent[0] == 'addhall')
				 {
				 	$('#login-id .close').click();
				 	window.location.href = baseUrl+'/dashboard/add-my-hall';
				 }             	 	
               	 else
                 location.reload();
               }


           }
       }).error(function(re){
                var returnable=$.parseJSON(re.responseText);
                for(var key in returnable){
                    //console.log(key);
                    $('.'+key).addClass('has-error');
                    $('#'+key).focus();
                    $('.'+key).append('<span class="help-block '+key+'">'+returnable[key]+'</span>');
                }
              // console.log(returnable);

       });
     }
        });

   // };
</script>

        <form class="form-popup-login login clearfix" role="form" method="POST" action="{{ url('/login') }}">
            {!! csrf_field() !!}

            <div class="col-md-12 m-b-15 email form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <div class="row">

                    <div class="col-md-12 col-sm-12">
                        <label for="email-mob">{{ Sitevariable::setVariables($data['language_val'],'eventus_27')}}<span>*</span></label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-12 m-b-15 password form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <label for="pwd">{{ Sitevariable::setVariables($data['language_val'],'eventus_5')}}<span>*</span></label>
                        <input type="password" class="form-control"  id="pwd" name="password">

                        @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-md-12 m-b-20">

                <input type="checkbox" name="remember" id="agree">
                <label class="terms" for="agree">{{ Sitevariable::setVariables($data['language_val'],'eventus_29')}}
                </label>
            </div>



            <div class="col-md-6 m-b-35">
                <input type="submit" class="btn btn-primary orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_28')}}">

            </div>
            <div class="col-md-6 m-b-35 text-right forgot-pass">


                <a class="btn btn-link" href="{{ url('/password/reset') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_31')}}</a>
            </div>            
        </form>