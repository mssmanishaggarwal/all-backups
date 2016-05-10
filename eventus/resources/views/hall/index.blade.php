@extends('layouts.app')

@section('script')
	<script>
    	 $(document).ready(function() {
			$("#content-slider").lightSlider({
                loop:true,
                keyPress:true
            });
            $('#image-gallery').lightSlider({
                gallery:true,
                item:1,
                thumbItem:6,
                slideMargin: 0,
                speed:1000,
                auto:false,
                loop:true,                
                onSliderLoad: function() {
                    $('#image-gallery').removeClass('cS-hidden');
                }  
            });
            
            $('#availability-loader').hide();
		});
		
		(function($){
			$(window).load(function(){
				
				$("#content-2").mThumbnailScroller({
					axis:"y",
					type:"click-thumb",
					theme:"buttons-out"
				});
				
			});
		})(jQuery);
		
$(document).ready(function(){
	var dateToday = new Date();
	$("#checkin_date").datepicker({
		dateFormat: "dd/mm/yy",
		minDate: dateToday	
	});
	$("#checkout_date").datepicker({
		dateFormat: "dd/mm/yy",
		minDate: dateToday
	});
	
	/*$('#check_button').on('click',function(){
		$('#bookFrm').validate({
			errorPlacement: function(){
            return false;
        },
        submitHandler:function(){
        		getAvailability();
        	}, 
		});
	});
	
	$('#book_button').on('click',function(){
		$('#bookFrm').validate({
			errorPlacement: function(){
            return false;
        },
        submitHandler:function(){
        		getAvailability('bookFrm');
        		//$('#bookFrm').submit();
        	}, 
		});
	});*/
	
	$('#bookFrm').validate({
		errorPlacement: function(){
            return false;
        }
	});
	
	 $('#check_button').click(function () {
        if($("#bookFrm").valid())
        getAvailability('check');
    });
    
     $('#book_button').click(function () {             
        //$("#bookFrm").submit();  // validate and submit
        if($("#bookFrm").valid())
        getAvailability('book');
    });
	
});		
    </script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.exp&signed_in=true&libraries=places"></script>    
<script>
	function initMap() {
	var myLatLng = {lat: <?php echo $data['hallDetails']->lat; ?>, lng: <?php echo $data['hallDetails']->lng; ?>};

	var map = new google.maps.Map(document.getElementById('loadmap'), {
    zoom: 16,
    center: myLatLng
	  });

	  var marker = new google.maps.Marker({
	    position: myLatLng,
	    map: map,
	    //title: 'Hello World!'
	  });
	  
}
google.maps.event.addDomListener(window, 'load', initMap);
	
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

 <section class="deatilsHall">
    	<div class="container">
			<div class="breadcrumb">
			{!! craeteBreadcrumb($data['breadcrumb']) !!}
			<!--<a href="{{ url('/')}}"><span>Home</span></a>
			<a href="{{ url('')}}"><span>Search results</span></a>
			<span class="current">{{$data['hallDetails']->hall_name}}</span>-->
			</div>
            
            <div class="col-md-12">
            	<div class="row">
                	<div class="col-md-9 col-sm-8 details-left">
                    <div class="row">
                    
                    <div class="detailsname clearfix">
            	<div class="col-md-9 col-sm-9 clearfix">
                	<div class="name-review">
                    	<h3>{{$data['hallDetails']->hall_name}}</h3>
                        <div class="review">
                             <span class="showrating">
                             	<span style="width:{{$data['ratePercentage']*20}}%"></span>             
                             </span>
                             <span>{{ count($data['hallReview'])}} {{ Sitevariable::setVariables($data['language_val'],'eventus_56')}}</span>
                        </div>
                    </div>
                    <div class="detailslocation">
                    	<p>{{$data['hallDetails']->location_name}}, {{$data['hallDetails']->province_name}}  
                    	<a href="http://maps.google.com/?q={{$data['hallDetails']->g_address}}" target="_blank">{{ Sitevariable::setVariables($data['language_val'],'eventus_59')}}</a></p>
                    </div>
                    <div class="facilitiesicon hidden-xs">
                    @foreach($data['hallFacilities'] as $facilities)
                    @if($facilities->icon_name!='')                    
                    {{ Html::image('public/images/site/facilities/'.$facilities->icon_name,$facilities->facilities_name,array('title'=>$facilities->facilities_name,'width' => '30','height'=>'27')) }}  
                    @else
                    {{ Html::image('public/images/site/facilities/default_icon.jpg',$facilities->facilities_name,array('title'=>$facilities->facilities_name,'width' => '30','height'=>'27')) }}  
                    @endif                          
                    @endforeach
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 text-right">
                	<big class="detailsprice">
                    	{{ setCurrency($data['hallDetails']->rental_amount)}}
                    </big>
                    @if (Auth::guest())
                    <a data-toggle="modal" href='#login-id' class="yellow" onclick="setCookie('clickbtn','enquiry',1);">
                    <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_57')}}</span>
                    </a>
                    @else
                    <a data-toggle="modal" href='#enquiry-id' class="yellow">
                    <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_57')}}</span>
                    </a>
                    @endif
                    <!--<a href="#" class="yellow"><span>ENQUIRY</span></a>-->
                </div>
            </div>
            
                    	<div class="clearfix gallery-details" style="max-width:100%;">
                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                            @foreach($data['hallImage'] as $hallimage)
                                <li data-thumb="{{url('/').'/public/uploads/hall/135x94/'.$hallimage}}">
                                {{ Html::image('public/uploads/hall/855x408/'.$hallimage,'gallery')}}
                                     </li>
                            @endforeach                                  
                            </ul>
            			</div>
                        <div class="col-lg-12 col-md-12 p-r-none p-l-none m-b-35">
                        
                        <div class="map clearfix">
                        	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_60')}}</h3>
                            <!--{{ Html::image('public/images/site/mapdetails.jpg','map', array('width'=>'270', 'height'=>'187'))}}-->
                            <div id="loadmap"></div>
                            <span><a href="http://maps.google.com/?q={{$data['hallDetails']->g_address}}" target="_blank">{{ Sitevariable::setVariables($data['language_val'],'eventus_61')}}</a></span>
                    	</div>
                       
                        </div>
                        <div class="details-overview">
                        	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_62')}}</h3>
                            <p>{{$data['hallDetails']->hall_description}}</p>
                        </div>
                        <div class="customer-review hidden-xs">
                        	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_63')}}</h3>
                            <!--<input type="button" value="Write your review" class="yellow"/>-->
                           @if (Auth::guest())
                          	<a data-toggle="modal" href='#login-id' onclick="setCookie('clickbtn','review',1);">
                            <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_64')}}</span>
                            </a>
                        	@else
                        	<a data-toggle="modal" href='#review-id'>
                            <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_64')}}</span>
                            </a>
                           @endif
                           
                            @foreach($data['hallReview'] as $review)
                            <div class="col-md-12 reviewall">
                            <div class="row">
                            	<div class="col-md-2 col-sm-2 p-l-none clearfix">
                                	<div class="cust-avatar">
                                        <div class="outer">
                                        @if(!empty($review->profile_image))
                                           {{ Html::image('public/uploads/user/'.$review->profile_image,'Avatar',array('width'=>'100','height'=>'100'))}}
                                        @else
                                           {{ Html::image('public/images/site/userNoImage.png','Avatar',array('width'=>'100','height'=>'100'))}}
                                           @endif
                                        </div>
                                    </div>
                                    <div class="customername">
                                    	{{$review->first_name}} {{$review->last_name}}
                                    </div>
                                </div>
                                <div class="col-md-10 col-sm-10 cust-review">
                               	  
                                    <div class="review">
                                        <span class="showrating">
                                        <span style="width:{{$review->review_rating*20}}%"></span>
                                        </span>                                       
                                        <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_65')}} {{dateFormat($review->created_at)}}</span>
                          			</div>
                                    <p>{{$review->review_text}}</p>
                                                                      
                                </div>
                            </div>
                            </div>
							@endforeach
                            
                        </div>
                    </div>
                    </div>
                <div class="col-md-3 col-sm-4 details-right p-r-none p-l-30">
                		<div class="details-hall-type clearfix m-b-30">
                        	<h3 class="m-t-none">{{ Sitevariable::setVariables($data['language_val'],'eventus_20')}}</h3>
               	    		<ul>
               	    		@foreach($data['hallType'] as $val)
                            	<li>{{$val->hall_type_name}} </li>
                            @endforeach
                            </ul>
                    	</div>
                    	
                		<div class="accomodation clearfix m-b-30">
                        	<h3 class="m-t-none">{{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</h3>
               	    		<ul>
               	    		@foreach($data['hallAccommodation'] as $val)
                            	<li><span>{{$val->accommodation_name}} :</span> {{$val->accommodation_number}}</li>
                            @endforeach
                            </ul>
                    	</div>
                          @if (Auth::guest())
                          <a data-toggle="modal" href='#login-id' class="add-to-favourite" onclick="setCookie('clickbtn','myfav_{{$data['hallDetails']->hall_id}}',1);">
                           <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_67')}}</span>
                          </a>                          
                          @else
                          @if(checkFavourite($data['hallDetails']->hall_id))
                          <a href='javascript:;' class="already-favourite"><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_68')}}</span></a>
                          @else
                          <a href='javascript:;' class="add-to-favourite" onclick="setFavorite({{$data['hallDetails']->hall_id}})"><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_67')}}</span></a>
                          @endif
                          @endif
                        
                        <form id="bookFrm" name="bookFrm" method="post" action="{{ url('/book-hall')}}">
                        <div class="availability">
                        	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_69')}}</h3>                            
                              <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_18')}}</label>
                              <input type="text" id="checkin_date" name="checkin_date" placeholder="" class="form-control required" value="">
                              <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_19')}}</label>
                              <input type="text" id="checkout_date" name="checkout_date" placeholder="" class="form-control required" value="">
                              <input type="button" class="orange bookbtn" id="check_button" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_70')}}"/>
                             
                             <p id="availability-loader">{{ Html::image('public/images/site/loader.png','loader') }}</p>
                              <div class="hall-check-result"></div>
                             
                        </div>

                        <div class="add-on-services">
                        	<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_71')}}</h5>
                            <div class="service-add">
                            @foreach($data['hallAddon'] as $key=>$addon)
                            	<span>
                            	<input id="addon_{{$key}}" name="hall_addon[]" type="checkbox" value="{{$addon->addon_id}}">
                                <label for="addon_{{$key}}">{{$addon->addon_name}} <span>({{ setCurrency($addon->addon_price) }})</span></label>
                                </span>
                            @endforeach 
                            	<input type="hidden" name="book_hall_id" value="{{$data['hallDetails']->hall_id}}">
                            	
                            	 <a data-toggle="modal" href='#login-id' id="book_login_open" onclick="setCookie('clickbtn','booknow',1);" style="display: none;">{{ Sitevariable::setVariables($data['language_val'],'eventus_22')}}</a>                        							
                            	 
                                <input type="button" class="orange bookbtn" id="book_button" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_75')}}"/>
                                
                            </div>	
                        </div>
                    </form>
                    
                        <div class="may-like">
                        	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_72')}}</h3>
                            <div id="content-2" class="content light">
                                <ul>
                                @foreach($data['hallSimilar'] as $similar)
                                    <li>
                                    <a href="{{ url('/hall/'.base64_encode($similar->hall_id))}}">
                                     {{ Html::image('public/uploads/hall/275x275/'.$similar->hall_image,'hall')}}
                                    </a>
                                    	<div class="like-info">
                                        	<p><strong>{{$similar->hall_name}}</strong></p>
                                            <div class="detailslocation">
                                                <p>{{$similar->location_name}}, {{$similar->province_name}}</p>
                                            </div>
                                            <div class="review">
                                                <span class="showrating">
				                             	<span style="width:{{$similar->ratePercentage*20}}%"></span>             
				                             	</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach                                  
                                </ul>
                            </div>
                        </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    
<!-- Login popup start -->
<div class="modal fade" id="login-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ Sitevariable::setVariables($data['language_val'],'eventus_23')}}</h4><small>({{ Sitevariable::setVariables($data['language_val'],'eventus_73')}})</small>
            </div>
            <div class="modal-body">

               @include('auth.poplogin')
                     
                <div class="clear"></div>
            </div>
            
        </div>
    </div>
</div>
<!-- Login popup end -->

<!-- Review popup start -->
<div class="modal fade" id="review-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ Sitevariable::setVariables($data['language_val'],'eventus_74')}}</h4>
            </div>
            <div class="modal-body">

               @include('hall.popup_review')
                     
                <div class="clear"></div>
            </div>
            
        </div>
    </div>
</div>
<!-- Review popup end -->

<!-- Review popup start -->
<div class="modal fade" id="enquiry-id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{ Sitevariable::setVariables($data['language_val'],'eventus_57')}}</h4>
            </div>
            <div class="modal-body">

               @include('hall.popup_enquiry')
                     
                <div class="clear"></div>
            </div>
            
        </div>
    </div>
</div>
<!-- Review popup end -->

@endsection
