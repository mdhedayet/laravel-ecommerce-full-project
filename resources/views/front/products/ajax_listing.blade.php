 @foreach ($categoryPrducts as $product)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="#">
                            @if(isset($product['main_image']))
                            <?php $product_iamge_path = 'images/product_images/medium/'.$product["main_image"]; ?>
                            @else 
                            <?php $product_iamge_path =''; ?>
                            @endif
                            @if (!empty($product['main_image']) && file_exists($product_iamge_path))
                            <img src="{{url('images/product_images/medium/'.$product['main_image'])}}" alt="" />
                            @else
                            <img src="{{url('images/product_images/medium/no-image.jpg')}}" alt="" />
                            @endif
                        </a>

                        <h2>${{$product['product_price']}}</h2>
                        <p>{{$product['product_name']}}</p>
                        <p>Brand: {{$product['brand']['name']}}</p>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-expand"></i>View Details</a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i>Add to cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach