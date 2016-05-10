@extends('layouts.dashboard')
@section('script')
<script type="text/javascript">
	$(function(){
		setTimeout(function() { window.location.href=baseUrl+'/dashboard/hall/subscription'}, 3000);
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
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</h2>
	<ul>
		<li>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</li>
		<li><a href="{{url('dashboard/my-hall')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</a></li>
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
    <li role="presentation" ><a href="{{url('/dashboard/add-my-hall')}}" aria-controls="home" role="tab" data-toggle="tab"><span class="fa fa-list-alt fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_135')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/uploadimage')}}" class="disable_link"><span class="fa fa-upload fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_136')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/addon')}}" class="disable_link"><span class="fa fa-puzzle-piece fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_137')}}</a></li>
    <li role="presentation" ><a href="{{url('/dashboard/hall/accommodation')}}" class="disable_link"><span class="fa fa-bed fa-fw"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_66')}}</a></li>
     <li role="presentation" ><a href="{{url('/dashboard/hall/calender/')}}" ><span class="fa fa-cube"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_138')}}</a></li>
    <li role="presentation" class="active"><a href="{{url('/dashboard/hall/subscription/')}}" ><span class="fa fa-cube"></span> {{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</a></li>
  </ul>
<div class="tab-content">
<h5>{{ Sitevariable::setVariables($data['language_val'],'eventus_127')}}</h5>
<h3>{{ Sitevariable::setVariables($data['language_val'],'eventus_168')}}.</h3>
    <!-- ================= -->



    <!-- ================= -->
</div>
</div>


</section>

@endsection