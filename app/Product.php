<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Category','category_id')->select('id','category_name');
    }

    public function section()
    {
        return $this->belongsTo('App\Section','section_id')->select('id','name');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand','brand_id')->select('id','name');
    }

    public function attributes()
    {
        return $this->hasMany('App\ProductsAttribute');
    }


    public function images()
    {
        return $this->hasMany('App\ProductsImage');
    }

    public static function productFilters()
    {
        $productFilters['fabricArray']=array('cotton','polyester','Wool');
        $productFilters['sleeveArray']=array('Full Sleeve','Half Sleeve','Short Sleeve','Sleeve less');
        $productFilters['patternArray']=array('Checked','Plain','Printed','self','solid');
        $productFilters['fitArray']=array('Reguler','Slim');
        $productFilters['occassionArray']=array('Casual','Formal');

        return $productFilters;
    }



}
