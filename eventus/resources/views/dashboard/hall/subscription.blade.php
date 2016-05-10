@extends('layouts.dashboard')
@section('script')
<script type="text/javascript">
	var subscription_price=0;
	var feature_price=0;
	var grand_total=0;
$(document).on('change','input[name=subscription]',function(){ //alert();
	subscription_price=0;
	grand_total=0;
	subscription_price=$('input[name=subscription]:checked').data('subscription-price');

	grand_total=grand_total+subscription_price;
	$('.tot-price').html(grand_total);


});
$(document).on('click',"input[name='featured[]']", function(){
	$("input[name='featured[]']:checked").each(function (){
		feature_price=parseFloat($(this).data('featured-price'));
		grand_total=grand_total+feature_price;
		$('.tot-price').html(grand_total);
	});
	$("input[name='featured[]']:not(:checked)").each(function (){
		feature_price=parseFloat($(this).data('featured-price'));
		grand_total=grand_total-feature_price;
		$('.tot-price').html(grand_total);
	});

});
$(document).on('submit','.paynow',function(em){
	em.preventDefault();
	if(subscription_price || feature_price){
		$('.tab-content').addClass('mydiv');
		$('.ajax-loader').show();
		$.ajax({
			url: baseUrl+"/dashboard/hall/subscription/payment",
			data:{
				subscription_price:$('input[name=subscription]:checked').data('subscription-price'),
				subscription_name:$('input[name=subscription]:checked').data('subscription-name'),
				subscription_month:$('input[name=subscription]:checked').data('subscription-month'),
				subscription_id:$('input[name=subscription]:checked').val(),
				featured_price:$("input[name='featured[]']:checked").data('featured-price'),
				featured_name:$("input[name='featured[]']:checked").data('featured-name'),
				featured_month:$("input[name='featured[]']:checked").data('featured-month'),
				featured_id:$("input[name='featured[]']:checked").val(),
				grand_total:grand_total,
			},
			type: "POST",
			dataType: "application/json",
			accept: "application/json",
		}).complete(function(res){
			//$('.tab-content').removeClass('mydiv');
			//$('.ajax-loader').hide();
			var get=$.parseJSON(res.responseText);
			$('.tab-content').html('<h1>'+get.success+'</h1>'+get.form_data);
			//console.log(res.responseText);
		}).error(function(err){
		});
	}else{
		alert('Please select atleast one Subscription or Featured Service.');
	}
});


</script>
@endsection
@section('content')

<section class="dash-main clearfix">
	<div class="col-md-12 dash-top-second">
		<div class="col-md-12">
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_165')}}</h2>
			<ul>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
				<li><a href="{{url('dashboard/my-hall')}}">My Hall</a></li>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</li>
			</ul>
		</div>
	</div>
	<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">
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
		<ul class="nav nav-tabs custom-tab" role="tablist">
			<li role="presentation" ><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
			<li role="presentation" ><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
			<li role="presentation" ><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
			<li role="presentation" ><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
			<li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-calendar"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
			<li role="presentation" class="active"><a href="{{url('/dashboard/hall/subscription/')}}" class="disable_link"><span class="fa fa-cube"></span>  {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
		</ul>
		<div class="tab-content">
			<?php
//echo '<pre>';
//print_r($data['subscription_notification']);
//echo '</pre>';
?>
			@foreach($data['subscription_notification'] as $notify)
			<div class="col-md-6 col-sm-6 col-xs-6 yellow-border m-b-20">
				<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_171')}}</h5>
				<ul class="sub-notify">
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_172')}} : {{ $notify->subscription_name}}.</li>
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_173')}} : {{ $notify->subscription_month}} months.</li>
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_174')}} : {{date("d/m/Y", strtotime($notify->start_date)) }}.</li>
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_175')}} : {{date("d/m/Y", strtotime($notify->expiry_date)) }}.</li>
				</ul>
			</div>
			@endforeach
			@foreach($data['feature_notification'] as $notify)
			<div class="col-md-6 col-sm-6 col-xs-6 green-border m-b-20">
				<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_176')}}</h5>
				<ul class="sub-notify">
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_172')}} : {{ $notify->feature_name}}.</li>
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_173')}} : {{ $notify->feature_month}} months.</li>
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_174')}} : {{date("d/m/Y", strtotime($notify->start_date)) }}.</li>
					<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_175')}} : {{date("d/m/Y", strtotime($notify->expiry_date)) }}.</li>
				</ul>
			</div>

			@endforeach
			<div style="clear:both;"></div>
			<div class="col-md-12 col-sm-12 col-xs-12 ">


				<form class="form-horizontal hallform clearfix paynow" role="form" method="POST" action="{{ url('/') }}">
					{!! csrf_field() !!}
					<?php if (subscriptionAvailability($data['hall_id']) <= 30) {?>
					<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</h5>
					@foreach($data['subscription'] as $val)
					<div class="col-md-4 col-sm-6 col-xs-6 x-type p-r-none p-l-none">
						<div class="form-group">
							<div class="col-sm-7 col-xs-7 p-r-none p-l-none">
								<div class="checkbox"><label>
									<input type="radio" class="subscription"  name="subscription" id="sub_id_{{$val->id}}" value="{{$val->id}}" data-subscription-price="{{$val->subscription_price}}" data-subscription-name="{{$val->subscription_name}}"
									data-subscription-month="{{$val->subscription_month}}">{{$val->subscription_name}}</label></div>
								</div>
								<div class="col-sm-5 col-xs-5 text-left subsc-price">
									{{$val->subscription_price}} AOA
								</div>
							</div>

						</div>
						@endforeach
					<?php }?>
						<div class="clearfix"></div>
						<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_177')}}</h5>

						@foreach($data['featured'] as $val)
						<div class="col-md-12 col-sm-12 col-xs-12 x-type p-r-none">
							<div class="col-md-12 col-sm-12 col-xs-12 x-type p-r-none p-l-none">
								<div class="form-group">
									<div class="col-sm-6 col-xs-7 p-r-none p-l-none">
										<div class="checkbox"><label><input type="checkbox" class="featured"  name="featured[]" id="hall_id_{{$val->id}}" value="{{$val->id}}" data-featured-price="{{$val->featured_price}}" data-featured-name="{{$val->featured_name}}"
											data-featured-month="{{$val->featured_month}}">{{$val->featured_name}}  {{$val->featured_price}} AOA</label></div>
										</div>

									</div>

								</div>
							</div>
							@endforeach

							<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_178')}}</h5>
							<div class="col-md-12 col-sm-12 col-xs-12 x-type p-r-none p-l-none">
								<span class="tot-price">0.00</span><span> AOA</span>
							</div>

							<div class="col-md-12 m-b-35 m-t-15 p-l-none">
								<input type="submit" class="orange" value="PAY NOW"  />
							</div>
						</form>
					</div>
					<div style="clear:both;"></div>
					<!-- ================= -->

					<img src="{{url('/')}}/public/images/site/img-loader.gif" class="ajax-loader" style="display: none;">

					<!-- ================= -->
				</div>
			</div>


		</section>
		<style type="text/css">
			ul.sub-notify li {
				padding-right: 15px;
				font-size: 14px;
				font-weight: 300;
				position: relative;
			}
			ul.sub-notify, li {
				list-style: none;
			}
			.mydiv {
				height: 400px;
				position: relative;
				background-color: gray;
				opacity: 0.5;
			}
			.ajax-loader {
				position: absolute;
				left: 0;
				top: 0;
				right: 0;
				bottom: 0;
				margin: auto; /* presto! */
			}
			input[type=checkbox]+ span{
				border:1px solid black;
			}
			.yellow-border{
				background: #f9f9f9;
				border: 1px solid #f8d711;
				border-radius: 5px 5px 5px 5px;
			}
			.green-border{
				background: #F9F9E4;
				border: 1px solid #f8d711;
				border-radius: 5px 5px 5px 5px;
			}
		</style>
		@endsection