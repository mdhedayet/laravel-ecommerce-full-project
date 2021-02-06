<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Session;
use Image;

class BannersController extends Controller
{
    
    public function banners()
    {
        Session::put('page','banners');
        $banners = Banner::get()->toArray();
        //dd($banners); die;
        return view('admin.banners.banners')->with(compact('banners'));
    }

    public function Updatebannersstatus(Request $request)
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
            Banner::where('id',$data['banner_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'banner_id'=>$data['banner_id']]);
        }
    }


    public function deletebanner($id)
    {

       $BannerData= Banner::where('id',$id)->first();
        $image_path = public_path('images/banner_images/'.$BannerData['image']);
            //dd($image_path);
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $BannerData= Banner::where('id',$id)->delete();

        return redirect()->back()->with(Session::flash('success_message','Banner deleted successfuly'));
    }

    public function addeditbanners(Request $request,$id=null)
    {
        Session::put('page','banners');
        if ($id=="") {
            $title= "Add Banner";
            $banner = new banner;
            $bannerData = array();
            $messsage = 'Banner added successfully';
        }else{
            $title="Edit Banner";
            $bannerData= Banner::where('id',$id)->first();
            $banner = Banner::find($id);
            $messsage = 'Banner updated successfully';
            //$BannerData = json_decode(json_encode($BannerData),true);
            //echo "<pre>"; print_r($BannerData); die;
        }


        if ($request->isMethod('post')) {
            # code...
            $data=$request->all();
            //$data = json_decode(json_encode($data),true);
            //echo "<pre>"; print_r($data); die;

            //Banner validation
            $rules = [
                'title' => ['required','min:3'],
                'image' => ['mimes:jpeg,png,jpg,gif,svg','max:2048'],
                'description' => ['required'],
            ];
            $coustomMessages = [
                'title.required' => 'Title is required.',
                'title.min' => 'Title must be at least 3 characters.',
                'image.mimes' => 'File type must be jpeg,png,jpg,gif,svg formate.',
                'image.max' => 'Image size max 2 mb.',
                'description.required' => 'Description is required.',
            ];
            $this->validate($request ,$rules,$coustomMessages );


            //image upload
            $image_tmp = $request->file('image');
            if ($request->hasFile('image')) {
                if ($image_tmp->isValid()) {
                    $extantion = $image_tmp->getClientOriginalExtension();
                    $name = time().'.'.$extantion;
                    $destinationPath ='images/banner_images/'.$name;

                    //dd($name,$destinationPath);
                    Image::make($image_tmp)->save($destinationPath);

                    if(!empty($bannerData['category_image'])){
                        $image_path ='images/banner_images/'.$bannerData['image'];
                        unlink($image_path);
                    }
                }
                
            }else if(!empty($data['current_image'])){
                    $name=$data['current_image'];
            }else{
                $name="";
            }


            if (empty($data['link'])) {
                # code...
                $data['link']="";
            }
            if (empty($data['alt'])) {
                # code...
                $data['alt']="";
            }


            $banner->title =$data['title'];
            $banner->description =$data['description'];
            $banner->image = $name;
            $banner->link =$data['link'];
            $banner->alt =$data['alt'];
            $banner->status =1;
            $banner->save();

            Session::flash('success_message',$messsage);
            return redirect('admin/banners');
        }

        return view('admin.banners.add_edit_banner')->with(compact('title','banner'));
    }

    public function deletebannerImage($id)
    {
        $BannerData= Banner::where('id',$id)->first();
        $image_path = public_path('images/banner_images/'.$BannerData['image']);
            //dd($image_path);
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $banner= Banner::find($id);
        $banner->image ="";
        $banner->save();

        return redirect()->back()->with(Session::flash('success_message','Image deleted successfuly'));

    }
}
