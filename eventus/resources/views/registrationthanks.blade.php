@extends('layouts.app')
@section('script')
@endsection
@section('content')
<div class="banner">
    <ul class="bxslider">
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner1') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner2') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner3') }}</li>
        <li>{{ Html::image('public/images/site/banner-listing.jpg','Banner4') }}</li>
    </ul>
</div>
<section class="content-pages">
    <div class="container">
    	<h2>THANK YOU</h2>

    	<p>Please review your mail, {{ $data['reg_email']}} to verify your registration.</p>

    </div>
</section>

@endsection