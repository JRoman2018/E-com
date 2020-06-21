<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product, Session;
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
        if($id = ""):
            $title ="Addd Product";
        else:
            $title = "Edit Product";
        endif;

        //Filter Arrays.
        $fabricArray = array('Cotton', 'Polyester', 'Wool');
        $sleveeArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
        $fitArray = array('Regular', 'Slim');
        $ocassionArray = array('Casual', 'Formal');

        return view('admin.products.add_edit_product',compact('title', 'fabricArray', 'sleveeArray', 'patternArray', 'fitArray', 'ocassionArray'));
    }
}
