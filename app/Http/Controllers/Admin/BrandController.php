<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Brand;

class BrandController extends Controller
{
    //
    public function Brands()
    {
        Session::put('page','brands');
        $brands = Brand::get();
        return view('admin.brands.brands')->with(compact('brands'));
    }

    public function Updatebrandsstatus(Request $request)
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
            Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
        }
    }

    public function addeditbrand(Request $request,$id=null)
    {
        Session::put('page','brands');
        if($id=='')
        {
            $title = 'Add Brand';
            $brand = new Brand;
            $message = 'Brand added successully.';
        }
        else {
            $title = 'Update Brand';
            $brand =Brand::find($id);
            $message = 'Brand Update successully.';
        }

        if($request->isMethod('post'))
        {
            //brand validation
            $rules = [
                'brand_name' => ['required'],
            ];
            $coustomMessages = [
                'brand_name.required' => 'Brand name is required.',
            ];
            $this->validate($request ,$rules,$coustomMessages );
            
            
            $data = $request->all();
            //echo '<pre>'; print_r($data); die;
            $brand->name=$data['brand_name'];
            $brand->save();


            Session::flash('success_message',$message);
            return redirect('admin/brands');
        }
       
        return view('admin.brands.add_edit_brand')->with(compact('brand','title'));

    }

    public function deletebrand($id)
    {
        $ProductImage= Brand::where('id',$id)->delete();
        return redirect()->back()->with(Session::flash('success_message','Brand deleted successfuly.'));
    }
}
