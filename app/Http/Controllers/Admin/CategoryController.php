<?php

namespace App\Http\Controllers\Admin;

use App\Category, Session, Image;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories(){
        Session::put('page', 'categories');
        $categories = Category::with('section')->with('parentcategory')->get();
//        $categories = json_decode(json_encode($categories));
//        echo "<pre>"; print_r($categories); die;
        return view('admin.categories.categories', compact('categories'));
    }

    public function updateCategoryStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
//            echo "<pre>"; print_r($data); die;
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id',$data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null){
        if($id==""):
            $title = "Add Category";
            //Add Category Functionality
            $category = New Category;
            $categorydata = array();
            $getCategories = array();
        else:
            $title = "Edit Category";
            //Edit Category Funtionality
            $categorydata = Category::where('id',$id)->first();
            $getCategories = Category::with('subcategories')->where(['parent_id' => 0, 'section_id' => $categorydata['section_id']])->get();
            $categories = json_decode(json_encode($getCategories));
            "<pre>"; print_r($categories); die;
        endif;

        if($request->isMethod('post')){
            $data = $request->all();

            //Category Validations
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id' => 'required',
                'category_image' => 'image',
                'url' => 'required'
            ];
            $customMessages = [
                'category_name.required' => 'Category Name is required',
                'category_name.regex' => 'Valid Category Name is required',
                'section_id.required' => 'Section is required',
                'category_image.image' => 'Valid Category Image is required',
                'url.required' => 'Category URL is required',
            ];
            $this->validate($request, $rules, $customMessages);
//            echo "<pre>"; print_r($data); die;
            //Upload Category Image
            if($request->hasFile('category_image')):
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()):
                    //Get Image Extensions
                    $extention = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111,99999).'.'.$extention;
                    $imagePath = 'images/category_images/'.$imageName;
                    //Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                    //save Category Image;
                    $category->category_image = $imageName;
                endif;
            endif;

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            Session::flash('success_message', 'Category added successfully!');
            return redirect('admin/categories');
        }


        //Get All Sections
        $getSections = Section::get();
        return view('admin.categories.add_edit_category',compact('title', 'getSections', 'categorydata', 'getCategories'));
    }

    public function appendCategoriesLevel(Request $request){
        if($request->ajax()){
            $data = $request->all();
            $getCategories = Category::with('subcategories')->where(['section_id' => $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();
//            $getCategories = json_decode(json_encode($getCategories),true);
//            echo "<pre>"; print_r($getCategories); die;
            return view('admin.categories.append_categories_level',compact('getCategories'));
        }
    }
}
