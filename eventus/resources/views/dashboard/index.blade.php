@extends('layouts.dashboard')
@section('script')
@endsection
@section('content')

<section class="dash-main clearfix">

<div class="col-md-12 dash-top-second">
	<div class="col-md-6">
	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</h2>
	<!-- <ul>
		<li></li>
		<li></li>
	</ul> -->
	</div>
</div>
<div class="col-md-12 dash-container p-t-20 p-b-20">
{{ Sitevariable::setVariables($data['language_val'],'eventus_101')}}
</div>

</section>

@endsection