<?php
use App\Section;
$sections =Section::sections();
?>
    <header id="header"><!--header-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="{{url('/')}}"><img src="{{asset('images/front_images/home/logo.png')}}" alt="" /></a>
						</div>
						
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{url('cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								@if (Auth::check())
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>
								@else
								<li><a href="login.html"><i class="fa fa-lock"></i> Login</a></li>
								@endif
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{url('/')}}" class="active"><b>Home</b></a></li>
                                @foreach ($sections as $section)
                                @if (count($section['categories'])>0)
                                    <li class="dropdown"><a href="#">{{$section['name']}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($section['categories'] as $category)
                                            <li style="color: white;"><a href="{{url($category['url'])}}"><strong>{{$category['category_name']}}</strong></a></li>
                                            @foreach ($category['subcategories'] as $subcategory)
                                                <li><a href="{{url($subcategory['url'])}}"><i class='fa fa-angle-double-right'>&nbsp;</i>{{$subcategory['category_name']}}</a></li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </li> 
                                @endif
                                @endforeach
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->