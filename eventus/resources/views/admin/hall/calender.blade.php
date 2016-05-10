@extends('layouts.backend')
@section('content')
 <div id="main" style="display: block !important;">

<?php
if ($data['hall_id'] != '') {
	$saveBtn = 'Save';
}
?>


<form method="POST" id="master-file-form" novalidate="novalidate" class="form-horizontal" action="{{url('/').'/admin/hall_setlocation/'.$data['hall_id']}}">


  <!-- Nav tabs -->
  <ul class="nav nav-tabs custom-tab" role="tablist">
		<li role="presentation" ><a href="{{url('/admin/hall')}}/{{$data['hall_id']}}" > <span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
		<li role="presentation" ><a href="{{url('/admin/hall_uploadimage/')}}/{{$data['hall_id']}}"><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
		<li role="presentation"><a href="{{url('/admin/hall_addon/')}}/{{$data['hall_id']}}" ><span class="fa fa-puzzle-piece fa-fw"></span> Addon Services</a></li>
		<li role="presentation" ><a href="{{url('/admin/hall_accommodation/')}}/{{$data['hall_id']}}" ><span class="fa fa-bed fa-fw"></span> Accommodation</a></li>
		<li role="presentation" ><a href="{{url('/admin/hall_subscription/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Subscription</a></li>
		<li role="presentation" class="active"><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}" ><span class="fa fa-cube"></span> Calender</a></li>
  </ul>


	<div class="box box-warning">
		<div class="tab-content" data-page="{{$data['hall_id']}}">


			<div role="tabpanel" class="tab-pane active" id="hallDetails">
				<div class="box-header with-border">
					<h3 class="box-title">Calender</h3>
					<ul class="nav nav-tabs custom-tab" role="tablist">
						<li role="presentation" class="active"><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}"><span class="fa fa-list-alt fa-fw"></span> Calender</a></li>
						<li role="presentation" ><a href="{{url('/admin/hall_block-dates/')}}/{{$data['hall_id']}}"><span class="fa fa-list-alt fa-fw"></span> Block Dates</a></li>
					</ul>
				</div>
				<div class="box-body" >
					<div class="calender_container">
						<div id="calendar" class="hall-calender"></div>
						<input type="hidden" class="hall_id" value="{{$data['hall_id']}}" />
					</div>
				</div>
				
				<div class="box-footer text-right">                
					<p><div id="error_msg"></div></p>
				</div>
				<style type="text/css">
				
				</style>
			</div>
		</div>
	</div>
</form>
@endsection
@section('script')
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.min.css" type="text/css">
<link rel="stylesheet" media="print" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.6.1/fullcalendar.print.css" type="text/css">

<script>
jQuery(document).ready(function($){
	var hall_id = $('.hall_id').val();
	var baseUrl = $('#baseUrl').val();
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
			url: baseUrl+"/admin/hall_calender_get_dates",
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
			url: baseUrl+"/admin/hall_calender_get_weekdays",
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
			url: baseUrl+"/admin/hall_calender_get_monthdays",
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
{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection
