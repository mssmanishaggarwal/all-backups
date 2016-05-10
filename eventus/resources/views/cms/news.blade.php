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
<section class="eventus-news" >
    <div class="container" >

        <h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_16')}}</h2>
        @if(count($data['news']) == 0)
        <p>There is no news to show.</p>
        @endif
        @foreach($data['news'] as $news)
		<div class="col-lg-12 col-md-12 news-container p-t-20 p-b-20 p-l-none p-r-none m-t-20 post">
        	<div class="col-lg-3 col-md-3 col-sm-3 newsimage">
        	@if($news->news_image)
            	{{ Html::image('public/uploads/news/'.$news->news_image,'news1') }}
            @endif
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 newsdetail">
            	<h4 class="m-t-none">{{ $news->news_title }} <span>{{ dateFormat($news->published_date) }}</span></h4>
               {!! $news->news_content !!}
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
