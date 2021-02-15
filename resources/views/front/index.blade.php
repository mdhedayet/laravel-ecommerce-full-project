@extends('layouts.front_layout.front_layout')
@section('contant')
 <div class="col-sm-9 padding-right">
        <div class="recommended_items"><!--FEATURES ITEMS-->
        <h2 class="title text-center">FEATURES ITEMS</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($featuredItemChunk as $key => $featuredItem)
                <div class="item @if($key ==1) active @endif">	
                    @foreach ($featuredItem as $item)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <a href="{{url('product/'.$item['id'])}}">
                                            @if(isset($item['main_image']))
                                            <?php $product_iamge_path = 'images/product_images/medium/'.$item["main_image"]; ?>
                                            @else 
                                            <?php $product_iamge_path =''; ?>
                                            @endif
                                            @if (!empty($item['main_image']) && file_exists($product_iamge_path))
                                                <img src="{{url('images/product_images/medium/'.$item['main_image'])}}" alt="" />
                                            @else 
                                                <img src="{{url('images/product_images/medium/no-image.jpg')}}" alt="" />
                                            @endif
                                        </a>
                                        <h2>${{$item['product_price']}}</h2>
                                        <p>{{$item['product_name']}}</p>
                                        <p>Brand: {{$item['brand']['name']}}</p>
                                    </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">
                                    <li><a href="{{url('product/'.$item['id'])}}"><i class="fa fa-eye"></i>View Details</a></li>
                                    <li><a href="#"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
                <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>			
        </div>
    </div><!--/FEATURES ITEMS-->


    <div class="features_items"><!--New Products-->
        <h2 class="title text-center">NEW PRODUCTS</h2>
        @foreach ($newProducts as $item)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                        <div class="productinfo text-center">
                            <a href="{{url('product/'.$item['id'])}}">
                                @if(isset($item['main_image']))
                                <?php $product_iamge_path = 'images/product_images/medium/'.$item["main_image"]; ?>
                                @else 
                                <?php $product_iamge_path =''; ?>
                                @endif
                                @if (!empty($item['main_image']) && file_exists($product_iamge_path))
                                    <img src="{{url('images/product_images/medium/'.$item['main_image'])}}" alt="" />
                                @else 
                                    <img src="{{url('images/product_images/medium/no-image.jpg')}}" alt="" />
                                @endif
                             </a>
                            
                            <h2>${{$item['product_price']}}</h2>
                            <p>{{$item['product_name']}}</p>
                            <p>Brand: {{$item['brand']['name']}}</p>
                        </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{url('product/'.$item['id'])}}"><i class="fa fa-eye"></i>View Details</a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        
    </div><!--New Products-->
    

</div>   
@endsection

