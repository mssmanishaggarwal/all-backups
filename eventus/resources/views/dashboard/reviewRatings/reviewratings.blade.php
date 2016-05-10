@extends('layouts.dashboard')
@section('script')
@endsection
@section('content')
<style type="text/css">
	input[type=checkbox]+ span{
		border:1px solid black;
	}
</style>
<section class="dash-main clearfix">
	<div class="col-md-12 dash-top-second">
		<div class="col-md-9">
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_45')}}</h2>
			<ul>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_119')}}</li>
			</ul>
		</div>
	</div>

	<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">
		<div class="alert alert-success orange" style="display: none;">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>{{ Sitevariable::setVariables($data['language_val'],'eventus_120')}}</strong>
		</div>
		<ul class="nav nav-tabs custom-tab" role="tablist">
			<li role="presentation" class="active"><a href="{{url('/dashboard/review-&-ratings')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_119')}}</a></li>
			<li role="presentation" ><a href="{{url('/dashboard/reviews-on-my-hall')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_121')}}</a></li>

		</ul>
		<div class="tab-content my-review">
			<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_119')}}</h5>
			<?php
//print_r($data['my_reviews']);
?>
			<?php foreach ($data['my_reviews'] as $key => $val) {?>
			<div class="col-md-12 reviewall">
				<div class="row">

					<div class="col-md-12 col-sm-12 cust-review">
					<h4><a href="{{url('/')}}/hall/<?php echo base64_encode($val->id); ?>" >{{$val->hall_name}}</a></h4>
					<div class="halllocation">
									<p>{{$val->location_name}}, {{$val->province_name}}</p>
								</div>
						<div class="review">
							<span class="showrating">
								<span style="width:<?php echo $val->review_rating * 20; ?>%;"></span>
							</span>
							<span>Reviewed on {{dateFormat($val->created_at)}}</span>
						</div>
						<p><?php echo $val->review_text; ?></p>

					</div>
				</div>
			</div>
			<?php }?>
			<div style="clear:both;"></div>
		</div>
	</div>


</section>

@endsection