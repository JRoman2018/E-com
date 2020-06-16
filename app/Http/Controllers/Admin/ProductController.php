<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product, Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function products(){
        $products = Product::get();
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
}
