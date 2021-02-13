<?php use App\Banner;
$getBanners = Banner::getBanners();
?>
@if (isset($page_name) && $page_name=='Index')
        <section id="slider"><!--slider-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                @foreach ($getBanners as $key => $banner)
                                <li data-target="#slider-carousel" data-slide-to="{{$key}}" @if($key==0)class="active"@endif></li>
                                @endforeach
                            </ol>
                            
                            <div class="carousel-inner">
                                @foreach ($getBanners as $key =>$banner)
                                <div class="item @if($key==0)active @endif">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>{{$banner['title']}}</h2>
                                        <p>{{$banner['description']}}</p>
                                        <button type="button" class="btn btn-default get">Buy Now</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{asset('images/banner_images/'.$banner['image'])}}" class="girl img-responsive" alt="{{$banner['alt']}}" />
                                        <img src="{{asset('images/front_images/home/pricing.png')}}"  class="pricing" alt="" />
                                    </div>
                                </div>
                                @endforeach
                                
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