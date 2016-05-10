@extends('layouts.dashboard')
@section('script')
@endsection
@section('content')
<section class="dash-main clearfix">
	<div class="col-md-12 dash-top-second">
		<div class="col-md-12">
			<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_43')}}</h2>
			<ul>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
				<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_102')}}</li>
			</ul>
		</div>
		
	</div>

	<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">		
		<ul class="nav nav-tabs custom-tab" role="tablist">
			<li role="presentation"><a href="{{url('/dashboard/my-booking')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_103')}}</a></li>
			<li role="presentation" class="active"><a href="{{url('/dashboard/booking-on-my-hall')}}" class="disable_link"><span class="fa fa-bookmark fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_102')}}</a></li>

		</ul>
<div class="table-responsive">
	<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_102')}}</h3>
	@if(count($data['other_booking']) > 0)
		
	<table class="table table-hover myBooking">
		<thead>
			<tr>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_91')}}</th>									
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_110')}}</th>									
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_15')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_104')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_105')}} (AOA)</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_106')}}</th>
				<th>{{ Sitevariable::setVariables($data['language_val'],'eventus_107')}}</th>
			</tr>
		</thead>
		
		<tbody>		
		@foreach($data['other_booking'] as $booking)
		<tr>
			<td><p><i class="fa fa-file-text-o"></i>{{$booking->booking_number}}</p>
			 <p><i class="fa fa-user"></i>{{$booking->booking_first_name}} {{$booking->booking_last_name}}</p>
			 <p><i class="fa fa-envelope-o"></i>{{$booking->booking_email}}</p>
			 </td>
			 <td>
			 <p>{{$booking->user_first_name}} {{$booking->user_last_name}}</p>
			 <p>{{$booking->user_email}}</p>
			 <p>{{$booking->user_contact}}</p>
			 </td>
			<td><p>{{$booking->hall_name}}</p> 
			<p>{{$booking->hall_location_name}}, {{$booking->hall_province_name}}</p>
			<strong>{{ Sitevariable::setVariables($data['language_val'],'eventus_108')}}</strong>
			<p>{!! $booking->addons !!}</p>
			</td>
			<td><p>{{ Sitevariable::setVariables($data['language_val'],'eventus_18')}}: {{dateFormat($booking->check_in)}}</p> <p>{{ Sitevariable::setVariables($data['language_val'],'eventus_19')}}: {{dateFormat($booking->check_in)}}</p></td>
			<td>{{$booking->booking_amount}}</td>
			<td>{{dateTimeFormat($booking->booking_datetime)}}</td>
			<td>{{$data['status_array'][$booking->booking_status]}}</td>
		</tr>
		@endforeach
		</tbody>
	</table>

	@else
	<p>{{ Sitevariable::setVariables($data['language_val'],'eventus_111')}}.</p>	
	@endif
		
	<div style="clear:both;"></div>
</div>
</div>


</section>

@endsection