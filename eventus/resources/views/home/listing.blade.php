@extends('layouts.app')

@section('script')
<script type="text/javascript">
    window.onload = function() {        
        autoCompleteCompobox();
        
        $('#search_halltype').niceSelect();
		$('#search_halltype').hide(); 
		
		$('#search_pricerange').niceSelect();
		$('#search_pricerange').hide(); 
		
		$('#sorting').niceSelect();
		$('#sorting').hide(); 
       
         $(function() {
            $( "#search_location" ).combobox();
            $( "#toggle" ).click(function() {
             $( "#search_location" ).toggle();
         });
        });           
         
    }
$(document).ready(function(){
	var dateToday = new Date();
	$("#search_checkin").datepicker({
		dateFormat: "dd/mm/yy",
		minDate: dateToday	
	});
	$("#search_checkout").datepicker({
		dateFormat: "dd/mm/yy",
		minDate: dateToday
	});
	
	$(window).scroll(fetchNextData);
	
	function fetchNextData()
	{		
		var page = $('.endless-pagination').attr('data-next-page');
		
		if(page !== null && page != '')
		{			
			clearTimeout($.data(this, "scrollCheck"));
			$.data(this, "scrollCheck", setTimeout(function(){
				var scroll_position_for_data_load = $(window).height() + $(window).scrollTop() + 350;
				if(scroll_position_for_data_load >= $(document).height())
				{
					$('.infinite-loader').show();										
					$.get(page, function(data){												
						$('.endless-pagination').attr('data-next-page',data.next_page_url);				
						$('.listingrow').append(data.posts);
						$('.infinite-loader').hide();												
					});
				}
			},700))
		}
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
             <div class="booking-listing">
            	<div class="container">
            	
                <div class="searchfield">
                	<a id="bookbysearch">{{ Sitevariable::setVariables($data['language_val'],'eventus_22')}}</a>
                	<form class="book-search clearfix" id="searchbook">
                	<div name="searchFrm" id="searchFrm" method="get" action="{{ url('/search')}}" class="search-big col-md-2">
                    	<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}</label>
                        <select name="search_location" id="search_location">
                             <option value="0"> {{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}</option> 
                             
                             @foreach($data['locationList'] as $location) 
                             <option value="{{ $location->location_id }}" @if($location->location_id == $data['search_location']) selected @endif>{{ $location->location_name }}</option>
                             @endforeach                                                         
                        </select>
                    </div>
                    <div class="search-small col-md-2">
                   	<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_18')}}</label>
                    <input type="text" id="search_checkin" name="search_checkin" placeholder="" class="form-control" value="{{$data['search_checkin']}}">
                  	</div>
                    <div class="search-small col-md-2">
                   	<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_19')}}</label>
                    <input type="text" id="search_checkout" name="search_checkout" placeholder="" class="form-control" value="{{$data['search_checkout']}}">
                  </div>
                	<div class="search-big col-md-2">
                    	<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_20')}}</label>
                        <select name="search_halltype" id="search_halltype">
                             <option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_20')}}</option> 
                             @foreach($data['hallType'] as $type) 
                             <option value="{{ $type->id }}" @if($type->id == $data['search_halltype']) selected @endif>{{ $type->hall_type_name }}</option>
                             @endforeach                           
                        </select>
                    </div>
                    <div class="search-small col-md-2">
                   	   <label>{{ Sitevariable::setVariables($data['language_val'],'eventus_21')}}</label>
                        <select name="search_pricerange" id="search_pricerange">
                             <option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_21')}}</option>   
                             @foreach($data['priceRange'] as $price) 
                             <option value="{{ $price->id }}" @if($price->id == $data['search_pricerange']) selected @endif>{{ $price->price_range_title }}</option>
                             @endforeach                            
                        </select>
                  	</div>
                    <div class="search-small col-md-2">
                        <input type="submit" placeholder="" class="book-now orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_22')}}">
                    </div>
                    </form>
              </div>
              </div>
            </div>
</div>

<section class="listingHalls">
				
    	<div class="container">
    	<div class="breadcrumb">
            	{!! craeteBreadcrumb($data['breadcrumb']) !!}
            	</div>
        	<h2>EVENTUS {{ Sitevariable::setVariables($data['language_val'],'eventus_22')}}</h2>
            <div class="sortinglist">
            	<span>{{ Sitevariable::setVariables($data['language_val'],'eventus_76')}}:</span>
                <select id="sorting" onchange="sortHallListing(this.value)">
                   <option value="sbr" @if($data['order_by'] == 'sbr') selected="" @endif>{{ Sitevariable::setVariables($data['language_val'],'eventus_77')}}</option>
                   <option value="phtl" @if($data['order_by'] == 'phtl') selected="" @endif>{{ Sitevariable::setVariables($data['language_val'],'eventus_78')}}</option>
                   <option value="plth" @if($data['order_by'] == 'plth') selected="" @endif>{{ Sitevariable::setVariables($data['language_val'],'eventus_79')}}</option>
                </select>
            </div>                       
            <div class="listingrow clearfix endless-pagination" data-next-page ="{{$data['next_page_url']}}">
            @if(count($data['hallList'])==0)
            <span>{{ Sitevariable::setVariables($data['language_val'],'eventus_80')}}.</span>
            @endif
            @foreach($data['hallList'] as $hall)
            	<div class="col-md-6 col-xs-6">
                	<div class="hallbox clearfix featuredhall">
                	<a href="{{ $hall->hall_url }}">
                        <div class="hallbox-photo">
                        {{ Html::image('public/uploads/hall/275x275/'.$hall->hall_image,'Hall image',array('width' => '275','height'=>'270')) }}                  
                            
                            <span class="price">{{setCurrency($hall->rental_amount)}}</span>
                            <div class="featured">
                            {{ Html::image('public/images/site/featuredtag.png','Image1',array('width' => '116','height'=>'63')) }}                            
                            	
                            </div>
                        </div>
                    </a>
                        <div class="hallbox-info">
                        <a href="{{ $hall->hall_url }}">
                            <h4>{{$hall->hall_name}}</h4>
                            <div class="halllocation">
                                <p>{{$hall->location_name}}, {{$hall->province_name}}</p>
                            </div>
                            <div class="review">
                                <span class="showrating">
                                <span style="width:{{$hall->ratePercentage*20}}%"></span>
                               </span>
                                <span>{{$hall->totalReview}} {{ Sitevariable::setVariables($data['language_val'],'eventus_56')}}</span>
                          </div>
                            <ul class="hallpurpose">
                            @foreach($hall->hall_type_name as $key=>$type)
                            @if($key < 5)
                                <li>{{$type}}</li>
                            @elseif($key == 5)
                            	<li>more....</li>
                            @endif
                            @endforeach 
                            </ul>
                            <input type="button" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_75')}}" class="yellow"/>
                            </a>
                            <div class="wishlisticon">
                            <!--<a href="#">
                            {{ Html::image('public/images/site/wishlisticon.png','icon',array('width' => '20','height'=>'18')) }}                    
                           </a>-->
                           @if (Auth::guest())
                          <a data-toggle="modal" href='#login-id' onclick="setCookie('clickbtn','myfav_{{$hall->id}}',1);">{{ Html::image('public/images/site/wishlisticon.png','Favourite icon',array('title'=>'Click to set favourite','width' => '20','height'=>'18')) }} </a>                          
                          @else
                          @if(checkFavourite($hall->id))
                          <a href='javascript:;'>{{ Html::image('public/images/site/wishlisticon_active.png','Favourite icon',array('title'=>'Already set as favourite','width' => '20','height'=>'18')) }}</a>
                          @else
                          <a href='javascript:;' onclick="setFavorite({{$hall->id}})">{{ Html::image('public/images/site/wishlisticon.png','Favourite icon',array('title'=>'Click to set favourite','width' => '20','height'=>'18')) }}</a>
                          @endif
                          @endif
                           </div>
                        </div>
                        <div class="moreicon"><a href="{{ $hall->hall_url }}">
                        {{ Html::image('public/images/site/moreIcon.png','icon',array('width' => '52','height'=>'45')) }}
                        	
                        </a></div>                        
                    </div>
            </div>
            @endforeach 
            
            @if(count($data['advDetails']))
            <div class="advertise">
				<a href="{{$data['advDetails']->advertisement_link}}" target="_blank" onclick="clickCount('{{$data['advDetails']->id}}')">{{ Html::image('public/uploads/advertisement/'.$data['advDetails']->advertisement_image,'Advertisement',array('width' => '1127','height'=>'270')) }}  </a>
			</div>
			@endif   
            </div>
			<div class="infinite-loader" style="display: none;">{{ Html::image('public/images/site/loader.png','loader') }}</div>
					   
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

@endsection
