<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    public function subcategories()
    {
        return $this->hasMany('App\Category','parent_id')->where('status',1);
    }

    public function section()
    {
        return $this->belongsTo('App\Section','section_id')->select('id','name');
    }
    public function parentcategory()
    {
        return $this->belongsTo('App\Category','parent_id')->select('id','category_name');
    }

    public static function CategoryDetails($url)
    {
        $CategoryDetails= Category::select('id','parent_id','category_name','url','description')->with(['subcategories'=>function($query){
            $query->select('id','parent_id','category_name','url','description')->where('status',1);
        }])->where('url',$url)->first()->toArray();
        //dd($CategoryDetails); die;
        if($CategoryDetails['parent_id']==0){
            $breadcrumbs = '<a href="'.url($CategoryDetails['url']).'">'.$CategoryDetails['category_name'].'</a>';
        }else{
            $parentcategory = Category::select('category_name','url')->where('id',$CategoryDetails['parent_id'])->first()->toArray();
            $breadcrumbs = '<a href="'.url($parentcategory['url']).'">'.$parentcategory['category_name'].'</a>&nbsp;<span class="devider">/</span>&nbsp;<a href="'.url($CategoryDetails['url']).'">'.$CategoryDetails['category_name'].'</a>';
        }

        $categoryIds = array();
        $categoryIds[]=$CategoryDetails['id'];
        foreach ($CategoryDetails['subcategories'] as $key => $subcategory) {
            # code...
            $categoryIds[]=$subcategory['id'];
        }

        //dd($categoryIds); die;
        return array('categoryIds'=>$categoryIds,'CategoryDetails'=>$CategoryDetails,'breadcrumbs'=>$breadcrumbs);

    }



     protected $fillable = [
        'id',
    ];
}
