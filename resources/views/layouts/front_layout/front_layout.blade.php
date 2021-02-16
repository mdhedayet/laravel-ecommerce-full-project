<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Home | E-Shopper</title>
    <link href="{{url('css/front_css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('css/front_css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{url('css/front_css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{url('css/front_css/price-range.css')}}" rel="stylesheet">
    <link href="{{url('css/front_css/animate.css')}}" rel="stylesheet">
	<link href="{{url('css/front_css/main.css')}}" rel="stylesheet">
	<link href="{{url('css/front_css/responsive.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{url('js/front_js/html5shiv.js')}}"></script>
    <script src="{{url('js/front_js/respond.min.js')}}"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{asset('images/front_images/ico/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/front_images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/front_images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/front_images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/front_images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
    <!--header-->
@include('layouts.front_layout.front_header')
    <!--/header-->
	@include('front.banners.homepage_banner')
	
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
                    <!--sidebar-->
					@include('layouts.front_layout.front_sidebar')
                    <!--/sidebar-->
				</div>
				
				@yield('contant')
			</div>
		</div>
	</section>
    
    <!--Footer-->
    @include('layouts.front_layout.front_footer')
    <!--/Footer-->
	
	

  
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	{{-- <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('plugins/jquery-ui/jquery-ui.min.js')}}"></script> --}}
    <script src="{{url('js/front_js/bootstrap.min.js')}}"></script>
	<script src="{{url('js/front_js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{url('js/front_js/price-range.js')}}"></script>
    <script src="{{url('js/front_js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{url('js/front_js/main.js')}}"></script>
    <script src="{{url('js/front_js/front_scripts.js')}}"></script>
</body>
</html>