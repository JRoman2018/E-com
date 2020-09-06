<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class BannersController extends Controller
{
    public function banners(){
        Session::put('page', 'banners');
        $banners = Banner::get()->toArray();
        return view('admin.banners.banners', compact('banners'));
    }

    public function addEditBanners(Request $request, $id=null){
        Session::put('page', 'banners');
        if($id==""){
            $title = "Add Banner";
            $banner = new Banner();
            $message = "Banner added successfully!";
        }else{
            $title = "Edit Banner";
            $banner = Banner::findOrFail($id);
            $message = "Banner updated successfully!";
        }

        if($request->isMethod('post')){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

            $rules = [
                'brand_name' => 'required|regex:/^[\pL\s\-]+$/u',

            ];
            $customMessages = [
                'brand_name.required' => 'Brand Name is required',
                'brand_name.regex' => 'Valid Brand Name is required',
            ];
            $this->validate($request, $rules, $customMessages);

            $banner->name = $data['brand_name'];
            $banner->status = 1;
            $banner->save();
            return redirect('admin/banners')->with('success_message', $message);
        }
        return view('admin.banners.add_edit_banner',compact('title', 'banner'));
    }

    public function updateBannerStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }



    public function deleteBanner($id){
        $banner = Banner::where('id', $id)->first();
        $banner_image_path = 'images/banner_images/';

        //Delete Banner Image if exists in banner folder
        if(file_exists($banner_image_path.$banner->image)){
            unlink($banner_image_path.$banner->image);
        }

        //Delete Banner from banners table
        $banner->delete();
        return back()->with('success_message', 'Banner has been deleted successfully!');
    }
}
