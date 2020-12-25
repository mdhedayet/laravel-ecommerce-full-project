<?php

namespace App\Http\Controllers\Admin;
use Session;
use Hash;
use Auth;
use App\Admin;
use Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function dashboard()
    {
        Session::put('page','dashboard');
        if (Auth::guard('admin')->check()){ 
            return view('admin.admin_dashboard');
        }else {
            return redirect('/admin');
        }
        //return view('admin.admin_dashboard');
    }

    public function login(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            /* echo "<pre>"; print_r($data); die; */
            /* $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required','max:12','min:6'],
            ]); */

            $rules = [
                'email' => ['required', 'email', 'max:255'],
                'password' => ['required','max:12','min:6'],
            ];
            $coustomMessages = [
                'email.required' => 'Email is required.',
                'email.email' => 'Valid email is required.',
                'password.required' => 'Password is required.',
                'password.max' => 'The password may not be greater than 12 characters.',
                'password.min' => 'The password must be at least 6 characters.',
            ];
            $this->validate($request ,$rules,$coustomMessages );

            if (Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])) {
                # code...
                return redirect('admin/dashboard');
            }else{
                Session::flash('error_message', 'Invalide email and password.');
                return redirect()->back();
            }
        }

       if(Auth::guard('admin')->check()){
           return redirect('admin/dashboard'); 
        }else {
            return view('admin.admin_login');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }

    public function settings()
    {
        Session::put('page','adminInfo');
        $adminDetails= Admin::where('email',Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }

    public function checkCurrentPassword(Request $request)
    {
        $data = $request->all();

        if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
            echo "true";
        }else{
            echo "false";
        }

    }

    public function updateCurrentPassword(Request $request)
    {       
        if ($request->isMethod('post')) {
            $data =$request->all();

            if (Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)) {
                
                    if($data['new_pwd'] == $data['confirm_pwd']) {
                        Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                        Session::flash('success_message', 'Your password update successfuly.');
                    }else {
                        Session::flash('error_message', 'Your new & confirm password not match.');
                    }
            }
            else {
                Session::flash('error_message', 'Your current password is incurrect.');
                }
            return redirect()->back();
        }
    }

    public function updateAdminDetails(Request $request)
    {
       
        if ($request->isMethod('post')) {
        $data =$request->all();
        //echo "<pre>"; print_r($data); die();
        $rules = [
                'name' => ['required','min:3','regex:/^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/'],
                'email' => ['required', 'email', 'max:255'],
                'type' => ['required'],
                'mobile' => ['required','min:11','numeric'],
                'admin_image' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
            ];
            $coustomMessages = [
                'name.required' => 'Name is required.',
                'name.regex' => 'Valid name is required.',
                'email.email' => 'Valid email is required.',
                'type.required' => 'Admin type is required.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.min' => 'Mobile number must be at least 11 numeric.',
                'mobile.min' => 'Mobile number must be at numeric.',
                'name.min' => 'Name must be at least 3 characters.',
                'admin_image.required' => 'Image is required.',
                'admin_image.mimes' => 'File type must be jpeg,png,jpg,gif,svg formate.',
                'admin_image.max' => 'Image size max 2 mb.',

            ];
            $this->validate($request ,$rules,$coustomMessages );

            $image_tmp = $request->file('admin_image');
            if ($request->hasFile('admin_image')) {
                if ($image_tmp->isValid()) {
                    $extantion = $image_tmp->getClientOriginalExtension();
                    $name = time().'.'.$extantion;
                    $destinationPath =public_path('images/admin_images/admin_propic/'.$name);

                    //dd($name,$destinationPath);
                    Image::make($image_tmp)->save($destinationPath);

                    if(!empty(Auth::guard('admin')->user()->image)){
                        $image_path = public_path('images/admin_images/admin_propic/'.Auth::guard('admin')->user()->image);
                        unlink($image_path);
                    }
                }
                
            }else if(!empty($data['current_admin_image'])){
                    $name=$data['current_admin_image'];
            }else{
                $name="";
            }

             Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['name'],'email'=>$data['email'],'type'=>$data['type'],'mobile'=>$data['mobile'],'image'=>$name]);
             Session::flash('success_message', ' Admin details update successfuly.');
             return redirect()->back();
        }
    }
}    
    


