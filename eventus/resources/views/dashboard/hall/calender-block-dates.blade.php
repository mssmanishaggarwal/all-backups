@extends('layouts.dashboard')
@section('script')
<script>
jQuery(document).ready(function($){
	var dateToday = new Date();
	$(".datepicker").datepicker({
		dateFormat: "yy-mm-dd",
		minDate: dateToday 
	});
	$('#calender_block_dates').change(function(){
		var selected_option = $(this).val();
		if( selected_option == 'D' ) {
			$('.hide_all_section').css('display', 'none');
			$('.particular_date_select').css('display', 'block');
		} else if( selected_option == 'W' ) {
			$('.hide_all_section').css('display', 'none');
			$('.particular_weekday_select').css('display', 'block');
		} else if( selected_option == 'M' ) {
			$('.hide_all_section').css('display', 'none');
			$('.particular_monthday_select').css('display', 'block');
		} else {
			$('.hide_all_section').css('display', 'none');
		}
	});
	$('.delete_block_value').click(function(){
		var hall_block_id = $(this).parent().find('.hall_block_id').val();
		$.ajax({
		  url: baseUrl+"/dashboard/hall/calender/block-dates-delete",
		  data:{hall_block_id:hall_block_id},
		  type: "POST",
		});
		$('.hall_data_'+hall_block_id).fadeOut("slow");
	});
	$('#calender_block_date_form').submit(function(e){
		var flag = 0;
		if($('#calender_block_dates').val() == 'D') {
			if( $('.start_date').val() == '' ) {
				$('.start_date').addClass('error_pass');
				flag = 1;
			} else {
				$('.start_date').removeClass('error_pass');
			}
			if( $('.end_date').val() == '' ) {
				$('.end_date').addClass('error_pass');
				flag = 1;
			} else {
				$('.end_date').removeClass('error_pass');
			}
		} else if($('#calender_block_dates').val() == 'W') {
			if( $('#recurring_weekday_select').val() == '' ) {
				$('#recurring_weekday_select').addClass('error_pass');
				flag = 1;
			} else {
				$('#recurring_weekday_select').removeClass('error_pass');
			}
		}else if($('#calender_block_dates').val() == 'M') {
			if( $('#recurring_monthday_select').val() == '' ) {
				$('#recurring_monthday_select').addClass('error_pass');
				flag = 1;
			} else {
				$('#recurring_monthday_select').removeClass('error_pass');
			}
		} else {
			flag = 1;
		}
		if( flag == 1 ) {
			e.preventDefault();
		}
		else
		{
			$('.btnloader').show();
		}
	});
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
		<li><a href="{{url('dashboard/my-hall')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</a></li>
		<li><a href="{{url('dashboard/hall/calender')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_155')}}</li>
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
	<li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
	<li role="presentation" class="active"><a href="{{url('/dashboard/hall/calender/block-dates')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_155')}}</a></li>
</ul>
<?php
	$block_types = array(
		'D' => Sitevariable::setVariables($data['language_val'],'eventus_156'),
		'W' => Sitevariable::setVariables($data['language_val'],'eventus_157'),
		'M' => Sitevariable::setVariables($data['language_val'],'eventus_158')
	);
	$weekdays = array(
		'1' => 'Monday',
		'2' => 'Tuesday',
		'3' => 'Wednesday',
		'4' => 'Thursday',
		'5' => 'Friday',
		'6' => 'Saturday',
		'7' => 'Sunday'
	);

?>
<div class="tab-content">
	<div class="display_selected_dates m-b-30">
		@foreach($data['dataset'] as $each)
			<div class="hall_data_{{$each->hall_block_id}}">
				<span><strong>{{$block_types[$each->block_type]}}:</strong></span>
				<span>{{$each->start_date!=NULL?$each->start_date.' to ':''}}</span>
				<span>{{$each->end_date!=NULL?$each->end_date:''}}</span>
				<span>{{$each->week_day!=NULL?$weekdays[$each->week_day]:''}}</span>
				<span>{{$each->month_date!=NULL?$each->month_date:''}}</span>
               <button class="btn btn-primary btn-xs orange cross delete_block_value" type="button"><i class="fa fa-trash-o"></i></button>
				<!--<input type="button" class="delete_block_value" value="Delete"/>-->
				<input type="hidden" class="hall_block_id" value="{{$each->hall_block_id}}"/>
			</div>
		@endforeach
	</div>
    <form class="form-horizontal hallform clearfix" id="calender_block_date_form" role="form" method="POST" action="{{ url('/dashboard/hall/calender/block-dates') }}">
                {!! csrf_field() !!}

		<input type="hidden" name="activity" value="{{$data['todo']}}" />

		<span>{{Sitevariable::setVariables($data['language_val'],'eventus_159')}}</span>
		<select name="calender_block_dates" id="calender_block_dates">
			<option value="">{{Sitevariable::setVariables($data['language_val'],'eventus_160')}}</option>
			@foreach($block_types as $id => $block_type)
				<option value="{{$id}}">{{$block_type}}</option>
			@endforeach
		</select>

		<div class="selection_container">
			<div class="particular_date_select hide_all_section" style="display: none">
				<span>{{Sitevariable::setVariables($data['language_val'],'eventus_161')}}</span>
            	<div class="search-big">
				<input type="text" name="start_date" class="start_date datepicker form-control" placeholder="From" />
                </div>
                <div class="search-big">
				<input type="text" name="end_date" class="end_date datepicker form-control" placeholder="To" />
                </div>
			</div>
			<div class="particular_weekday_select hide_all_section" style="display: none">
				<span>{{Sitevariable::setVariables($data['language_val'],'eventus_162')}}</span>
				<select name="recurring_weekday_select" id="recurring_weekday_select">
					<option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_163')}}</option>
					@foreach($weekdays as $id => $weekday)
						<option value="{{$id}}">{{$weekday}}</option>
					@endforeach
				</select>
			</div>
			<div class="particular_monthday_select hide_all_section" style="display: none">
				<span>{{ Sitevariable::setVariables($data['language_val'],'eventus_164')}}</span>
				<select name="recurring_monthday_select" id="recurring_monthday_select">
					<option value="">{{ Sitevariable::setVariables($data['language_val'],'eventus_163')}}</option>
					<?php for($i=1; $i<=31; $i++) { ?>
						<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					<?php } ?>
				</select>
			</div>
		
		</div>
       <div class="col-md-12 m-b-35 m-t-15 p-l-none">
       		<input type="submit" class="orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_139')}}"  />
       		<span class="btnloader">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
       </div>
    </form>
</div>
</div>
</div>
</section>

@endsection