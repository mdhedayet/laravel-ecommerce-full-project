<?php use App\Cart;?>
@extends('layouts.front_layout.front_layout')
@section('contant')
<section id="cart_items">
    <div class="container">
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
					<?php $total_price = 0; ?>
                    @foreach ($userCartItems as $key=>$item)
					<?php $getAttrebutePrice =Cart::getAttrebutePrice($item['product_id'],$item['size']) ?>
                    <tr>
                        <td class="cart_product">
                            @if(isset($item['product']['main_image']))
                            <?php $product_iamge_path = 'images/product_images/small/'.$item['product']["main_image"]; ?>
                            @else
                            <?php $product_iamge_path =''; ?>
                            @endif
                            @if (!empty($item['product']['main_image']) && file_exists($product_iamge_path))
                            <img style="width: 120px;"
                                src="{{url('images/product_images/small/'.$item['product']['main_image'])}}" alt="" />
                            @else
                            <img style="width: 120px;" src="{{url('images/product_images/small/no-image.jpg')}}"
                                alt="" />
                            @endif
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$item['product']['product_name']}}</a></h4>
                            <p style="margin-top: 10px;"><strong>Product Code:</strong>
                                {{$item['product']['product_code']}}</p>
                            @if (!empty($item['product']['product_color']))
                            <p style="margin-top: -10px;"><strong>Product Color:</strong>
                                {{$item['product']['product_color']}}</p>
                            @endif
                            @if (!empty($item['size']))
                            <p style="margin-top: -10px;"><strong>Product Size:</strong> {{$item['size']}}</p>
                            @endif
                        </td>
                        <td class="cart_price">
                            <p>${{$getAttrebutePrice}}</p>
                        </td>
						<td class="cart_quantity">
								<div class="cart_quantity_button">
									
									<a class="cart_quantity_down ajxValuClass" data-type="minus" data-field="quantity[{{$key+1}}]"> - </a>
									<input class="cart_quantity_input AjaxInputNum" type="text" name="quantity[{{$key+1}}]" value="{{$item['quantity']}}" min="1" max="100" autocomplete="off" size="2">
									<a class="cart_quantity_up ajxValuClass" data-type="plus"
                                        data-field="quantity[{{$key+1}}]"> + </a>
								</div>
							</td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$getAttrebutePrice*$item['quantity']}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
					<?php $total_price = $total_price + ($getAttrebutePrice*$item['quantity']); ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>
<!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>

                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>${{$total_price}}</span></li>
                        <li>Eco Tax <span>$0.00</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$total_price}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection
