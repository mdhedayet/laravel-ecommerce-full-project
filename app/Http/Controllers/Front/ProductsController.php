<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    //
    public function listing($url,Request $request)
    {
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
}
