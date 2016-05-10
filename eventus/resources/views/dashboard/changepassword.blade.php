@extends('layouts.dashboard')
@section('script')
<script type="text/javascript">
            $(document).on('submit keyup', '.form-horizontal', function(event) {
            event.preventDefault();
            $('.alert-success').hide();
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
            var values = {};
              $.each($('.form-horizontal').serializeArray(), function(i, field) {
                  values[field.name] = field.value;
              });
            $.ajax({
              url:baseUrl+"/dashboard/update-password",
              type: "POST",
              data:values,
              success: function(result) {
              	$('.btnloader').hide();
                var returnable=$.parseJSON(result);
                var count=1;
                for(var key in returnable){
                    if(returnable[key]=='true'){
                        $('.alert-success').show('fast');
                    }else{
                        if(count==1){
                          $('#'+key).focus();
                      }
                      $('.'+key).addClass('has-error');
                      $('.'+key).append('<span class="help-block">'+returnable[key]+'</span>');
                      count++;
                  }
              }
              console.log(result);
               //window.location.href=baseUrl+'/register-thanks';
              // location.reload();
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
</script>
@endsection
@section('content')
<section class="dash-main clearfix">
<div class="col-md-12 dash-top-second">
	<div class="col-md-6">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_41')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_41')}}</li>
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
@if (session('fails'))
<div class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ session('fails') }}</strong>
</div>
@endif
<form class="form-horizontal change-pwd clearfix p-t-20" role="form" method="POST" action="{{ url('/dashboard/update-password') }}">
            {!! csrf_field() !!}
    <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-12 col-sm-12 m-b-20 password {{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="pwd">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_37')}}<span>*</span></label>
                        <input type="password" name="password" value="{{ old('password') }}" id="password" class="form-control"/>
                        @if ($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                        @endif
                    </div>
                    <div class="col-md-12 col-sm-12 m-b-20 confirm newPassword {{ $errors->has('newPassword') ? ' has-error' : '' }}">
                        <label for="confirm">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_38')}}<span>*</span></label>
                        <input type="password" name="newPassword" value="{{ old('newPassword') }}" id="confirm newPassword" class="form-control confirm"/>
                         @if ($errors->has('newPassword'))
                        <span class="help-block">
                            {{ $errors->first('newPassword') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
             <div class="col-md-12 m-b-20">
    <input type="submit" class="orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_36')}}"  />
    <span class="btnloader">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
    <div class="alert alert-success orange" style="display: none;">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Password Changed Successfully</strong>
</div>
 </div>
           </form>
</div>


</section>

@endsection