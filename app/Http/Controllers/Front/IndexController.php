<?php

namespace App\Http\Controllers\Front;

use App\Banner;
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
        $featuredItemsCount = Product::where('is_featured', 'yes')->where('status',1)->count();
        $featuredItems = Product::where('is_featured', 'yes')->where('status',1)->get()->toArray();
        $featuredItemsChunk = array_chunk($featuredItems, 4);
//        echo "<pre>"; print_r($featuredItemsChunk); die;

        //Create new products
        $newProducts = Product::orderBy('id','Desc')->where('status',1)->limit(6)->get()->toArray();
//        echo "<pre>"; print_r($newProducts); die;

        $banners = Banner::getBanners();

        return view('front.index',
            compact('page_name',
                'banners',
                'sections',
                'featuredItemsChunk',
                'featuredItemsCount',
                'newProducts'));
    }
}
