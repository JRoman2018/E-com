<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategories(){
        return $this->hasMany('App\Category', 'parent_id')->where('status', 1);
    }

    public function section(){
        return $this->belongsTo('App\Section', 'section_id')->select('id','name');
    }

    public function parentcategory(){
        return $this->belongsTo('App\Category', 'parent_id')->select('id','category_name');
    }

    public static function catDetails($url){
        $catDetails = Category::select('id','category_name','url')->with(['subcategories' =>
            function($query){
            $query->select('id','parent_id')->where('status',1);
        }])->where('url', $url)->first()->toArray();
        $catIds = array();
        $catIds[] = $catDetails['id'];
        foreach ($catDetails['subcategories'] as $key => $subcat){
            $catIds = $subcat['id'];
        }
        return array('catIds'=>$catIds, 'catDetails' => $catDetails);
    }
}
