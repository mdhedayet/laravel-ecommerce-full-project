<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
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
	@if (isset($page_name) && $page_name=='Index')
        <section id="slider"><!--slider-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                                <li data-target="#slider-carousel" data-slide-to="1"></li>
                                <li data-target="#slider-carousel" data-slide-to="2"></li>
                            </ol>
                            
                            <div class="carousel-inner">
                                <div class="item active">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Free E-Commerce Template</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                        <button type="button" class="btn btn-default get">Get it now</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{asset('images/front_images/home/girl1.jpg')}}" class="girl img-responsive" alt="" />
                                        <img src="{{asset('images/front_images/home/pricing.png')}}"  class="pricing" alt="" />
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>100% Responsive Design</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                        <button type="button" class="btn btn-default get">Get it now</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{asset('images/front_images/home/girl2.jpg')}}" class="girl img-responsive" alt="" />
                                        <img src="{{asset('images/front_images/home/pricing.png')}}"  class="pricing" alt="" />
                                    </div>
                                </div>
                                
                                <div class="item">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Free Ecommerce Template</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                        <button type="button" class="btn btn-default get">Get it now</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{asset('images/front_images/home/girl3.jpg')}}" class="girl img-responsive" alt="" />
                                        <img src="{{asset('images/front_images/home/pricing.png')}}" class="pricing" alt="" />
                                    </div>
                                </div>
                                
                            </div>
                            
                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
	    </section><!--/slider-->
    @endif
	
	
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
	
	

  
    <script src="{{url('js/front_js/jquery.js')}}"></script>
	<script src="{{url('js/front_js/bootstrap.min.js')}}"></script>
	<script src="{{url('js/front_js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{url('js/front_js/price-range.js')}}"></script>
    <script src="{{url('js/front_js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{url('js/front_js/main.js')}}"></script>
</body>
</html>