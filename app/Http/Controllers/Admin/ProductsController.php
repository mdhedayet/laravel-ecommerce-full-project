<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Section;
use App\ProductsAttribute;
use App\Category;
use App\ProductsImage;
use Session;
use Image;
use App\Brand;

class ProductsController extends Controller
{
    //
    public function allProducts()
    {
        Session::put('page','products');
        $products =  Product::with(['category','section'])->get();
        //$products = json_decode(json_encode($products),true);
        //echo "<pre>"; print_r($products); die;
        return view('admin.products.products')->with(compact('products'));
    }

    public function UpdateproductStatus(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = $request->all();
            if ($data['status']=='Active') {
                # code...
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'product_id'=>$data['product_id']]);
        }
    }

    public function addEditProduct(Request $request,$id=null)
    {
        Session::put('page','products');
        if ($id=="") {
            $title = "Add Product";
            $product = new Product;
            $productData =array();
            $messsage = 'Product added successfully';
        }else {
            $title = "Edit Product";
            $productData= Product::where('id',$id)->first();
            $product= Product::find($id);
            // $productData = json_decode(json_encode($productData),true);
            // echo "<pre>"; print_r($productData); die;
            $messsage = 'Product update successfully';
        }

         if ($request->isMethod('post')) {
            # code...
            $data=$request->all();
            //$data = json_decode(json_encode($data),true);
            //echo "<pre>"; print_r($data); die;

            //product validation
            $rules = [
                'category_id' => ['required'],
                'product_code' => ['required'],
                'brand_id' => ['required'],
                'product_color' => ['required'],
                'product_price' => ['required','numeric'],
                'product_name' => ['required','min:3'],
                'main_image' => ['mimes:jpeg,png,jpg,gif,svg','max:2048'],
            ];
            $coustomMessages = [
                'category_id.required' => 'Pleace select a Category.',
                'brand_id.required' => 'Pleace select a Brand.',
                'product_name.required' => 'Product Name is required.',
                'product_code.required' => 'Product Code is required.',
                'product_color.required' => 'Product color is required.',
                'product_price.required' => 'Product price is required.',
                'product_price.numeric' => 'Product price must be in numeric.',
                'product_name.min' => 'Product Name must be at least 3 characters.',
                'main_image.mimes' => 'File type must be jpeg,png,jpg,gif,svg formate.',
                'main_image.max' => 'Image size max 2 mb.',
            ];
            $this->validate($request ,$rules,$coustomMessages );

            $keys = array(

                'category_id',
                'section_id',
                'brand_id',
                'product_name',
                'product_code',
                'product_color',
                'product_price',
                'product_discount',
                'product_weight',
                'product_video',
                'main_image',
                'description',
                'wash_care',
                'fabric',
                'pattern',
                'sleeve',
                'fit',
                'occassion',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'is_featured',
                'status',
            );

            foreach ($keys as $key) {
                if(empty($data[$key])) {
                $data[$key] = "";
                }
                if (empty($data['product_discount'])) {
                    $data['product_discount']=0;
                }
                if (empty($data['product_weight'])) {
                    $data['product_weight']=0;
                }
            }

            //die;

            //image upload
            $image_tmp = $request->file('main_image');
            if ($request->hasFile('main_image')) {
                if ($image_tmp->isValid()) {
                    $extantion = $image_tmp->getClientOriginalExtension();
                    $name = time().'.'.$extantion;
                    $large =public_path('images/product_images/large/'.$name);
                    $medium =public_path('images/product_images/medium/'.$name);
                    $small =public_path('images/product_images/small/'.$name);

                    //dd($name,$destinationPath);
                    Image::make($image_tmp)->save($large);
                    Image::make($image_tmp)->resize(520,600)->save($medium);
                    Image::make($image_tmp)->resize(260,300)->save($small);

                    if(!empty($productData['main_image'])){
                        $image_path_large = public_path('images/product_images/large/'.$productData['main_image']);
                        $image_path_medium = public_path('images/product_images/medium/'.$productData['main_image']);
                        $image_path_small = public_path('images/product_images/small/'.$productData['main_image']);
                        unlink($image_path_large);
                        unlink($image_path_medium);
                        unlink($image_path_small);
                    }
                }

            }else if(!empty($data['current_main_image'])){
                    $name=$data['current_main_image'];
            }else{
                $name="";
            }


            //video upload
            if($request->hasFile('product_video')){
                $video_tmp = $request->file('product_video');
                if ($video_tmp->isValid()) {
                    # code...
                    $video_name = $video_tmp->getClientOriginalName();
                    $extantion = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.time().'.'.$extantion;
                    $video_path = public_path('videos/product_videos/');

                    $video_tmp->move($video_path,$videoName);

                    if(!empty($productData['product_video'])){
                        $video_path = public_path('videos/product_videos/'.$productData['product_video']);
                        unlink($video_path);
                    }
                }

            }else if(!empty($data['current_product_video'])){
                    $videoName=$data['current_product_video'];
            }else{
                $videoName='';
            }



            //save product details in product table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->brand_id = $data['brand_id'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->product_video = $videoName;
            $product->main_image = $name;
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occassion = $data['occassion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $data['is_featured'];
            $product->status = 1;
            $product->save();
            Session::flash('success_message',$messsage);
            return redirect('admin/products');
         }

         //filter array
         $fabricArray=array('cotton','polyester','Wool');
         $sleeveArray=array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeve less');
         $patternArray=array('Checked','Plain','Printed','self','solid');
         $fitArray=array('Reguler','Slim');
         $occassionArray=array('Casual','Formal');

         //section with category and sub category
         $categories = Section::with('categories')->get();
         //$categories = json_decode(json_encode($categories),true);
         //echo "<pre>"; print_r($categories); die;


        // Add brands
        $brands = Brand::where('status',1)->get();
        $brands = json_decode(json_encode($brands),true);



        return view('admin.products.add_edit_product')->with(compact('title','fabricArray','sleeveArray','patternArray','fitArray','occassionArray','categories','productData','brands'));
    }

    public function deleteProduct($id)
    {

       $productData= Product::where('id',$id)->first();
        $image_path_large = public_path('images/product_images/large/'.$productData['main_image']);
        $image_path_medium = public_path('images/product_images/medium/'.$productData['main_image']);
        $image_path_small = public_path('images/product_images/small/'.$productData['main_image']);
            //dd($image_path_large);
        if (file_exists($image_path_large)) {
            unlink($image_path_large);
            unlink($image_path_medium);
            unlink($image_path_small);
        }

        $video_path = public_path('videos/product_videos/'.$productData['product_video']);
        if (file_exists($video_path)) {
             unlink($video_path);
        }

        $productData= Product::where('id',$id)->delete();

        return redirect()->back()->with(Session::flash('success_message','product deleted successfuly'));
    }

     public function deleteproductImage($id)
    {
        $productData= Product::where('id',$id)->first();
        $image_path_large = public_path('images/product_images/large/'.$productData['main_image']);
        $image_path_medium = public_path('images/product_images/medium/'.$productData['main_image']);
        $image_path_small = public_path('images/product_images/small/'.$productData['main_image']);
            //dd($image_path_large);
        if (file_exists($image_path_large)) {
            unlink($image_path_large);
            unlink($image_path_medium);
            unlink($image_path_small);
        }
        $product = Product::find($id);
        $product->main_image ="";
        $product->save();

        return redirect()->back()->with(Session::flash('success_message','Image deleted successfuly'));

    }
    public function deleteproductVideo($id)
    {
        $productData= Product::where('id',$id)->first();
        $video_path = public_path('videos/product_videos/'.$productData['product_video']);
         if (file_exists($video_path)) {
             unlink($video_path);
         }
        $product = Product::find($id);
        $product->product_video ="";
        $product->save();

        return redirect()->back()->with(Session::flash('success_message','Video deleted successfuly'));

    }
    public function addeditattribute(Request $request, $id)
    {
        
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;

            foreach ($data['size'] as $key => $value) {
                if (!empty($value)) {

                    $attribute_size = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    $attribute_sku = ProductsAttribute::where('sku', $value)->count();
                    if($attribute_size > 0 && $attribute_sku > 0)
                    {
                         return redirect()->back()->with(Session::flash('error_message','This Size & SKU alrady added.Please add another Size & SKU!'));
                    }


                    if ($attribute_size > 0) {
                        return redirect()->back()->with(Session::flash('error_message','Size alrady added.Please add another Size!'));
                    }
                    if ($attribute_sku > 0) {
                        return redirect()->back()->with(Session::flash('error_message','SKU alrady added.Please add another SKU!'));
                    }

                    $attributes = new ProductsAttribute;
                    $attributes->product_id = $id;
                    $attributes->sku = $data['sku'][$key];
                    $attributes->size = $data['size'][$key];
                    $attributes->price = $data['price'][$key];
                    $attributes->stock = $data['stock'][$key];
                    $attributes->status = 1;
                    $attributes->save();
                }

            }
            return redirect()->back()->with(Session::flash('success_message','Product Attributes added successfuly!'));
        }
        
        $productData = Product::select('id','product_name','product_code','product_color','main_image')->with('attributes')->find($id);
        $title= "Product Attributes";
        $productData = json_decode(json_encode($productData),true);
        //echo "<pre>"; print_r($productData); die;

        return view('admin.products.add_attributes')->with(compact('productData','title'));

    }

    public function editattribute(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $data= $request->all();
            //$data = json_decode(json_encode($data),true);
            //echo "<pre>"; print_r($data); die;

                foreach ($data['attrId'] as $key => $value) {
                    if (!empty($value)) {
                        ProductsAttribute::where(['id'=>$data['attrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                    }

            }
            return redirect()->back()->with(Session::flash('success_message','Product Attributes Update successfuly!'));
         }
    }

    public function UpdateattributeStatus(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = $request->all();
            if ($data['status']=='Active') {
                # code...
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    }

    public function deleteattribute($id)
    {

       $productData= ProductsAttribute::where('id',$id)->delete();

        return redirect()->back()->with(Session::flash('success_message','Attribute deleted successfuly.'));
    }

    public function addimages(Request $request, $id)
    {
        if($request->isMethod('post'))
        {
            //$data= $request->all();
            //$data = json_decode(json_encode($data),true);
            //echo "<pre>"; print_r($data); die;
            //$images=$request->file('images');
            
            if($request->hasFile('images'))
            {
                foreach ($request->file('images') as $image) {
                            $image_tmp =$image;
                            $extantion = $image->getClientOriginalExtension();
                            $name = rand(111,999999) .time().'.'.$extantion;
                            $large =public_path('images/product_images/large/'.$name);
                            $medium =public_path('images/product_images/medium/'.$name);
                            $small =public_path('images/product_images/small/'.$name);

                            //dd($name,$destinationPath);
                            Image::make($image_tmp)->save($large);
                            Image::make($image_tmp)->resize(520,600)->save($medium);
                            Image::make($image_tmp)->resize(260,300)->save($small);

                            //save to database 
                            $productsImage = new ProductsImage;
                            $productsImage->image = $name;
                            $productsImage->product_id = $id;
                            $productsImage->status = 1;
                            $productsImage->save();

                }
                return redirect()->back()->with(Session::flash('success_message','Image Uploaded successfuly.'));
            }


        }
        $productData= Product::with('images')->select('id','product_name','product_code','product_color','main_image')->find($id);
        $productData = json_decode(json_encode($productData),true);
        //echo "<pre>"; print_r($productData); die;
        $title = 'Product Images';
        return view('admin.products.add_images')->with(compact('productData','title'));
    }

    public function deleteimage($id)
    {

        $ProductImage= ProductsImage::where('id',$id)->first();
        $image_path_large = public_path('images/product_images/large/'.$ProductImage->image);
        $image_path_medium = public_path('images/product_images/medium/'.$ProductImage->image);
        $image_path_small = public_path('images/product_images/small/'.$ProductImage->image);
            //dd($image_path_large);
        if (file_exists($image_path_large)) {
            unlink($image_path_large);
            unlink($image_path_medium);
            unlink($image_path_small);
        }
        $ProductImage= ProductsImage::where('id',$id)->delete();

        return redirect()->back()->with(Session::flash('success_message','image deleted successfuly.'));
    }

    public function UpdateimageStatus(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data = $request->all();
            if ($data['status']=='Active') {
                # code...
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id',$data['image_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'image_id'=>$data['image_id']]);
        }
    }
}
