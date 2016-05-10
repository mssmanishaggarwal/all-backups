<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Login</title>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>
	{{ Html::style('public/css/admin.css') }}
    {{ Html::style('public/css/bootstrap.css') }}
    <!-- Styles -->
    <!--<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout" class="login-bg">
<div class="overlay"></div>
<div><input type="hidden" id="baseUrl" value="{{ url('/') }}"></div>

<div class="admin-body">
@yield('content')
</div>
 

       <!-- JavaScripts -->

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
{{ Html::script('public/js/jquery.min.js') }}
{{ Html::script('public/js/bootstrap.min.js') }}
{{ Html::script('public/js/knockout/dist/knockout.js') }}
{{ Html::script('public/js/knockout-validation/dist/knockout.validation.js') }}
{{ Html::script('public/js/knockout-mapping/knockout.mapping.js') }}
{{ Html::script('public/js/knockout-bootstrap/build/knockout-bootstrap.min.js') }}
{{ Html::script('public/js/knockout-formhelpers.js') }}
{{ Html::script('public/js/admin/jquery.backstretch.min.js') }}
{{ Html::script('public/js/admin/login-soft.js') }}
        



@yield('script')
 <script>
	jQuery(document).ready(function($) {     
		Login.init();
	});
</script>
 
</body>
</html>
