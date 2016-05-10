<!DOCTYPE HTML>
<html lang=en>
<head>
<title>Eventus Angola</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
@if(isset($data['cms_id']))
<meta name="title" content="{{ getMetaValue($data['cms_id'],'meta_title',$data['language_val'])}}">
<meta name="descripion" content="{{ getMetaValue($data['cms_id'],'meta_description',$data['language_val'])}}"/>
<meta name="keywords" content="{{ getMetaValue($data['cms_id'],'meta_keyword',$data['language_val'])}}"/>
@endif
<link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,300italic,400italic,700,700italic,900,100italic' rel='stylesheet' type='text/css' />
<!-- All css -->
{{ Html::style('public/css/site/mainstyle.css') }}
{{ Html::style('public/css/site/bootstrap.css') }}
{{ Html::style('public/css/site/jquery.bxslider.css') }}
{{ Html::style('public/css/site/screen.css') }}
{{ Html::style('public/css/site/nice-select.css') }}
{{ Html::style('public/css/site/bootstrapDatepickr-1.0.0.css') }}
{{ Html::style('public/css/site/component.css') }}
{{ Html::style('public/css/site/royalslider.css') }}
{{ Html::style('public/css/site/rs-default.css') }}
{{ Html::style('public/css/site/animate.css') }}
{{ Html::style('public/css/site/jquery-ui.css') }}
{{ Html::style('public/css/site/lightslider.css') }}
{{ Html::style('public/css/site/jquery.mThumbnailScroller.css') }}

<!-- All js -->
<script type="text/javascript">
var baseUrl = {!! json_encode(url('/')) !!};
var authVal = <?php echo Auth::guest()==1? '0':'1'; ?>;
</script>
{{ Html::script('public/js/site/jquery.min.js') }}
{{ Html::script('public/js/site/classie.js') }}
{{ Html::script('public/js/site/modernizr.custom.js') }}
{{ Html::script('public/js/site/jquery.bxslider.js') }}
{{ Html::script('public/js/site/jquery.responsinav.js') }}
{{ Html::script('public/js/site/jquery.nice-select.js') }}
{{ Html::script('public/js/site/bootstrapDatepickr-1.0.0.min.js') }}
{{ Html::script('public/js/site/jquery.royalslider.js') }}
{{ Html::script('public/js/site/toucheffects.js') }}
{{ Html::script('public/js/site/viewportchecker.js') }}
{{ Html::script('public/js/site/jquery-ui.js') }}
{{ Html::script('public/js/site/jquery.validate.js') }}
{{ Html::script('public/js/site/lightslider.js') }}
{{ Html::script('public/js/site/jquery.mThumbnailScroller.js') }}
{{ Html::script('public/js/site/bootstrap.min.js') }}
{{ Html::script('public/js/site/top.js') }}
{{ Html::script('public/js/site/common.js') }}

@yield('script')

</head>
<body>
<?php if(!Session::has('currency_id')){
	Session::put('currency_id', 1);
 } ?>
<header>
<section
@if (Auth::guest())
 class="container-fluid @if($data['secondary_header']==1) secondary-top-header @else top-header @endif"
@else
  class="container-fluid @if($data['secondary_header']==1) secondary-top-header @else top-header @endif after-login"
@endif>
            	<div class="logo col-md-2" id="logo">
            	<a href="{{ url('/') }}">{{ Html::image('public/images/site/logo.png','Eventus Angola Logo') }}</a>
				</div>
   	  <div class="header-right">
                    	<nav>
                            <ul class="clearfix">
                                  <li class="{{ isActiveRoute('/') }}"><a href="{{ url('/') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_13')}}</a></li>
              					  <li class="{{ isActiveRoute('about-us') }}"><a href="{{ url('/about-us') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_14')}}</a></li>
                                  <li class="{{ isActiveRoute('search') }}"><a href="#">{{ Sitevariable::setVariables($data['language_val'],'eventus_15')}}</a>
							  			<ul>
							  			@foreach(getallHallType(1) as $type)
                                            <li><a href="{{ url('/search?search_halltype='.$type->id) }}">{{$type->hall_type_name}}</a></li>                              
                                    	@endforeach
                                        </ul>
                                  </li>
                              <li class="{{ isActiveRoute('news') }}"><a href="{{ url('/news')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_16')}}</a></li>
                              <li class="{{ isActiveRoute('contact-us') }}"><a href="{{ url('/contact-us')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_17')}} </a></li>
                            </ul>
        				</nav>
                        <div class="lang-login">
                        	<ul class="language">
                        	@foreach($data['languages'] as $lang)
                            	<li class="{{ isActivelang($lang->id) }}"><a href="javascript:;" onClick="setLanguage('{{ $lang->id }}')">{{strtoupper($lang->lang_short_code)}}</a></li>
                            @endforeach
                            </ul>
                            <div class="currency">
                            	<select id="currency" onChange="setCurrency(this.options[this.selectedIndex].value)">
                                  <option value="1" @if(session('currency_id') == 1 ) selected="" @endif>AOA</option>
                                  <option value="2" @if(session('currency_id') == 2 ) selected="" @endif>EUR</option>
                                </select>
                            </div>
                            <div class="userlogin">
                            @if (Auth::guest())
                            	<select id="userlogin" onChange="location = this.options[this.selectedIndex].value;">
                                  <option value="{{ url('/login') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_23')}}</option>
                                  <option value="{{ url('/register') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_24')}}</option>
                                </select>
                            @else
                                <select id="userlogin" onChange="location = this.options[this.selectedIndex].value;">
                                  <option value="{{ url('/dashboard') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</option>
                                  <option value="{{ url('/logout') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_81')}}</option>
                                </select>
                            @endif
                            </div>
                        </div>
                </div>


		  </section>
</header>

@yield('content')
<footer class="footer-main post1">
    	<div class="container">
        	<div class="col-md-4 fmenu">
            	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_82')}}</h2>
                <ul class="fmenulinks">
                	<li class="{{ isActiveRoute('/') }}"><a href="{{ url('/') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_13')}}</a></li>
                    <li class="{{ isActiveRoute('about-us') }}"><a href="{{ url('/about-us') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_14')}}</a></li>
                    <li class="{{ isActiveRoute('contact-us') }}"><a href="{{ url('/contact-us') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_17')}}</a></li>
                    <li class="{{ isActiveRoute('news') }}"><a href="{{ url('/news') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_16')}}</a></li>
                    <li><a href="{{url('dashboard/add-my-hall')}}" onclick="setCookie('clickbtn','addhall',1);">{{ Sitevariable::setVariables($data['language_val'],'eventus_34')}}</a></li>
                    <li><a href="#">{{ Sitevariable::setVariables($data['language_val'],'eventus_83')}}</a></li>
                    <li class="{{ isActiveRoute('faq') }}"><a href="{{ url('/faq') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_84')}}</a></li>
                    <!--<li><a href="#">News</a></li>-->
                </ul>
            </div>
          <div class="col-md-3 fconnect">
            	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_85')}}</h2>
                <p><a href="mailto:info@eventusangola.com">info@eventusangola.com</a></p>
            <p>322 65987 4554</p>
              <ul class="fsocial">
               	  <li class="fb"><a href="#"></a></li>
                  <li class="twt"><a href="#"></a></li>
                  <li class="insta"><a href="#"></a></li>
              </ul>
            </div>
            <div class="col-md-5 fnewsletter">
            <form name="newsletterFrm" id="newsletterFrm" method="post">
            	<h2>{{ Sitevariable::setVariables($data['language_val'],'eventus_86')}}</h2>
                <div class="newsletter-subsc">
                <!--<label>{{ Sitevariable::setVariables($data['language_val'],'eventus_3')}}</label>-->
                <input type="text" name="newsletter_email" id="newsletter_email" class="required email" placeholder="Email address"/>
                </div>
                
                <input type="submit" onClick="setNewsletter()" value="{{ Sitevariable::setVariables($data['language_val'],'eventus_99')}}"/>
                <span class="newletter-loader" style="display: none;">{{ Html::image('public/images/site/white-loader.gif','loader') }}</span>
                <span id="newsletter_msg"></span>
            </form>
            </div>
        </div>
        <div class="bottom-footer">
        	<div class="container">
            	<div class="terms">
                	<ul>
                    	<li class="{{ isActiveRoute('terms-and-condition') }}"><a href="{{ url('/terms-and-condition') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_87')}}</a></li>
                        <li class="{{ isActiveRoute('privacy-policy') }}"><a href="{{ url('/privacy-policy') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_88')}}</a></li>
                    </ul>
                </div>
                <div class="copyright">
                	<p>{{ Sitevariable::setVariables($data['language_val'],'eventus_89')}} {{date('Y')}} &copy; Eventus Angola.</p>
                </div>
            </div>
        </div>
</footer>


<div class="modal fade" id="success-modal">
<div class="modal-dialog">
<div class="modal-content">
  <div class="modal-body">    
  </div>

  <div class="modal-footer">
   <!-- <button type="button" data-dismiss="modal" class="btn btn-primary" id="delete">Delete</button>-->
    <button type="button" id="confirm_ok" data-dismiss="modal" class="btn orange">{{ Sitevariable::setVariables($data['language_val'],'eventus_90')}}</button>
  </div>
   </div>
 </div>
</div>

</body>
</html>