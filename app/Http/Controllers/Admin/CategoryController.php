<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\Section;
use Session;
use Image;

class CategoryController extends Controller
{
    //
    public function categories()
    {
        Session::put('page','categories');
        $categories = Category::with(['section','parentcategory'])->get();
        //$categories = json_decode(json_encode($categories),true);
        //echo "<pre>"; print_r($categories); die;
       return view('admin.categories.categories')->with(compact('categories'));
    }

    public function UpdateCategoryStatus(Request $request)
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
            Category::where('id',$data['category_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'category_id'=>$data['category_id']]);
        }
    }

    public function addEditCategory(Request $request,$id=null)
    {
        Session::put('page','categories');
        if ($id=="") {
            # code...
            $title= "Add Category";
            $category = new Category;
            $categoryData = array();
            $getCategory = array();
            $messsage = 'Category added successfully';
        }else{
            $title="Edit Category";
            $categoryData= Category::where('id',$id)->first();
            $getCategory = Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categoryData['section_id']])->get();
            $category = Category::find($id);
            //$category = DB::table('categories')->find($id);;
            $messsage = 'Category updated successfully';
            //$categoryData = json_decode(json_encode($categoryData),true);
            //echo "<pre>"; print_r($categoryData); die;
        }

        if ($request->isMethod('post')) {
            # code...
            $data=$request->all();
            //$data = json_decode(json_encode($data),true);
            //echo "<pre>"; print_r($data); die;

            //Category validation
            $rules = [
                'category_name' => ['required','min:3'],
                'category_image' => ['mimes:jpeg,png,jpg,gif,svg','max:2048'],
                'section_id' => ['required'],
                'url'=> ['required'],
            ];
            $coustomMessages = [
                'category_name.required' => 'Category name is required.',
                'category_name.min' => 'Category name must be at least 3 characters.',
                'category_image.mimes' => 'File type must be jpeg,png,jpg,gif,svg formate.',
                'category_image.max' => 'Image size max 2 mb.',
                'section_id.required' => 'Section is required.',
                'url.required' => 'Category Url is required.',

            ];
            $this->validate($request ,$rules,$coustomMessages );

            /* ----------------------------------------------------------------------------------------------------------------------- */

            $image_tmp = $request->file('category_image');
            if ($request->hasFile('category_image')) {
                if ($image_tmp->isValid()) {
                    $extantion = $image_tmp->getClientOriginalExtension();
                    $name = time().'.'.$extantion;
                    $destinationPath =public_path('images/category_images/'.$name);

                    //dd($name,$destinationPath);
                    Image::make($image_tmp)->save($destinationPath);

                    if(!empty($categoryData['category_image'])){
                        $image_path = public_path('images/category_images/'.$categoryData['category_image']);
                        unlink($image_path);
                    }
                }
                
            }else if(!empty($data['current_category_image'])){
                    $name=$data['current_category_image'];
            }else{
                $name="";
            }

            /* ----------------------------------------------------------------------------------------------------------------------- */
 
           
            if (empty($data['category_discount'])) {
                # code...
                $data['category_discount']=0;
            }
            if (empty($data['description'])) {
                # code...
                $data['description']="";
            }
            if (empty($data['meta_title'])) {
                # code...
                $data['meta_title']="";
            }
            if (empty($data['meta_description'])) {
                # code...
                $data['meta_description']="";
            }
            if (empty($data['meta_keywords'])) {
                # code...
                $data['meta_keywords']="";
            }

            $category->parent_id =$data['parent_id'];
            $category->section_id =$data['section_id'];
            $category->category_name =$data['category_name'];
            $category->category_discount =$data['category_discount'];
            $category->category_image =$name;
            $category->description =$data['description'];
            $category->url =$data['url'];
            $category->meta_title =$data['meta_title'];
            $category->meta_description =$data['meta_description'];
            $category->meta_keywords =$data['meta_keywords']; 
            $category->status =1;
            $category->save();

            Session::flash('success_message',$messsage);
            return redirect('admin/categories');
        }

        $sections = Section::get();
        return view('admin.categories.add_edit_category')->with(compact('title','sections','categoryData','getCategory'));
    }

    public function appCategoryLevel(Request $request)
    {
        if ($request->ajax()) {
            # code...
            $data=$request->all();
            //echo "<pre>"; print_r($data); die;
            $getCategory =Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
            //$getCategory = json_decode(json_encode($getCategory),true);
            return view('admin.categories.appen_add_category')->with(compact('getCategory'));
        }
    }

    public function deleteCtgImage($id)
    {
        $categoryData= Category::where('id',$id)->first();
        $image_path = public_path('images/category_images/'.$categoryData['category_image']);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $category = Category::find($id);
        $category->category_image ="";
        $category->save();

        return redirect()->back()->with(Session::flash('success_message','Image deleted successfuly'));

    }

    public function deleteCategory($id)
    {
        
        $categories= Category::get();
        foreach ($categories as $category) {
            if ($category['parent_id']==$id) {
                $page2update =Category::where('parent_id',$id)->get();
                    foreach ($page2update as $page2){
                        //dd($page2['category_image']);
                        if(!empty($page2['category_image'])){
                            $image_path = public_path('images/category_images/'.$page2['category_image']);
                            if (file_exists($image_path)) {
                                //dd($image_path);
                                unlink($image_path);
                            }
                        }
                    }
                $page2update =Category::where('parent_id',$id)->delete();

            }
        }
        $categoryData= Category::where('id',$id)->first();

        if(!empty($categoryData['category_image'])){
            $image_path = public_path('images/category_images/'.$categoryData['category_image']);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $categoryData= Category::where('id',$id)->delete();
        return redirect()->back()->with(Session::flash('success_message','Category deleted successfuly'));
    }
}
