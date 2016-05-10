@extends('layouts.app')
@section('script')
<script type="text/javascript">
     $(document).on('submit keyup', '.contact-form', function(event) {
            event.preventDefault();
            if(event.type=='submit' ||event.type=='keyup' ){
              var values = {};
              $.each($('.contact-form').serializeArray(), function(i, field) {
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
          	$('.contact-loader').show();
            $('.has-error').removeClass('has-error');
            $('.help-block').remove();
            $('.help-block').removeClass('help-block');
           /* if($('#sum').val()==11){*/

            $.ajax({
              url:baseUrl+"/cms/validate",
              type: "POST",
              data: values,
              success: function(result) {
               // $.parseJSON(re.responseText);
               $('.contact-loader').hide();
               var reslt=$.parseJSON(result);
             $('.sub-contact').html('<div class="alert alert-success orange"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>'+reslt.success+'</strong></div>');
             
             $('.contact-form').find(":text").each(function(){
             	 $( this ).val('');
             });
             $('.fulladdress').val('');
             
           }
       }).error(function(re){
                var returnable=$.parseJSON(re.responseText);
                $('.contact-loader').hide();
                var count=1;
                for(var key in returnable){
                    if(count==1){
                      $('#'+key).focus();
                    }
                    $('.'+key).addClass('has-error');
                    //$('.'+key).append('<span class="help-block">'+returnable[key]+'</span>');
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
<div class="banner">
    <ul class="bxslider">
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner1') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner2') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner3') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner4') }}</li>
    </ul>
</div>
<section class="content-pages contact-us" >
    <div class="container" >
        <h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_17')}}</h2>
        <div class="contact-middle clearfix">
        <div class="col-lg-6 col-md-6 contact-left m-t-30">
        	<div class="contact-address">
            	<!--<p>Sr. Joao Pembele </p>
                <p>Rua Frederik Engels 92-7 o</p>
                <p>LUANDA</p>
                <p>ANGOLA</p>-->
                {!! $data['cmsArr']->cms_content !!}
            </div>
            <div class="contact-map">
            	{{ Html::image('public/images/site/contactmap.jpg','contactmap') }}
            </div>
        </div>
        <div class="col-lg-6 col-md-6 contact-right m-t-30">
        	<p><span><strong>*</strong> {{ Sitevariable::setVariables($data['language_val'],'eventus_32')}}.</span></p>
        	<form class="contact-form clearfix" method="POST">
            <div class="row">
            	<div class="col-md-12 m-b-15">
                	<div class="row">
                    	<div class="col-md-12 col-sm-12 m-b-15 firstname">
                        	<label for="firstname">{{ Sitevariable::setVariables($data['language_val'],'eventus_1')}}<span>*</span></label>
                            <input type="text" name="firstname" id="firstname" class="form-control"/>
                        </div>
                        <div class="col-md-12 col-sm-12 lastname">
                        	<label for="lastname">{{ Sitevariable::setVariables($data['language_val'],'eventus_2')}}<span>*</span></label>
                            <input type="text" name="lastname" id="lastname" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 m-b-15">
                	<div class="row">
                    	<div class="col-md-12 col-sm-12 email">
                        	<label for="email">{{ Sitevariable::setVariables($data['language_val'],'eventus_3')}}<span>*</span></label>
                            <input type="text" name="email" id="email" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 m-b-15">
                	<div class="row">
                    	<div class="col-md-12 col-sm-12 subject">
                        	<label for="sub">{{ Sitevariable::setVariables($data['language_val'],'eventus_49')}}<span>*</span></label>
                            <input type="text" name="subject" id="sub" class="form-control"/>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 m-b-15">
                	<div class="row">
                    	<div class="col-md-12 m-b-15 address">
                        	<label for="firstname">{{ Sitevariable::setVariables($data['language_val'],'eventus_50')}} <span>*</span></label>
                            <textarea class="fulladdress" maxlength="500" name="address"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 m-b-20 sum">
                   <div class="row">
                      <div class="col-md-8 col-sm-8 col-xs-12 ">
                          <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_51')}}<span>*</span></label>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-3 text-right p-r-none">
                          <label> 5 + 6 =</label>
                      </div>
                      <div class="col-md-2 col-sm-2 col-xs-4">
                          <input type="text" name="sum" id="sum" class="form-control"/>
                      </div>
                   </div>
                </div>
                <div class="col-md-12 m-b-15">
                     <input type="submit" class="orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_52')}}"/>
                     <span class="contact-loader" style="display: none;">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
                </div>
                </div>
            </form>
            <div class="sub-contact" style="margin-top: 10px;"></div>
        </div>
        </div>
    </div>
</section>
@endsection
