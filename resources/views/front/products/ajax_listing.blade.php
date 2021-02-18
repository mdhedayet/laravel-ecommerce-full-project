 <div class="col-sm-12">
 @if (Session::get('error_message'))
        <div class="col-12">
            <div class="alert alert-danger text-center " role="alert">
                {{Session::get('error_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        @if (Session::get('success_message'))
        <div class="col-12">
            <div class="alert alert-success text-center " role="alert">
                {{Session::get('success_message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
 </div>
 @foreach ($categoryPrducts as $product)
 <form action="{{url('/add-to-cart')}}" method="POST">
    @csrf
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <a href="{{url('product/'.$product['id'])}}">
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
                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                    <input type="hidden" name="size" value="">
                    <input type="hidden" name="page" value="">
                    <input type="hidden" name="quantity" value="1">
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="{{url('product/'.$product['id'])}}"><i class="fa fa-eye"></i>View Details</a></li>
                        <li><button type="submit" ><i class="fa fa-shopping-cart"></i>Add to cart</button></li>
                    </ul>
                </div>
            </div>
        </div>
 </form>
        @endforeach