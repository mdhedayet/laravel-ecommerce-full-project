@extends('layouts.front_layout.front_layout')
@section('contant')
   <div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
<div class = "product-imgs">
          <div class = "img-display">
            <div class = "img-showcase">
              	@if(isset($productDetails['main_image']))
				<?php $product_iamge_path = 'images/product_images/large/'.$productDetails["main_image"]; ?>
				@else 
				<?php $product_iamge_path =''; ?>
				@endif
				@if (!empty($productDetails['main_image']) && file_exists($product_iamge_path))
				<img src="{{url('images/product_images/large/'.$productDetails['main_image'])}}" alt="" />
				@else
				<img src="{{url('images/product_images/medium/no-image.jpg')}}" alt="" />
				@endif
				@foreach ($productDetails['images'] as $image)
              	<img src = "{{url('images/product_images/medium/'.$image['image'])}}" alt = "shoe image">
			  	@endforeach
            </div>
          </div>
          <div class = "img-select">
            <div class = "img-item">
              <a href = "#" data-id = "1">
                @if(isset($productDetails['main_image']))
				<?php $product_iamge_path = 'images/product_images/small/'.$productDetails["main_image"]; ?>
				@else 
				<?php $product_iamge_path =''; ?>
				@endif
				@if (!empty($productDetails['main_image']) && file_exists($product_iamge_path))
				<img style="height: 85px !important; width:85px !important;" src="{{url('images/product_images/small/'.$productDetails['main_image'])}}" alt="" />
				@else
				<img style="height: 85px !important; width:85px !important;" src="{{url('images/product_images/small/no-image.jpg')}}" alt="" />
				@endif
              </a>
            </div>
			@foreach ($productDetails['images'] as $key=> $image)
            <div class = "img-item">
              <a href = "#" data-id = "{{$key+2}}">
                <img style="height: 85px !important; width:85px !important;" src = "{{url('images/product_images/small/'.$image['image'])}}" alt = "shoe image">
              </a>
            </div>
			@endforeach
          </div>
        </div>

</div>
						<div class="col-sm-7">
							<div class="product-information">  <!--/product-information-->
								<h2>{{$productDetails['product_name']}}</h2>
								<p>Product ID: {{$productDetails['product_code']}}</p>
								<p><b><label>Product Size: </label></b> <span>
								<select name="" id="">
									<option value="">Select</option>
									@foreach ($productDetails['attributes'] as $attribute)
										<option value="">{{$attribute['size']}}</option>
									@endforeach
								</select>
								</span></p>
								<span>
									<span>${{$productDetails['product_price']}}</span>
									<label>Quantity:</label>
									<input type="text" value="1" />
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Color:</b> {{$productDetails['product_color']}}</p>
								<p><b>Brand:</b> {{$productDetails['brand']['name']}}</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#reviews" data-toggle="tab">Details</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									@if (!empty($productDetails['description']))
									<p><b>Product Desciption</b></p>
									<p>{{$productDetails['description']}}</p>
									@endif
									<p><b>Product Information</b></p>
									<table class="table table-bordered">
									<tbody>
										@if (!empty($productDetails['brand']['name']))
										<tr>
										<th scope="row">Brand:</th>
										<td>{{$productDetails['brand']['name']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['product_code']['name']))
										<tr>
										<th scope="row">Code:</th>
										<td>{{$productDetails['product_code']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['product_color']))
										<tr>
										<th scope="row">Color:</th>
										<td>{{$productDetails['product_color']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['fabric']))
										<tr>
										<th scope="row">Fabric:</th>
										<td>{{$productDetails['fabric']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['pattern']))
										<tr>
										<th scope="row">Pattern:</th>
										<td>{{$productDetails['pattern']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['sleeve']))
										<tr>
										<th scope="row">Sleeve:</th>
										<td>{{$productDetails['sleeve']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['fit']))
										<tr>
										<th scope="row">Fit:</th>
										<td>{{$productDetails['fit']}}</td>
										</tr>
										@endif
										@if (!empty($productDetails['occassion']))
										<tr>
										<th scope="row">Occassion:</th>
										<td>{{$productDetails['occassion']}}</td>
										</tr>
										@endif
									</tbody>
									</table>
									@if (!empty($productDetails['wash_care']))
									<p><b>Wash Care</b></p>
									<p>{{$productDetails['wash_care']}}</p>
									@endif
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
@if (count($reletedProductChunk)>0)
	<div class="recommended_items"><!--RECOMMENDED ITEMS-->
        <h2 class="title text-center">RECOMMENDED ITEMS</h2>
        
        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($reletedProductChunk as $key => $reletedProduct)
                <div class="item @if($key ==1) active @endif">	
                    @foreach ($reletedProduct as $item)
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
    </div><!--/RECOMMENDED ITEMS-->
	@endif
					
				</div>
@endsection