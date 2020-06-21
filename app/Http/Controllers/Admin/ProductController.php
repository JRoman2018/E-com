<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product, Session;
use App\Section;
use Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products(){
        $products = Product::with(['category' => function($query){
            $query->select('id', 'category_name');
        }, 'section' => function($query){
            $query->select('id', 'name');
        }])->get();
        Session::put('page', 'products');
//        $products = json_decode(json_encode($products));
//        echo "<pre>"; print_r($products); die;
        return view('admin.products.products', compact('products'));
    }

    public function updateProductStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id',$data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    public function deleteProduct($id){
        //Delete Product
        $product = Product::where('id', $id)->first();
        $product->delete();
        return back()->with('success_message', 'Product has been deleted successfully!');
    }

    public function addEditProduct(Request $request, $id=null){
        if($id==""):
            $title ="Add Product";
            $product = new Product;
        else:
            $title = "Edit Product";
            $productdata = Product::where('id',$id)->first();

        endif;

        if($request->isMethod('post')):
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

        //Product Validation
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'description' => 'required',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product Name is required',
                'product_name.regex' => 'Valid Product Name is required',
                'product_code.required' => 'Product Code is required',
                'product_code.regex' => 'Valid Product Code is required',
                'product_price.required' => 'Product price is required',
                'product_price.numeric' => 'Valid Product price is required',
                'product_color.required' => 'Product color is required',
                'product_color.regex' => 'Valid Product color is required',
                'description.required' => 'Product description is required',
            ];
            $this->validate($request, $rules, $customMessages);

            if(empty($data['is_featured'])):
                $is_featured = "No";
            endif;

            if(empty($data['product_discount'])):
                $product->product_discount = 0;
            else:
                $product->product_discount = $data['product_discount'];
            endif;

            //Upload Product Image
            if($request->hasFile('main_image')):
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()):
                    //Upload Image after resize
                    //Get Original Image Name
                    $image_name = $image_tmp->getClientOriginalName();
                    //Get Original Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = $image_name.'-'.rand(111,999999).'.'.$extension;
                    //Path of the images: Large, Medium, Small
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;
                    //Upload large image
                    Image::make($image_tmp)->save($large_image_path); // w:1040 H:1200
                    //Upload medium and small image after resize
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    //Save product main image in products table
                    $product->main_image = $imageName;
                endif;
            endif;

            //Upload Product Video
            if($request->hasFile('product_video')):
                $video_tmp = $request->file('product_video');
                if($video_tmp->isValid()):
                    $video_name = $video_tmp->getClientOriginalName();
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = $video_name.'-'.rand(111,999999).'.'.$extension;
                    $video_path = 'videos/product_videos/';
                    $video_tmp->move($video_path,$videoName);
                    //Save product video in products table
                    $product->product_video = $videoName;
                endif;
            endif;

            //Save Product Details in products table
            $categoryDetails = Category::find($data['category_id']);
            $product->section_id = $categoryDetails->section_id;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->pattern = $data['pattern'];
            $product->sleeve = $data['sleeve'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $is_featured;
            $product->status = 1;
            $product->save();
//            echo "<pre>"; print_r($categoryDetails); die;

            Session::flash('success_message', "Product added successfully!");
            return redirect('admin/products');
        endif;

        //Filter Arrays.
        $fabricArray = array('Cotton', 'Polyester', 'Wool');
        $sleveeArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $ocassionArray = array('Casual', 'Formal');

        //Selection with Categories and Subcategories
        $categories = Section::with('categories')->get();
//        $categories = json_decode(json_encode($categories), true);
//        echo "<pre>"; print_r($categories); die;

        return view('admin.products.add_edit_product',compact('categories','title', 'fabricArray', 'sleveeArray', 'patternArray', 'fitArray', 'ocassionArray'));
    }
}
