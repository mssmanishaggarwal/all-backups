@extends('layouts.app')

@section('script')

<script>
$(document).ready(function(){
	
	//var cookieValue = $.cookie("location");	
	if(getCookie('location') == '')
		getLocation();
	else
	{	
		var location_id = getCookie('location');
		$('#search_location').val(location_id);
		autoCompleteCompobox();
		$( "#search_location" ).combobox();
        $( "#toggle" ).click(function() {
        $( "#search_location" ).toggle();
      });
	}
	
	var dateToday = new Date();	
	$("#search_checkin").datepicker({
		dateFormat: "dd/mm/yy",
		minDate: dateToday	
	});
	$("#search_checkout").datepicker({
		dateFormat: "dd/mm/yy",
		minDate: dateToday
	});
	
});
		
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
	var lat = position.coords.latitude;
	var lng = position.coords.longitude;
    
    $.ajax({
			data: {lat:lat, lng:lng},
			type: 'POST',
			url: baseUrl+'/currentlocation',
			dataType: 'html',
			success: function (res) {
				
				$('#search_location').val(res);
				
					autoCompleteCompobox();
					$( "#search_location" ).combobox();
		            $( "#toggle" ).click(function() {
		            $( "#search_location" ).toggle();
		         	});
		         
		         setCookie('location',res,1);
			}
		});
		return false;
}

</script>

<script type="text/javascript">
    window.onload = function() {
		
        $('#search_halltype').niceSelect();
		$('#search_halltype').hide(); 
		
		$('#search_pricerange').niceSelect();
		$('#search_pricerange').hide();
        /* $(function() {
            $( "#search_location" ).combobox();
            $( "#toggle" ).click(function() {
            $( "#search_location" ).toggle();
         });
        }); */          
         
    }
</script>
@endsection

@section('content')
<div class="banner">
	<ul class="bxslider">	
	@foreach($data['bannerList'] as $banner)
			  <li>{{ Html::image('public/uploads/banner/'.$banner->banner_image,$banner->banner_title) }}</li>
	@endforeach				 
	</ul>
            <div class="booking">
            	<div class="bookingheading">
                	<div class="searchheading">
                		<h1>{{ Sitevariable::setVariables($data['language_val'],'eventus_26')}}</h1>
                    </div>
                </div>
                <div class="searchfield">
                <form name="searchFrm" id="searchFrm" method="get" action="{{ url('/search')}}">
                	<div class="clearfix">
                	<div class="search-big">
                    	<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}</label>
                        <select name="search_location" id="search_location">
                             <option value="0"> {{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}</option>                             
                             @foreach($data['locationList'] as $location) 
                             <option value="{{ $location->location_id }}">{{ $location->location_name }}</option>
                             @endforeach                            
                        </select>
                    </div>
                    <div class="search-small">
                   	  <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_18')}}</label>
                        <input type="text" id="search_checkin" name="search_checkin" placeholder="" class="form-control">
                  	</div>
                    <div class="search-small">
                   	  <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_19')}}</label>
                        <input type="text" id="search_checkout" name="search_checkout" placeholder="" class="form-control">
                  </div>
                  </div>
                  <div class="clearfix">
                	<div class="search-big">
                    	<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_20')}}</label>
                        <select name="search_halltype" id="search_halltype">
                             <option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_20')}}</option>                             
                              @foreach($data['hallType'] as $type) 
                             <option value="{{ $type->id }}">{{ $type->hall_type_name }}</option>
                             @endforeach                            
                        </select>
                    </div>
                    <div class="search-small">
                   	  <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_21')}}</label>
                        <select name="search_pricerange" id="search_pricerange">
                             <option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_21')}}</option>     
                             
                             @foreach($data['priceRange'] as $price) 
                             <option value="{{ $price->id }}">{{ $price->price_range_title }}</option>
                             @endforeach                         
                        </select>
                  	</div>
                    <div class="search-small">
                        <input type="submit" placeholder="" class="book-now orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_22')}}">
                    </div>
                  </div>
                  </form>
              </div>
            </div>
            <div class="bottom-header"></div>
</div>
<p id="demo"></p>
 <section class="featuredHalls">
    	<div class="container">
        	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_47')}}</h2>
            <div class="featured-list">            
        	<ul class="grid cs-style-7 clearfix">
        	@foreach($data['featuredHall'] as $hall)
        	
				<li class="col-md-4">				
					<figure>
					<a href="{{ $hall->hall_url }}">
                    	<div class="hall-info">
                        	<div class="loc-price">
                            	<div class="info-location">
                                	{{ $hall->hall_name }}
                                </div>
                                <p>{{ setCurrency($hall->rental_amount) }}</p>
                            </div>
                        </div>
                        </a>
                        {{ Html::image('public/uploads/hall/390x260/'.$hall->hall_image,'Featured image',array('width' => '390','height'=>'260')) }}						
						<figcaption>
						  <h5>{{ $hall->hall_type_name }}</h5>
                          <div class="favourite-icon">                          
                          @if (Auth::guest())
                          <a data-toggle="modal" href='#login-id' onclick="setCookie('clickbtn','myfav_{{$hall->id}}',1);">{{ Html::image('public/images/site/favouriteIcon.png','Favourite icon',array('title'=>'Click to set favourite','width' => '20','height'=>'18')) }} </a>                          
                          @else
                          @if(checkFavourite($hall->id))
                          <a href='javascript:;'>{{ Html::image('public/images/site/favouriteIcon_active.png','Favourite icon',array('title'=>'Already set as favourite','width' => '20','height'=>'18')) }}</a>
                          @else
                          <a href='javascript:;' onclick="setFavorite({{$hall->id}})">{{ Html::image('public/images/site/favouriteIcon.png','Favourite icon',array('title'=>'Click to set favourite','width' => '20','height'=>'18')) }}</a>
                          @endif
                          @endif                          
                          </div>                         
						</figcaption>
					</figure>
				</li>
			
			@endforeach	
			</ul>
        </div>
        </div>
    </section>
	<section class="client-story post">
    	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_48')}}</h2>
        <div class="testimonial">
            <div id="gallery-1" class="royalSlider rsDefault visibleNearby">
            
            @foreach($data['testimonialList'] as $key=>$testimonial)            
            <a class="rsImg" href="public/uploads/testimonial/{{$testimonial->testimonial_image}}" data-rsw="" data-rsh="">
            <div class="counting">{{$key+1}}/{{count($data['testimonialList'])}}</div>
            <p>{{$testimonial->testimonial_content}}</p> 
            <span>{{$testimonial->created_by}}</span>
            </a>            
            @endforeach
            
          </div>
        </div>
    </section>
    <section class="join-with-us">
    	<div class="container">
        	<div class="join-box post clearfix">
            	<div class="join-left">
                	<h1>{{ Sitevariable::setVariables($data['language_val'],'eventus_35')}} <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_34')}}</span></h1>
                </div>
                <div class="join-middle">
                </div>
                <div class="join-right">
                	{!! $data['cmsArr']->cms_content !!}
                	 @if (Auth::guest())
                	 <a data-toggle="modal" href='#login-id' onclick="setCookie('clickbtn','addhall',1);">
                	 	<input type="button" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_34')}}" />
                	 </a>
                	 @else
                	 <a href="{{url('/dashboard/add-my-hall')}}">
                    <input type="button" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_34')}}" />
                    </a>
                    @endif
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
                <h4 class="modal-title">Login</h4><small>(To use this feature login first)</small>
            </div>
            <div class="modal-body">

               @include('auth.poplogin')
                     
                <div class="clear"></div>
            </div>
            
        </div>
    </div>
</div>
<!-- Login popup end -->

@endsection
