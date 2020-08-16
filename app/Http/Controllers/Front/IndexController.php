<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        $page_name = "index";
        $sections = Section::sections();
        //Get Feature Items
        $featuredItemsCount = Product::where('is_featured', "yes")->count();
        $featuredItems = Product::where('is_featured', 'yes')->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
//        echo "<pre>"; print_r($featuredItemsChunk); die;
        return view('front.index',compact('page_name','sections', 'featuredItemsChunk','featuredItemsCount'));
    }
}
