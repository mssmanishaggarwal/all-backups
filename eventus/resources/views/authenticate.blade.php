@extends('layouts.app')
@section('script')
@endsection
@section('content')
<section class="signupmain">
    <div class="container">
    	<div class="thank-you">
    	@if ($data['msg'] =='error')
    	<h4>Your Registration has been successfully verified. <a href="{{url('/')}}/login">Please login.</a></h4>
    	@else
    	<h4>Your Registration has been successfully verified. <a href="{{url('/')}}/login">Please login.</a></h4>
    	</div>
    	@endif
    </div>
</section>
<style type="text/css">
	.thank-you{
		padding:200px 0 ;
	}
	.thank-you >h4{
		text-align: center;
	}
</style>
@endsection