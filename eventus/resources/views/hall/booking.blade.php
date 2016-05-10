@extends('layouts.app')

@section('script')
<script>
$(document).ready(function(){
$('#pay_button').on('click',function(){
	$('#booking_form').validate({
		errorPlacement: function(){
        return false;
    },
    submitHandler:function(){
    		$('#booking_form').submit();
    	}, 
	});
});
});	
</script>

@endsection

@section('content')

 <section class="content-pages">
    	<div class="container">
			<div class="breadcrumb">{!! craeteBreadcrumb($data['breadcrumb']) !!}</div>
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_100')}}</h2>
            <div class="bookhalldetails clearfix">
            <div class="col-md-12 col-lg-12">
            <h3 class="m-t-none">{{ Sitevariable::setVariables($data['language_val'],'eventus_91')}}</h3>
            	<div class="col-md-3 col-sm-3 p-l-none clearfix">
                	<div class="name-review">
                    	<h4>{{$data['hallDetails']->hall_name}}</h4>                        
                    </div>
                    <div class="detailslocation">
                    	<p>{{$data['hallDetails']->location_name}}, {{$data['hallDetails']->province_name}}
                    </div>                    
                </div>
                
                <div class="col-md-3 col-sm-3">                	
                    	<p><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_18')}}:</span> {{$data['hallDetails']->checkin_date}}</p>
                    	<p><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_19')}}:</span> {{$data['hallDetails']->checkout_date}}</p>
                    	<p><span>Total no. of day: </span> {{ $data['totalday'] }}</p>   
                </div>
                
                <div class="col-md-3 col-sm-3 text-right">                	
                    	<p><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_92')}} :</span> {{ setCurrency($data['hallDetails']->rental_amount) }} </p>
                    	@foreach($data['hallAddon'] as $addon)
                    	<p><span>{{$addon->addon_name}} :</span> {{ setCurrency($addon->addon_price) }} </p>     
                    	@endforeach
                    	
                    	<p><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_93')}} <i>(per day)</i> :</span>{{ setCurrency($data['subTotal']) }} </p>              
                </div>
                
                <div class="col-md-3 col-sm-3 text-right">                	
                    	<p><span>{{ Sitevariable::setVariables($data['language_val'],'eventus_94')}} :</span>{{ setCurrency($data['total']) }} </p>                 
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                	<p>{{ Sitevariable::setVariables($data['language_val'],'eventus_95')}} : <span>{{ setCurrency($data['total']) }} </span></p>
                </div>
                </div>
            </div>
            
            <div class="bookhalldetailsform clearfix">
            <div class="col-md-12 col-lg-12 p-r-none">
            <h3 class="m-t-none">{{ Sitevariable::setVariables($data['language_val'],'eventus_96')}}</h3>
            <form name="booking_form" id="booking_form" method="post" action="{{ url('/book-my-hall')}}">
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6 p-l-none">
                        <label for="Firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_1')}}<span>*</span></label>
                        <input type="text" name="first_name" id="first_name" class="form-control required" value="{{$data['userDetails']->first_name}}"/>                       
                    </div>
                    <div class="col-md-6 col-sm-6 p-l-none">
                        <label for="Lastname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_2')}}<span>*</span></label>
                        <input type="text" name="last_name" id="last_name" class="form-control required" value="{{$data['userDetails']->last_name}}"/>     
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6 p-l-none">
                        <label for="email">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_3')}}<span>*</span></label>
                        <input type="text" name="email" id="email" value="{{$data['userDetails']->email}}" class="form-control required email"/>
                        
                    </div>
                    <div class="col-md-6 col-sm-6 p-l-none">
                        <label for="mobile">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_4')}}<span>*</span></label>
                        <input type="text" name="contact_number" id="contact_number" class="form-control required" maxlength="15" value="{{$data['userDetails']->contact_number}}"/>                        
                    </div>
                </div>
            </div>
            
             <div class="col-md-12 m-b-15 p-l-none">
                <div class="row">
                    <div class="col-md-12">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_7')}}<span>*</span></label>
                        <textarea class="fulladdress required" name="address">{{$data['userDetails']->address}}</textarea>                       
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 m-b-15">
                <div class="row">
                    <div class="col-md-6 col-sm-6 p-l-none">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}<span>*</span></label>
                        <select name="city" id="reg_city" class="required" >
                        <option value=""> {{ Sitevariable::setVariables($data['language_val'],'eventus_25')}} {{ Sitevariable::setVariables($data['language_val'],'eventus_8')}}</option>                             
                         @foreach($data['locationList'] as $location) 
                         <option value="{{ $location->location_id }}" @if($location->location_id == $data['userDetails']->city) selected="" @endif>{{ $location->location_name }}</option>
                         @endforeach  
                     </select>
                   </div>                 
             <div class="col-md-6 col-sm-6 p-l-none">
                <label for="postcode">
                {{ Sitevariable::setVariables($data['language_val'],'eventus_10')}}<span></span></label>
                <input type="text" name="postcode" id="postcode" class="form-control" value="{{$data['userDetails']->postcode}}" maxlength="20"/>
            </div>
        	</div>
    		</div>
            
            <div class="col-md-12 m-b-15 p-l-none">
                <div class="row">
                    <div class="col-md-12">
                        <label for="firstname">
                        {{ Sitevariable::setVariables($data['language_val'],'eventus_97')}}</label>
                        <textarea class="fulladdress" name="comment" value=""></textarea>                       
                    </div>
                </div>
            </div>
            <div class="col-md-12 m-b-15 p-l-none">
            <input type="submit" class="orange" id="pay_button" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_98')}}"/>
            </div>
            </form>
            </div>
        </div>
            
        </div>
    </section>

@endsection
