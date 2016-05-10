@extends('layouts.dashboard')
@section('script')
<script type="text/javascript">
function checker(){
	//var baseUrl = $('#baseUrl').val();
	//var page_id=$('.tab-content').data('page');
	$.ajax({
		url: baseUrl+"/dashboard/hall/accommodationchecker",
		data:{},
		type: "POST",
		dataType: "application/json",
		accept: "application/json",
	}).done(function(res){
		//console.log(res);
	}).error(function(err){
		var get=$.parseJSON(err.responseText);
		///console.log(get);
		for(var key in get){
			$('#hall_id_'+get[key].accommodation_id).attr('checked', 'checked');
			$('#acc_id_'+get[key].accommodation_id+' option[value='+get[key].accommodation_number+']').attr('selected','selected');
		}
	});
}
checker();
$(document).on('submit', '.accommodation', function(event) {
	event.preventDefault();
	//var baseUrl = $('#baseUrl').val();
	//var hall_id=$('.tab-content').data('page');
	$('.btnloader').show();
	var accommodation_ids = [];
	var accommodation_numbers = [];
	$("input[name='addon_id[]']:checked").each(function ()
	{
		accommodation_ids.push(parseInt($(this).val()));
		accommodation_numbers.push(parseInt($('#acc_id_'+$(this).val()).val()));
	});
	var tot_data={accommodation_id:accommodation_ids,accommodation_number:accommodation_numbers};
	//console.log(tot_data);
	$.ajax({
		url: baseUrl+"/dashboard/hall/insrtaccommodation",
		data:tot_data,
		type: "POST",
		dataType: "application/json",

}).error(function(err){
		$('.btnloader').hide();
		var get=$.parseJSON(err.responseText);//console.log(get.hall_id);
		if(get.status=='success'){
			$('.alert-success').show('fast');
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
	<div class="col-md-9">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_133')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li><a href="{{url('dashboard/my-hall')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</a></li>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</li>
	</ul>
	</div>
</div>
<style type="text/css">
	input[type="checkbox"]:not(old), input[type="radio"]:not(old) {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    padding: 0;
    width: 17px;
    padding: 0;
    opacity: 10;
}
</style>
<div class="col-md-12 dash-container p-t-20 p-b-20 hallformwrap">
<div class="alert alert-success orange" style="display: none;">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>{{ Sitevariable::setVariables($data['language_val'],'eventus_134')}}</strong>
</div>
  <ul class="nav nav-tabs custom-tab" role="tablist">
    <li role="presentation" ><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
    <li role="presentation" class="active"><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-calendar"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/subscription/')}}" ><span class="fa fa-cube"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
  </ul>
<div class="tab-content">
<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</h5>
    <form class="form-horizontal accommodation clearfix" id="master-file-form" role="form" method="POST" action="{{ url('/dashboard/addhall-validate') }}">
                {!! csrf_field() !!}
              @foreach($data['display_accomn'] as $val)
              <div class="col-md-4 col-sm-6 col-xs-6 x-type p-r-none">
                <div class="form-group">
                <div class="col-sm-6 col-xs-8 p-r-none p-l-none">
                <div class="checkbox"><label><input type="checkbox" class=""  name="addon_id[]" id="hall_id_{{$val->accommodation_id}}" value="{{$val->id}}">{{$val->accommodation_name}}</label></div></div>
                <div class="col-sm-4 col-xs-4 text-left"><select id="acc_id_{{$val->accommodation_id}}" name="quantity[]" class="form-control"><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div>
                </div>
               </div>
              @endforeach
			<div class="clearfix"></div>
                 <div class="col-md-12 m-b-20 m-t-15 clearfix">
        <input type="submit" class="orange" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_139')}}"  />
        <span class="btnloader">{{ Html::image('public/images/site/orange-loader.gif','loader') }}</span>
       </div>
    </form>
</div>
</div>


</section>

@endsection