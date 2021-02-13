<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
class IndexController extends Controller
{
    //

    public function index()
    {
        //featured item
        $featuredItem = Product::with('brand')->where('is_featured','Yes')->where('status',1)->get()->toArray();
        $featuredItemChunk = array_chunk($featuredItem,3);

         //new product
        $newProducts = Product::with('brand')->orderBy('id','Desc')->limit(9)->where('status',1)->get()->toArray();
        //$newProducts= json_decode(json_encode($newProducts),true);
        //echo '<pre>'; print_r($newProducts); die;

        //index page name 
        $page_name="Index";

        
        return view('front.index')->with(compact('page_name','featuredItemChunk','newProducts'));
    }
}
