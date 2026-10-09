<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Helpers\Log;

class CategoryController extends Controller
{
    /*** Display a listing of the resource.*/
    function __construct()
    {
        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    
    /*** Display a listing of the resource.**/
    public function index()
    {
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('admin.category.index', compact('categories'))->with('i');
    }

    public function create(Request $request)
    {
        if($request->method()=='GET')
        {
            $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
            return view('admin.category.create', compact('categories'));
        }
        if($request->method()=='POST'){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'slug' => 'required|unique:categories',
                'status' => 'required',
            ]);
            if ($validator->passes()){
                $catt = new Category;
                /* for image*/
                if($request->hasFile('thumbnail')){
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_'.time().'.'.$request->thumbnail->extension();  
                    $request->thumbnail->move(public_path('uploads/category'), $thumbImage);
                    $catt->thumbnail = $thumbImage;
                }
                if($request->hasFile('banner')){
                    $request->validate([
                        'banner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $bannerImage = 'banner_'.time().'.'.$request->banner->extension();  
                    $request->banner->move(public_path('uploads/category'), $bannerImage);
                    $catt->banner = $bannerImage;
                }
                if($request->hasFile('mobilebanner')){
                    $request->validate([
                        'mobilebanner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $mobbannerImage = 'mobbanner_'.time().'.'.$request->mobilebanner->extension();  
                    $request->mobilebanner->move(public_path('uploads/category'), $mobbannerImage);
                    $catt->mobile_banner = $mobbannerImage;
                }
                 /* for image*/
                $btn_type = $request->btnsubmit;
                $catt->parent_id = $request->category;
                $catt->name = $request->name;
                $catt->slug = Str::slug($request->slug);
                $catt->shortdescription = $request->shortdescription;
                $catt->description = $request->description;
                $catt->show_menu = $request->showinmenu;
                $catt->show_home = $request->showonhome;
                $catt->display_order = $request->display_order;
                $catt->status = $request->status;
                $catt->metatitle = $request->metatitle;
                $catt->metakeyword = $request->metakeyword;
                $catt->metadescription = $request->metadescription;
                $catt->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Category', 'New Category Created', 'Create', $catt);
                //=====logs=====
                if($btn_type=='saveandnew'){
                    return redirect()->route(getRolePrefix().'category.create')->with('success','Category has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix().'category.index')->with('success','Category has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix().'category.create')->withErrors($validator);
            }
        }
    }

    //update 
    public function update(Request $request, $categoryID)
    {
        if($request->method()=='GET')
        {
            $category = decode_string($categoryID);
            $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
            $categoryrow = Category::find($category);
            if(empty($categoryrow)){
                return redirect()->route(getRolePrefix().'category.index')->with('error', "Category doesn't exist.");
            }
            return view('admin.category.edit',compact('categoryrow','categories'));
        }
        if($request->method()=='POST'){
            $newcategory = decode_string($categoryID);
            $category = Category::find($newcategory);
            if(empty($category)){
                return redirect()->route(getRolePrefix().'category')->with('error', "Category doesn't exist.");
            }
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'slug' => 'required|unique:categories,slug,'.$category->id.',id',
                'status' => 'required',
            ]);
            if ($validator->passes()){
                /* for image*/
                if($request->hasFile('thumbnail')){
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_'.time().'.'.$request->thumbnail->extension();  
                    $request->thumbnail->move(public_path('uploads/category'), $thumbImage);
                    $category->thumbnail = $thumbImage;
                }
                if($request->hasFile('banner')){
                    $request->validate([
                        'banner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $bannerImage = 'banner_'.time().'.'.$request->banner->extension();  
                    $request->banner->move(public_path('uploads/category'), $bannerImage);
                    $category->banner = $bannerImage;
                }
                if($request->hasFile('mobilebanner')){
                    $request->validate([
                        'mobilebanner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $mobbannerImage = 'mobbanner_'.time().'.'.$request->mobilebanner->extension();  
                    $request->mobilebanner->move(public_path('uploads/category'), $mobbannerImage);
                    $category->mobile_banner = $mobbannerImage;
                }
                /* for image*/
                $btn_type = $request->btnsubmit;
                $category->parent_id = $request->category;
                $category->name = $request->name;
                $category->slug = Str::slug($request->slug);
                $category->shortdescription = $request->shortdescription;
                $category->description = $request->description;
                $category->show_menu = $request->showinmenu;
                $category->show_home = $request->showonhome;
                $category->display_order = $request->display_order;
                $category->status = $request->status;
                $category->metatitle = $request->metatitle;
                $category->metakeyword = $request->metakeyword;
                $category->metadescription = $request->metadescription;
                $category->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Category', 'Category Update', 'Update', $category);
                //=====logs=====
                if($btn_type=='saveandnew'){
                    return redirect()->route(getRolePrefix().'category.edit',$categoryID)->with('success','Category has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix().'category.index')->with('success','Category has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix().'category.edit',$categoryID)->withErrors($validator);
            }
        }
    }

    //status
    public function status(Request $request) {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
        ]);
        $category = Category::find($request->category_id);
        if (empty($category)) {
            return response()->json(['message' => "Category doesn't exist."], 404);
        }
        $category->status = $request->status;
        $category->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Banner', 'Category Status Updated', 'Update', $category);
        //=====logs=====
        return response()->json(['message' => 'Category status updated successfully.'], 200);
    }

    //delete
    public function delete($category){
        $category = decode_string($category);
        $catitem = Category::find($category);
        if(empty($catitem)){
            return redirect()->route(getRolePrefix().'category.index')->with('error', "Category doesn't exist.");
        }
        if(!empty($catitem->thumbnail)){
            if (file_exists(public_path('uploads/category/' . $catitem->thumbnail))) {
                unlink(public_path('uploads/category/' . $catitem->thumbnail));
            }
        }
        if(!empty($catitem->banner)){
            if (file_exists(public_path('uploads/category/' . $catitem->banner))) {
                unlink(public_path('uploads/category/' . $catitem->banner));
            }
        }
        if(!empty($catitem->mobile_banner)){
            if (file_exists(public_path('uploads/category/' . $catitem->mobile_banner))) {
                unlink(public_path('uploads/category/' . $catitem->mobile_banner));
            }
        }
        $catitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Category', 'Category Delete', 'Delete', $catitem);
        //=====logs=====
        return redirect()->route(getRolePrefix().'category.index')->with('success','Category deleted successfully.');
    }
}
