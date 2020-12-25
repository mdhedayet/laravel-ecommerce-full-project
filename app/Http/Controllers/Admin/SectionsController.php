<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use Session;

class SectionsController extends Controller
{
    //
    public function sections()
    {
        Session::put('page','sections');
        $sections = Section::get();
        return view('admin.sections.sections')->with(compact('sections'));
    }

    public function statusUpdate(Request $request)
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
            Section::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
}
