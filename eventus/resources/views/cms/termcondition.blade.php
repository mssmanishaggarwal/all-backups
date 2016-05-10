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
<section class="content-pages" >
    <div class="container" >

        <h2><span>T</span>ERMS & CONDITION</h2>

        {!! $data['cmsArr']->cms_content !!}






    </div>
</section>
@endsection
