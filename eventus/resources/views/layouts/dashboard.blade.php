<!DOCTYPE HTML>
<html lang=en>
<head>
    <title>Eventus Angola</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link href='https://fonts.googleapis.com/css?family=Lato:400,100,300,300italic,400italic,700,700italic,900,100italic' rel='stylesheet' type='text/css'>
    <!-- All css -->
    {{ Html::style('public/css/site/mainstyle.css') }}
    {{ Html::style('public/css/site/bootstrap.css') }}
    {{ Html::style('public/fonts/font-awesome.min.css') }}
    {{ Html::style('public/css/site/jquery.bxslider.css') }}
    {{ Html::style('public/css/site/screen.css') }}
    {{ Html::style('public/css/site/nice-select.css') }}
    {{ Html::style('public/css/site/bootstrapDatepickr-1.0.0.css') }}
    {{ Html::style('public/css/site/component.css') }}
    {{ Html::style('public/css/site/royalslider.css') }}
    {{ Html::style('public/css/site/rs-default.css') }}
    {{ Html::style('public/css/site/animate.css') }}
    {{ Html::style('public/css/site/jquery-ui.css') }}

    <script type="text/javascript">
        var baseUrl ={!!json_encode(url('/'))!!};
        //alert(baseUrl);
    </script>

    {{ Html::script('public/js/site/jquery.min.js') }}
    {{ Html::script('public/js/admin/responsive-tabs.js') }}
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
    {{ Html::script('public/js/site/top.js') }}
    {{ Html::script('public/js/site/common.js') }}
    @yield('script')
 <script>
        jQuery(document).ready(function($){
            if($(window).width() <= 767){
                $("#dash-mob-menu").click(function(){
                    $("#dash-menu").slideToggle("fast");
                })
            }
        });

     /*===============Ajax File Upload==========================*/
      $(document).on('click','.changeImage',function(){
          $('.chng_profileimage').trigger('click');//alert();
      });
      $(document).on('change','.chng_profileimage',function(){
      var file = $('.chng_profileimage')[0].files[0],
        formData = new FormData();
       // console.log(file);
      formData.append('file', file);
      /*===========================================*/
      switch(file.type){
        case 'image/jpeg': case 'image/gif': case 'image/jpg': case 'image/png':
            call_the_ajax();
            readURL(this);
            break;
        default:
            alert("Profile picture accept a .jpeg/.gif/.jpg/.png file only.");
            break;
      }

      /*===========================================*/
      function call_the_ajax(){
       // reader.readAsDataURL(input.files[0]);
      $.ajax(baseUrl+'/dashboard/profile-picture', {
          method: 'POST',
          contentType: false,
          processData: false,
          data: formData
      })

      .then(function success(userInfo) {

       });
      }
    function readURL(input) { //alert();

            var reader = new FileReader();
            //console.log(reader);
            reader.onload = function (e) {
                $('.userImage >img').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);

       }
    })
     /*===============End ofAjax File Upload====================*/
    </script>
</head>

<body>
<?php 
$hall_menu = ['dashboard/my-hall',
			'dashboard/add-my-hall',
			'dashboard/hall/uploadimage',
			'dashboard/hall/uploadimage',
			'dashboard/hall/addon',
			'dashboard/hall/accommodation',
			'dashboard/hall/calender',
			'dashboard/hall/subscription'
			];
?>
    <header>
        <section  class="container-fluid after-login secondary-top-header">
            <div class="logo col-md-2" id="logo">
                <a href="{{ url('/') }}">{{ Html::image('public/images/site/logo.png','Eventus Angola Logo') }}</a>
            </div>
            <div class="header-right">
                <nav>
                    <ul class="clearfix">
                      <li><a href="{{ url('/') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_13')}}</a></li>
                      <li><a href="{{ url('/about-us') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_14')}}</a></li>
                      <li><a href="#">{{ Sitevariable::setVariables($data['language_val'],'eventus_15')}}</a>
							  			<ul>
							  			@foreach(getallHallType(1) as $type)
                                            <li><a href="{{ url('/search?search_halltype='.$type->id) }}">{{$type->hall_type_name}}</a></li>                              
                                    	@endforeach
                                        </ul>
                                  </li>
                    <li><a href="{{ url('/news')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_16')}}</a></li>
                    <li><a href="{{ url('/contact-us')}}">{{ Sitevariable::setVariables($data['language_val'],'eventus_17')}} </a></li>
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
<div class="container-fluid">
   <div class="row">
       <div class="col-md-3 col-lg-2 col-sm-4 dash-left">


        <a id="dash-mob-menu" class="hidden-lg hidden-md hidden-sm">
            {{ Html::image('public/images/site/mobmenu.png','Eventus Angola Logo',array('width' => '40','height'=>'40')) }}</a>
                <!-- <div class="dash-notify hidden-lg hidden-md hidden-sm">
                	<div class="dash-top-user">
                    <div class="userSmallImage">
                    {{ Html::image('public/images/site/dash-smalluser.png','Eventus Angola Logo',array('width' => '38','height'=>'38')) }}
                     </div>
                    	<select>
                            <option value="1">AOA</option>
                            <option value="2">EUR</option>
                        </select>
                    </div>
                    <div class="notification">
                    	<div class="show-no">01</div>
                    </div>
                	<div class="dash-mail">
                    	<div class="show-no">01</div>
                    </div>
                </div> -->
                <div class="dash-user hidden-xs">
                    <div class="userImage">
                    	<div class="changeImage"></div>
                      <?php if (Auth::user()->profile_image != '') {?>
                      <img src="{{ url('/public/uploads/user') }}/<?php echo Auth::user()->profile_image; ?>" height="100" width="100">
                      <?php } else {?>
                      <img src="{{ url('/public/images/site') }}/userNoImage.png" height="100" width="100">
                      <?php }?>
                      <input type="file" name="file" class="chng_profileimage" style="display: none;" />
                    </div>
                    <div class="userInfo">
                        <strong>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</strong>
                        <p>{{Auth::user()->email}}</p>
                    </div>
                </div>
                <ul id="dash-menu">
                  <li class="{{ isActiveRoute('dashboard') }}"><a href="{{ url('/dashboard') }}"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</a></li>
                  <li class="{{ isActiveRoute('dashboard/edit-profile') }}"><a href="{{ url('/dashboard/edit-profile') }}"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_40')}}</a></li>
                  <li class="{{ isActiveRoute('dashboard/change-password') }}"><a href="{{ url('/dashboard/change-password') }}"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_41')}}</a></li>
                  <li class="{{ areActiveRoutes($hall_menu) }}"><a href="{{ url('/dashboard/my-hall') }}"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_123')}}</a></li>
                  <li class="{{ isActiveRoute('dashboard/my-favourite') }}"><a href="{{ url('/dashboard/my-favourite') }}"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_42')}}</a></li>
                  <li class="{{ areActiveRoutes(['dashboard/my-booking','dashboard/booking-on-my-hall']) }}"><a href="{{ url('/dashboard/my-booking') }}"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_43')}}</a></li>
                  <li class="{{ areActiveRoutes(['dashboard/enquiries','dashboard/single/enquiry']) }}"><a href="{{ url('/dashboard/enquiries') }}">
                  <?php if (notifyAtMenu()[0]->cnt != 0) {?>
                  <i class="count">
                  <?php echo notifyAtMenu()[0]->cnt; ?>
                  </i>
                  <?php }?>
                  <span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_44')}}</a></li>
                  <li class="{{ areActiveRoutes(['dashboard/review-&-ratings','dashboard/reviews-on-my-hall']) }}"><a href="{{ url('/dashboard/review-&-ratings') }}"><span></span>{{  Sitevariable::setVariables($data['language_val'],'eventus_45')}}</a></li>
                  <!--<li><a href="#"><span></span>{{ Sitevariable::setVariables($data['language_val'],'eventus_46')}}</a></li>-->
              </ul>
          </div>
          <div class="col-lg-10 col-md-9 col-sm-8 dash-right">
            	<!-- <div class="dash-notify hidden-xs">

                	<div class="dash-top-user">

                     <div class="userSmallImage">
                      {{ Html::image('public/images/site/dash-smalluser.png','Eventus Angola Logo',array('width' => '38','height'=>'38')) }}
                     </div>

                    	<select  onchange="location = this.options[this.selectedIndex].value;">
                            <option value="{{ url('/dashboard') }}">{{ Sitevariable::setVariables($data['language_val'],'eventus_39')}}</option>
                            <option value="{{ url('/logout') }}">Log Out</option>
                        </select>
                        <ul class="language">
                            @foreach($data['languages'] as $lang)
                                <li><a href="javascript:;" onclick="setLanguage('{{ $lang->id }}')">{{strtoupper($lang->lang_short_code)}}</a></li>
                            @endforeach
                            </ul>
                    </div>
                    <div class="notification">
                    	<div class="show-no">01</div>
                    </div>
                	<div class="dash-mail">
                    	<div class="show-no">01</div>
                    </div>
                </div> -->
                @yield('content')

            </div>
        </div>
   </div>


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


</body>
</html>