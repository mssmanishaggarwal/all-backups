<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EventUs Angola - {{ $data['heading'] }}</title>
    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <!-- Styles -->
    {{ Html::style('public/css/bootstrap.css') }}
    {{ Html::style('public/css/admin.css') }}
    {{ Html::style('public/fonts/font-awesome.min.css') }}
	{{ Html::style('public/css/bootstrap-datepicker.min.css') }} 
	{{ Html::style('public/css/jquery-ui.css') }}
    <style>
        body {
            font-family: 'Lato';
        }
        .fa-btn {
            margin-right: 6px;
        }
		.current{
			color:#000000;
		}
    </style>   
</head>
<body id="app-layout "class="sidebar-mini fixed">
<div class="overlay" style="display:none;"><div class="loader"><span class="fa fa-cog fa-spin fa-5x fa-fw"></span> Loading...</div></div>

<div><input type="hidden" id="baseUrl" value="{{ url('/') }}"></div>
<?php $sub_menu = ['admin/halltype_list',
	'admin/halltype',
	'admin/halltype/{id}',
	'admin/location_list',
	'admin/location',
	'admin/location/{id}',
	'admin/accommodation_list',
	'admin/accommodation',
	'admin/accommodation/{id}',
	'admin/addon_list',
	'admin/addon',
	'admin/addon/{id}',
	'admin/pricerange_list',
	'admin/pricerange',
	'admin/pricerange/{id}',
];
?>
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="logo">
        <span class="logo-lg">{{ Html::image('public/images/admin/logo.png','Eventus Angola Logo') }}</span>
         <span class="logo-mini">
        {{ Html::image('public/images/admin/logo-sm.png') }}
        </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth()->guard('admins')->user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/admin/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- search form -->

          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">

          <li class="{{ isActiveRoute('admin') }}"><a href="{{ url('/admin') }}">  <i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="treeview {{ areActiveRoutes($sub_menu) }}">
              <a href="#">
                <i class="fa fa-sitemap"></i> <span>Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="{{ areActiveRoutes(['admin/halltype_list', 'admin/halltype','admin/halltype/{id}']) }}"><a href="{{ url('/admin/halltype_list') }}"><i class="fa fa-list-alt"></i>  <span>Hall Type</span></a></li>
                <li class="{{ areActiveRoutes(['admin/location_list', 'admin/location','admin/location/{id}']) }}"><a href="{{ url('/admin/location_list') }}"><i class="fa fa-map"></i> <span>Location</span></a></li>
                <li class="{{ areActiveRoutes(['admin/accommodation_list', 'admin/accommodation','admin/accommodation/{id}']) }}"><a href="{{ url('/admin/accommodation_list') }}"><i class="fa fa-bed"></i> <span>Accommodation</span></a></li>
                <li class="{{ areActiveRoutes(['admin/addon_list', 'admin/addon','admin/addon/{id}']) }}"><a href="{{ url('/admin/addon_list') }}"><i class="fa fa-puzzle-piece"></i> <span>Addon Service</span></a></li>
                <li class="{{ areActiveRoutes(['admin/facilities_list', 'admin/facilities','admin/facilities/{id}']) }}"><a href="{{ url('/admin/facilities_list') }}"><i class="fa fa-taxi"></i> <span>Facilities</span></a></li>
                <li class="{{ areActiveRoutes(['admin/price_range_list', 'admin/price_range','admin/price_range/{id}']) }}"><a href="{{ url('/admin/price_range_list') }}"><i class="fa fa-dollar"></i> <span>Price Range</span></a></li>
              </ul>
            </li>
			<li class="treeview {{ areActiveRoutes($sub_menu) }}">
					<a href="#">
                		<i class="fa fa-picture-o"></i> <span>Banner</span> <i class="fa fa-angle-left pull-right"></i>
              		</a>
					<ul class="treeview-menu">
                		<li class="{{ areActiveRoutes(['admin/homepagebanner_list', 'admin/homepagebanner','admin/homepagebanner/{id}']) }}"><a href="{{ url('/admin/homepagebanner_list') }}"><i class="fa fa-list-alt"></i>  <span>Home Page Banner</span></a></li>
						<li class="{{ areActiveRoutes(['admin/innerpagebanner_list', 'admin/innerpagebanner','admin/innerpagebanner/{id}']) }}"><a href="{{ url('/admin/innerpagebanner_list') }}"><i class="fa fa-list-alt"></i>  <span>Inner Page Banner</span></a></li>
					</ul>
			</li>
            <li class="{{ areActiveRoutes(['admin/user_list', 'admin/user','admin/user/{id}']) }}"><a href="{{ url('/admin/user_list') }}"><i class="fa fa-user"></i>  <span>Users</span></a></li>
						<li class="{{ areActiveRoutes(['admin/hall_list', 'admin/hall','admin/hall/{id}']) }}"><a href="{{ url('/admin/hall_list') }}"><i class="fa fa-university"></i> <span>Hall</span></a></li>
						<li class="{{ areActiveRoutes(['admin/subscription_list', 'admin/subscription','admin/subscription/{id}']) }}"><a href="{{ url('/admin/subscription_list') }}"><i class="fa fa-cube"></i> <span>Subcription</span></a></li>
						<li class="{{ areActiveRoutes(['admin/booking_list', 'admin/booking','admin/booking/{id}']) }}"><a href="{{ url('/admin/booking_list') }}"><i class="fa fa-check-square-o"></i> <span>Booking</span></a></li>
						<!--<li><a href="#"><i class="fa fa-exclamation-circle"></i> <span>Enquiry</span></a></li>-->
						<li class="{{ areActiveRoutes(['admin/review_list', 'admin/review','admin/review/{id}']) }}"><a href="{{ url('/admin/review_list') }}"><i class="fa fa-star"></i> <span>Review / Rating</span></a></li>
						<li class="{{ areActiveRoutes(['admin/payment_list', 'admin/payment','admin/payment/{id}']) }}"><a href="{{ url('/admin/payment_list') }}"><i class="fa fa-dollar"></i> <span>Payment</span></a></li>
						<li class="{{ areActiveRoutes(['admin/advertisement_list', 'admin/advertisement','admin/advertisement/{id}']) }}"><a href="{{ url('/admin/advertisement_list') }}"><i class="fa fa-bullhorn"></i> <span>Advertisement</span></a></li>
						<li class="{{ areActiveRoutes(['admin/testimonial_list', 'admin/testimonial','admin/testimonial/{id}']) }}"><a href="{{ url('/admin/testimonial_list') }}"><i class="fa fa-comments"></i> <span>Testimonial</span></a></li>
						<li class="{{ areActiveRoutes(['admin/news_list', 'admin/news','admin/news/{id}']) }}"><a href="{{ url('/admin/news_list') }}"><i class="fa fa-newspaper-o"></i> <span>News</span></a></li>
						<li class="{{ areActiveRoutes(['admin/faq_list', 'admin/faq','admin/faq/{id}']) }}"><a href="{{ url('/admin/faq_list') }}"><i class="fa fa-question-circle"></i> <span>FAQ</span></a></li>
						<li class="{{ areActiveRoutes(['admin/content_list', 'admin/content','admin/content/{id}']) }}"><a href="{{ url('/admin/content_list') }}"><i class="fa fa-file-text-o"></i> <span>Content</span></a></li>
						<li class="{{ areActiveRoutes(['admin/email_list', 'admin/email','admin/email/{id}']) }}"><a href="{{ url('/admin/email_list') }}"><i class="fa fa-envelope"></i> <span>Email</span></a></li>
						<li class="{{ areActiveRoutes(['admin/settings', 'admin/settings','admin/settings/{id}']) }}"><a href="{{ url('/admin/settings') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>
						<li class="{{ areActiveRoutes(['admin/sitevariable_list', 'admin/sitevariable','admin/sitevariable/{id}']) }}"><a href="{{ url('/admin/sitevariable_list') }}"><i class="fa fa-flag"></i> <span>Site Variable</span></a></li>
						<li><a href="{{url('/admin/logout')}}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>


          </ul>
        </section>

        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
<section class="content-header">
          <h1>{{ $data['heading'] }}</h1>
        <!--<ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Hall Type</li>
          </ol>-->
        </section>

     <section class="content">

@yield('content')

         </section>


 </div>
 <footer class="main-footer">
        <h6 class="text-right">&copy; {{date('Y')}} <a href="http://almsaeedstudio.com">Eventus Angola</a> All rights reserved.</h6>
      </footer>
 </div>
<!-- JavaScripts -->
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
{{ Html::script('public/js/jquery.min.js') }}
{{ Html::script('public/js/bootstrap.min.js') }}
{{ Html::script('public/js/admin/app.js') }}
{{ Html::script('public/js/admin/responsive-tabs.js') }}
{{ Html::script('public/js/admin/datepicker.js') }}
{{ Html::script('public/js/admin/jquery-ui.js') }}
{{ Html::script('public/js/admin/jquery.validate.js') }}
{{ Html::script('public/js/admin/tinymce/tinymce.min.js') }}
{{ Html::script('public/js/admin/common.js') }}
{{ Html::script('public/js/admin/modules/halltype.js') }}
{{ Html::script('public/js/admin/modules/location.js') }}
{{ Html::script('public/js/admin/modules/accommodation.js') }}
{{ Html::script('public/js/admin/modules/addonservices.js') }}
{{ Html::script('public/js/admin/modules/facility.js') }}
{{ Html::script('public/js/admin/modules/pricerange.js') }}
{{ Html::script('public/js/admin/modules/subscription.js') }}
{{ Html::script('public/js/admin/modules/user.js') }}
{{ Html::script('public/js/admin/modules/faq.js') }}
{{ Html::script('public/js/admin/modules/email.js') }}
{{ Html::script('public/js/admin/modules/news.js') }}
{{ Html::script('public/js/admin/modules/testimonial.js') }}
{{ Html::script('public/js/admin/modules/advertisement.js') }}
{{ Html::script('public/js/admin/modules/content.js') }}
{{ Html::script('public/js/admin/modules/homepagebanner.js') }}
{{ Html::script('public/js/admin/modules/hall.js') }}
@yield('script')
</body>
</html>