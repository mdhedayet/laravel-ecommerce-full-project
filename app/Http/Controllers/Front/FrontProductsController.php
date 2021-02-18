<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Pagination\Paginator;
use App\Category;
use App\Product;
use App\Cart;
use App\ProductsAttribute;
use Session;
use Auth;

class FrontProductsController extends Controller
{
    //
    public function listing(Request $request)
    {   
        Paginator::useBootstrap();
        $url = Route::getFacadeRoot()->current()->uri();
        if ($request->ajax()) {

            $data = $request->all();
            //echo '<pre>'; print_r($data); die;

             $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if ($categoryCount>0) {
            # code...
            //echo "Category is there.";
            $CategoryDetails = Category::CategoryDetails($url);
            //echo '<pre>'; print_r($CategoryDetails); die;
            $categoryPrducts = Product::with('brand')->whereIn('category_id',  $CategoryDetails['categoryIds'])->where('status',1);
            $categoryPrductsCount = Product::whereIn('category_id', $CategoryDetails['categoryIds'])->where('status',1)->count();
            //echo '<pre>'; print_r($categoryPrducts); die;

            //filter by fabric
            if(isset($_GET['fabric']) && !empty($_GET['fabric'])) {
                $categoryPrducts->whereIn('products.fabric',$data['fabric']);
            }
            //filter by sleeve
            if(isset($_GET['sleeve']) && !empty($_GET['sleeve'])) {
                $categoryPrducts->whereIn('products.sleeve',$data['sleeve']);
            }
            //filter by pattern
            if(isset($_GET['pattern']) && !empty($_GET['pattern'])) {
                $categoryPrducts->whereIn('products.pattern',$data['pattern']);
            }
            //filter by fit
            if(isset($_GET['fit']) && !empty($_GET['fit'])) {
                $categoryPrducts->whereIn('products.fit',$data['fit']);
            }
            //filter by occassion
            if(isset($_GET['occassion']) && !empty($_GET['occassion'])) {
                $categoryPrducts->whereIn('products.occassion',$data['occassion']);
            }

            if(isset($_GET['sort']) && !empty($_GET['sort'])) {
                if($_GET['sort']=='product_latest'){
                    $categoryPrducts->orderBy('id','Desc');
                }
                else if($_GET['sort']=='product_name_a_z'){
                    $categoryPrducts->orderBy('product_name','Asc');
                }
                else if($_GET['sort']=='product_name_z_a'){
                    $categoryPrducts->orderBy('product_name','Desc');
                }
                else if($_GET['sort']=='product_lowest'){
                    $categoryPrducts->orderBy('product_price','Asc');
                }
                else if($_GET['sort']=='product_highest'){
                    $categoryPrducts->orderBy('product_price','Desc');
                }

            }else {
               
                $categoryPrducts->orderBy('id','Desc');
            }

            $categoryPrducts = $categoryPrducts->paginate(9);

            return view('front.products.ajax_listing')->with(compact('CategoryDetails','categoryPrducts','categoryPrductsCount','url'));
            }
            else {
            abort(404);
            }

        }else {
            $categoryCount = Category::where(['url'=>$url,'status'=>1])->count();
            if ($categoryCount>0) {
            # code...
            //echo "Category is there.";
            $CategoryDetails = Category::CategoryDetails($url);
            //echo '<pre>'; print_r($CategoryDetails); die;
            $categoryPrducts = Product::with('brand')->whereIn('category_id',  $CategoryDetails['categoryIds'])->where('status',1);
            $categoryPrductsCount = Product::whereIn('category_id', $CategoryDetails['categoryIds'])->where('status',1)->count();
            //echo '<pre>'; print_r($categoryPrducts); die;
               
            
            $categoryPrducts = $categoryPrducts->paginate(9);


            $productFilters = Product::productFilters();
            $fabricArray = $productFilters['fabricArray'];
            $sleeveArray = $productFilters['sleeveArray'];
            $patternArray = $productFilters['patternArray'];
            $fitArray = $productFilters['fitArray'];
            $occassionArray = $productFilters['occassionArray'];

            $page_name = "listing";

            return view('front.products.listing')->with(compact('fabricArray','sleeveArray','patternArray','fitArray','occassionArray','page_name','CategoryDetails','categoryPrducts','categoryPrductsCount','url'));
            }
            else {
            abort(404);
            }

        }
    }

    public function detail($id)
    {
        $productDetails = Product::with(['brand','attributes'=>function($query){
            $query->where('status',1);
        },'images','category'])->where('status',1)->find($id)->toArray();
        
        $catid = $productDetails['category']['id'];
        $reletedProduct = Product::with('brand')->where('category_id',$catid)->where('status',1)->limit(10)->get()->toArray();

        foreach ($reletedProduct as $key => $item) {
            if ($item['id']==$id) {
                unset($reletedProduct[$key]);
            }
        }

        $reletedProductChunk = array_chunk($reletedProduct,3);

        $total_stock= ProductsAttribute::where('product_id',$id)->sum('stock');

        //dd($reletedProductChunk); die;
        //dd($productDetails); die;

        return view('front.products.detail')->with(compact('productDetails','reletedProductChunk','total_stock'));
    }

    public function getProductPrice(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            //echo"<pre>"; print_r($data); die;
            $getProductPrice = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first();
            if($data['size']==""){
                $getProductPrice = Product::where(['id'=>$data['product_id']])->first();
                return $getProductPrice->product_price;
            }
            $getProductPrice = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first();
            return $getProductPrice->price;
        }
    }

    public function addtocart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $pattr = ProductsAttribute::where(['product_id'=>$data['product_id']])->first();


            //condition for size select or not ...and set a value for empty size.
            if (!empty($data['size'])) {
                # code...
                $getProductStock = ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
                if ($getProductStock['stock']<$data['quantity']) {
                    # code...
                    $message = "Requre quantity is not available";
                    session::flash('error_message', $message);
                    return redirect()->back();
                }
            }else{
                if(!empty($pattr->size) && $data['page']=='product_detail_page'){
                    $message = "Pleace select product Size.";
                    session::flash('error_message', $message);
                    return redirect()->back();
                }else{
                    $data['size']='default';
                }
            }

            //create session
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                # code...
                $session_id = Session::getId();
                Session::put('session_id',$session_id);
            }

            //check user loged or not loged
            if (Auth::check()) {
                
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
                $user_id = Auth::user()->id;
            }else{
                $countProducts = Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
                $user_id = 0;
            }

            //check Product Already Exist in Your Cart
            if ($countProducts>0) {
                $message = "Product Already Exist in Your Cart.";
                session::flash('error_message', $message);
                return redirect()->back();
            }

            //dd($session_id); die;

            //save to card info
            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id =$user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();

            $message = "Product has been added in Cart.";
            session::flash('success_message', $message);
            return redirect()->back();
        }
    }

    public function cart()
    {
        $userCartItems = Cart::userCartItems();
        //echo "<pre>"; print_r($userCartItems); die;
        $page_name ="cart";
        return view('front.products.cart')->with(compact('page_name','userCartItems'));
    }
}
