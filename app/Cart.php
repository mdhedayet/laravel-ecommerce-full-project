<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use Session;
use App\Product;
use App\ProductsAttribute;

class Cart extends Model
{
    use HasFactory;

    public static function userCartItems()
    {
        if (Auth::check()) {
            $userCartItems = Cart::with(['product'=>function($query)
            {
                $query->select('id','product_name','main_image','product_code','product_color');

            }])->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
        }else {
            $userCartItems = Cart::with(['product'=>function($query){

                $query->select('id','product_name','main_image','product_code','product_color');
                
            }])->where('session_id',Session::get('session_id'))->orderBy('id','Desc')->get()->toArray();
        }
        return $userCartItems;
    }

    public function product()
    {
        return $this->belongsTo('App\Product','product_id');
    }

    public static function getAttrebutePrice($product_id ,$size)
    {
        if ($size=="default") {
            $getAttrebutePrice = Product::select('product_price')->where(['id'=>$product_id])->first()->toArray();
            return $getAttrebutePrice['product_price'];
        }else{
            $getAttrebutePrice = ProductsAttribute::select('price')->where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
            return $getAttrebutePrice['price'];
        }

    }
}
