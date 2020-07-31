<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function section(){
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function attributes(){
        return $this->hasMany('App\ProductsAttribute');
    }

    public function images(){
        return $this->hasMany('App\ProductsImage');
    }
}
