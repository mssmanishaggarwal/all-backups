           
            
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
            