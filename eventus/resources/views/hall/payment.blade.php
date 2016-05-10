@extends('layouts.app')
@section('script')
<script>
$(document).ready(function(){
	$('#ppl').submit();
});
</script>
@endsection
@section('content')

<section class="content-pages" >
    <div class="container" >
<!--@if (session('status'))
<div class="alert alert-success orange">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
 <strong>{{ session('status') }}</strong>
</div>
@endif-->
        <h2>Payment</h2>
        <p>Please wait, you are redirecting to payment system paypal {{ Html::image('public/images/site/loader.png','loader') }}</p>
        
        <!--<form name="_xclick" action="https://www.paypal.com/cgi-bin/webscr" method="post" id="ppl">-->
<form name="_xclick" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" id="ppl">
	<input type="hidden" name="cmd" value="_xclick">		
	<input type="hidden" name="business" value="citytech.tester@gmail.com">
	<input type="hidden" name="currency_code" value="EUR">
	<input type="hidden" name="no_shipping" value="0">
	<input type="hidden" name="no_note" value="0" />
	<input type="hidden" name="item_name" value="{{ $data['hall_name'] }}" />
	<input type="hidden" name="item_number" value="{{ $data['book_hall_id'] }}" />
	<input type="hidden" name="custom" value="{{ $data['bookingid'] }}" />
	<input type="hidden" name="rm" value="2" />
	<input type="hidden" name="lc" value="AO" />
	<input type="hidden" name="return" value="{{ $data['returnUrl'] }}" />
	<input type="hidden" name="notify_url" value="" />		
	<input type="hidden" name="quantity" value="1" />
	<input type="hidden" name="amount" value="{{ $data['booking_amount'] }}" />
</form>        
    </div>
</section>
@endsection
