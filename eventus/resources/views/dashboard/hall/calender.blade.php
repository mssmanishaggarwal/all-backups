@extends('layouts.dashboard')
@section('script')
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css" type="text/css">
<link rel="stylesheet" media="print" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css" type="text/css">

<script>
jQuery(document).ready(function($){
	var hall_id = $('.hall_id').val();
	$('#calendar').fullCalendar();
	$('#fc-today-button').click(function() {
    $('#calendar').fullCalendar('today');
  });
  
  $('.fc-today-button, .fc-prev-button, .fc-next-button').on('click', function(){
  		current_month_year = getMonthYear();
  		load_ajax(current_month_year);
  });
  
	function getMonthYear(){
	  var date = $("#calendar").fullCalendar('getDate');
	  var month_int = date.month();
	  var year_int = date.year();
	  
	  return month_int+','+year_int;
	}
	
	load_ajax(getMonthYear());
	function load_ajax(current_month_year) {
		$.ajax({
			url: baseUrl+"/dashboard/hall/calender/get_particular_dates",
			data: {hall_block_id:hall_id},
			type: "POST",
			dataType: 'json',
		}).done(function( response ) {
			$.each(response, function(i, item) {
				$('.fc-body td').each(function(){
					if($(this).attr('data-date') == item) {
						if(!$(this).hasClass('calender_style')) {
							$(this).addClass('calender_style');
						}
					}
				});
			});
		});
		$.ajax({
			url: baseUrl+"/dashboard/hall/calender/get_weekdays",
			data: {hall_block_id:hall_id},
			type: "POST",
			dataType: 'json',
		}).done(function( response ) {
			$.each(response, function(i, item) {
				$('.fc-body .fc-'+item).each(function(){
					if(!$(this).hasClass('calender_style')) {
						$(this).addClass('calender_style');
					}
				});
			});
		});
		$.ajax({
			url: baseUrl+"/dashboard/hall/calender/get_monthdays",
			data: {hall_block_id:hall_id,current_month_year:current_month_year},
			type: "POST",
			dataType: 'json',
		}).done(function( response ) {
			$.each(response, function(i, item) {
				$('.fc-body td').each(function(){
					if($(this).attr('data-date') == item) {
						if(!$(this).hasClass('calender_style')) {
							$(this).addClass('calender_style');
						}
					}
				});
			});
		});
	}
});
</script>
@endsection
@section('content')
<style type="text/css">
    input[type=checkbox]+ span{
        border:1px solid black;
    }
</style>
<section class="dash-main clearfix">
<div class="col-md-12 dash-top-second">
	<div class="col-md-6">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_154')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li><a href="{{url('dashboard/my-hall')}}">My Hall</a></li>
		<li>Calender</li>

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
    <li role="presentation" ><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
     <li role="presentation" class="active"><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-calendar"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/subscription/')}}" class="disable_link"><span class="fa fa-cube"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
  </ul>
<div class="tab-content">
<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</h5>
<ul class="nav nav-tabs custom-tab" role="tablist">
	<li role="presentation" class="active"><a href="{{url('/dashboard/hall/calender/')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
	<li role="presentation" ><a href="{{url('/dashboard/hall/calender/block-dates')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_155')}}</a></li>
</ul>
<div class="tab-content">
	<div class="calender_container">
		<div id="calendar" class="hall-calender"></div>
		<input type="hidden" class="hall_id" value="{{$data['hall_id']}}" />
	</div>
</div>
</div>
</div>
<?php //media="print" 
?>
</section>

@endsection