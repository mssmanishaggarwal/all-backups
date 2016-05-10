@extends('layouts.backend')
@section('script')
<script>
	jQuery(document).ready(function($){
		var baseUrl = $('#baseUrl').val();
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
				url: baseUrl+"/admin/hall_block-dates-delete",
				data:{hall_block_id:hall_block_id},
				type: "POST",
			});
			$('.hall_data_'+hall_block_id).fadeOut("slow");
		});
		$('.block_cancel').click(function(){ 
    		var baseUrl = $('#baseUrl').val();
			window.location.href = baseUrl+'/admin/hall_list';
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
		});
	});
</script>
{{ Html::script('public/js/bootstrap/bootstrap-formhelpers.js') }}
@endsection
@section('content')
 <div id="main" style="display: block !important;">

<?php
if ($data['hall_id'] != '') {
	$saveBtn = 'Save';
}
?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs custom-tab" role="tablist">
		<li role="presentation" ><a href="{{url('/admin/hall')}}/{{$data['hall_id']}}" > <span class="fa fa-list-alt fa-fw"></span> Hall Details</a></li>
		<li role="presentation" ><a href="{{url('/admin/hall_uploadimage/')}}/{{$data['hall_id']}}"><span class="fa fa-upload fa-fw"></span> Upload Photo</a></li>
		<li role="presentation"><a href="{{url('/admin/hall_setlocation')}}/{{$data['hall_id']}}"><span class="fa fa-map"></span> Set Location</a></li>
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
						<li role="presentation" ><a href="{{url('/admin/hall_calender/')}}/{{$data['hall_id']}}"><span class="fa fa-list-alt fa-fw"></span> Calender</a></li>
						<li role="presentation" class="active"><a href="{{url('/admin/hall_block-dates/')}}/{{$data['hall_id']}}"><span class="fa fa-list-alt fa-fw"></span> Block Dates</a></li>
					</ul>
				</div>
				<?php
					$block_types = array(
						'D' => 'Particular Date',
						'W' => 'Recurring Weekly',
						'M' => 'Recurring Monthly'
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
				<div class="box-body" >
				
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
					<!-- <form class="form-horizontal hallform clearfix" role="form" method="POST" action="{{ url('/dashboard/hall/calender/block-dates') }}"> -->
					<form method="POST" id="calender_block_date_form" class="form-horizontal" action="{{url('/').'/admin/hall_block-dates/'.$data['hall_id']}}">
											{!! csrf_field() !!}
			
						<input type="hidden" name="activity" value="{{$data['todo']}}" />
				
						<label>Select Block Type</label>
						<select name="calender_block_dates" id="calender_block_dates">
							<option value="">Select Block Type</option>
							@foreach($block_types as $id => $block_type)
								<option value="{{$id}}">{{$block_type}}</option>
							@endforeach
						</select>
				
						<div class="selection_container">
							<div class="particular_date_select hide_all_section" style="display: none">
								<label>Select Date</label>
											<div class="search-big">
								<input type="text" name="start_date" class="start_date datepicker form-control" />
												</div>
												<div class="search-big">
								<input type="text" name="end_date" class="end_date datepicker form-control" />
												</div>
							</div>
							<div class="particular_weekday_select hide_all_section" style="display: none">
								<label>Select Week Day</label>
								<select name="recurring_weekday_select" id="recurring_weekday_select">
									<option value="">Select Day</option>
									@foreach($weekdays as $id => $weekday)
										<option value="{{$id}}">{{$weekday}}</option>
									@endforeach
								</select>
							</div>
							<div class="particular_monthday_select hide_all_section" style="display: none">
								<label>Select Monthly Day</label>
								<select name="recurring_monthday_select" id="recurring_monthday_select">
									<option value="">Select Day</option>
									<?php for($i=1; $i<=31; $i++) { ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									<?php } ?>
								</select>
						</div>
						
						<!-- </div>
							<div class="col-md-12 m-b-35 m-t-15 p-l-none">
								<input type="submit" class="orange" value="Add"  />
						</div> -->
					
					</div>
						<div class="box-footer text-right" style="clear: both;">                
							<span class="alert alert-success alert-sm save_msg pull-left" style="display: none;">{{ trans('messages.saved') }}</span>
							<button class="btn btn-primary add_more_button add_contact" id="cloneButton"><span class="fa fa-save fa-fw"></span> {{ $data['saveBtn'] }}</button>
							<button type="button" class="btn btn-default block_cancel" id="cloneButton"><span class="fa fa-rotate-left fa-fw"></span> Cancel</button>
							<p><div id="error_msg"></div></p>
						</div>
					</form>
					<style type="text/css">
					
					</style>
				</div>
			</div>
		</div>
	</div>
@endsection
