@extends('layouts.app')
@section('script')

@endsection
@section('content')

<section class="content-pages" >
    <div class="container" >

        <h2>Payment</h2>
        @if($data['payment_status'] == 'S')
        <p>Thanks for making the payment, payment is successful. An email has been sent to your email, {{$data['booking_email']}}. Please check the mail.</p>
        @else
        <p>Thanks for making the payment, payment is pending. An email has been sent to your email, {{$data['booking_email']}}. Please check the mail.</p>
        @endif
    </div>
</section>
@endsection
