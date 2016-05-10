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
<section class="content-pages faq" >
    <div class="container" >
        <h2>FAQ</h2>        
        <div class="col-lg-12 col-md-12 col-sm-12">
        @if(count($data['faq']) == 0)
        <p>There is no faq to show.</p>
        @endif
        	<div class="faq-container">  
        	@foreach($data['faq'] as $faq)      	
            	<div class="faq-section">
                	<div class="question-faq">{{$faq->faq_title}}</div>
                    <div class="answer-faq">
                    	{!! $faq->faq_content !!}
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
