<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product, Session;
use App\ProductsAttribute;
use App\ProductsImage;
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
            $productdata = array();
            $message = "Product added successfully!";
        else:
            $title = "Edit Product";
            $productdata = Product::findOrFail($id);
//            $productdata = json_decode(json_encode($productdata));
//            echo "<pre>"; print_r($productdata); die;
            $product = Product::findOrFail($id);
            $message = "Product Upated successfully!";
        endif;

        if($request->isMethod('post')):
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;

        //Product Validation
            $rules = [
                'category_id' => 'required',
                'brand_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
                'description' => 'required',
            ];
            $customMessages = [
                'category_id.required' => 'Category is required',
                'brand_id.required' => 'Brand is required',
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

            //Upload Product Image
            if($request->hasFile('main_image')):
                $image_tmp = $request->file('main_image');
                if($image_tmp->isValid()):
                    //Upload Image after resize
                    //Get Original Image Name
                    $image_name = $image_tmp->getClientOriginalName();
                    //Get Original Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //echo "<pre>"; print_r($extension); die;
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
            $product->brand_id = $data['brand_id'];
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
            if(!empty($data['is_featured'])):
                $product->is_featured = $data['is_featured'];
            else:
                $product->is_featured = "No";
            endif;
            $product->meta_keywords = $data['meta_keywords'];
            $product->status = 1;
            $product->save();
//            echo "<pre>"; print_r($categoryDetails); die;

            Session::flash('success_message',$message);
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

        //Get All Brands
        $brands = Brand::where('status',1)->get();
        $brands = json_decode(json_encode($brands),true);

        return view('admin.products.add_edit_product',compact(
            'categories',
            'title',
            'fabricArray',
            'sleveeArray',
            'patternArray',
            'fitArray',
            'productdata',
            'ocassionArray',
            'brands'
        ));
    }

    public function deleteProductImage($id){
        //Get Product Image
        $productImage = Product::select('main_image')->where('id',$id)->first();

        //Get Product Image Path
        $product_large_image_path = 'images/product_images/large/';
        $product_medium_image_path = 'images/product_images/medium/';
        $product_small_image_path = 'images/product_images/small/';

        //Delete Product Image from category_images folder
        if(file_exists($product_small_image_path.$productImage->main_image)){
            unlink($product_small_image_path.$productImage->main_image);
        }

        if(file_exists($product_medium_image_path.$productImage->main_image)){
            unlink($product_medium_image_path.$productImage->main_image);
        }

        if(file_exists($product_large_image_path.$productImage->main_image)){
            unlink($product_large_image_path.$productImage->main_image);
        }

        //Delete Product Image from products table
        Product::where('id',$id)->update(['main_image' => '']);
        return back()->with('success_message', 'Product Image has been deleted successfully!');
    }

    public function deleteProductVideo($id){
        //Get Product Image
        $productVideo = Product::select('product_video')->where('id',$id)->first();

        //Get Product Image Path
        $product_video_path = 'videos/product_videos/';

        //Delete Product Image from category_images folder
        if(file_exists($product_video_path.$productVideo->product_video)){
            unlink($product_video_path.$productVideo->product_video);
        }

        //Delete Product Image from categories table
        Product::where('id',$id)->update(['product_video' => '']);
        return back()->with('success_message', 'Product Video has been deleted successfully!');
    }

    public function addAttributes(Request $request, $id){
        if($request->isMethod('post')):
            $data = $request->all();
            foreach ($data['sku'] as $key => $value){
                if(!empty($value)){
                    //SKU already exists check
                    $attrCountSKU = ProductsAttribute::where('sku',$value)->count();
                    if($attrCountSKU>0){
                        $message = "SKU already exists. Please add another SKU!";
                        Session::flash('error_message',$message);
                        return back();
                    }
                    //Size already exists check
                    $attrCountSize = ProductsAttribute::where(['product_id'=>$id ,'size' => $data['size'][$key]])->count();
                    if($attrCountSize>0){
                        $message = "Size already exists. Please add another Size!";
                        Session::flash('error_message',$message);
                        return back();
                    }

                    $atributes = new ProductsAttribute;
                    $atributes->product_id = $id;
                    $atributes->sku = $value;
                    $atributes->size = $data['size'][$key];
                    $atributes->price = $data['price'][$key];
                    $atributes->stock = $data['stock'][$key];
                    $atributes->status = 1;
                    $atributes->save();
                }
            }
            $success_message = "Product Attributes has been added successfully!";
            Session::flash('success_message',$success_message);
            return back();
        endif;
        $productdata = Product::select('id','product_name','product_code','product_color','main_image')->with('attributes')->findOrfail($id);
        $productdata = json_decode(json_encode($productdata), true);
//        echo "<pre>"; print_r($productdata); die;
        $title = "Products Attributes";

        return view('admin.products.add_attributes',compact('productdata', 'title'));
    }

    public function editAttributes(Request $request){
        if($request->isMethod('post')):
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            foreach ($data['attrId'] as $key => $attr){
                if(!empty($data['attrId'])){
                    ProductsAttribute::where(['id'=>$data['attrId'][$key]])
                        ->update(['price'=>$data['price'][$key], 'stock'=>$data['stock'][$key]]);
                }
            }
            $success_message = "Product Attributes has been updated successfully!";
            Session::flash('success_message',$success_message);
            return back();
        endif;
    }

    public function updateAttributeStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsAttribute::where('id',$data['attribute_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'attribute_id' => $data['attribute_id']]);
        }
    }

    public function deleteAttribute($id){
        //Delete Attribute
        $attribute = ProductsAttribute::where('id', $id)->first();
        $attribute->delete();
        return back()->with('success_message', 'Attribute has been deleted successfully!');
    }

    public function addImages(Request $request, $id){
        if($request->isMethod('post')){
            if($request->hasFile('images')):
                $images = $request->file('images');
                foreach ($images as $key => $image):
                    $productImage = new ProductsImage;
                    $image_tmp = Image::make($image);
//                    $originalName = $image->getClientOriginalName();
                    $extension = $image->getClientOriginalExtension();
                    $imageName = rand(111,999999).time().".".$extension;
//                    echo "<pre>"; print_r($imageName); die;
                    //Path of the images: Large, Medium, Small
                    $large_image_path = 'images/product_images/large/'.$imageName;
                    $medium_image_path = 'images/product_images/medium/'.$imageName;
                    $small_image_path = 'images/product_images/small/'.$imageName;
                    //Upload large image
                    Image::make($image_tmp)->save($large_image_path); // w:1040 H:1200
                    //Upload medium and small image after resize
                    Image::make($image_tmp)->resize(520,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(260,300)->save($small_image_path);
                    //Save
                    $productImage->image = $imageName;
                    $productImage->product_id = $id;
                    $productImage->status = 1;
                    $productImage->save();
                endforeach;
                return back()->with('success_message', 'Images has been added successfully!');
            endif;
        }
        $productdata = Product::with('images')->select('id','product_name', 'product_code', 'product_color', 'main_image')
            ->findOrFail($id);
        $productdata = json_decode(json_encode($productdata), true);
//        echo "<pre>"; print_r($productdata); die;
        $title = "Product Images";
        return view('admin.products.add_images', compact('productdata', 'title'));
    }

    public function updateImageStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            ProductsImage::where('id',$data['image_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'image_id' => $data['image_id']]);
        }
    }

    public function deleteImage($id){
        //Delete Attribute
        $productImage = ProductsImage::select('image')->where('id', $id)->first();

        //Get Product Image Path
        $product_large_image_path = 'images/product_images/large/';
        $product_medium_image_path = 'images/product_images/medium/';
        $product_small_image_path = 'images/product_images/small/';

        //Delete Product Image from category_images folder
        if(file_exists($product_small_image_path.$productImage->image)){
            unlink($product_small_image_path.$productImage->image);
        }

        if(file_exists($product_medium_image_path.$productImage->image)){
            unlink($product_medium_image_path.$productImage->image);
        }

        if(file_exists($product_large_image_path.$productImage->image)){
            unlink($product_large_image_path.$productImage->image);
        }

        //Delete Product Image from products_image table
        ProductsImage::where('id',$id)->delete();
        return back()->with('success_message', 'Product Image has been deleted successfully!');
    }
}
