<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Log;
use App\Models\Review;

class PropertyReviewController extends Controller
{
   
    
    public function index()
    {
        $reviews = Review::with('property')->orderby('name', 'asc')->where('review_type',1)->get();
        return view('admin.review.index', compact('reviews'))->with('i');
    }

    
    public function delete($category){
        $category = decode_string($category);
        $catitem = Review::find($category);
        if(empty($catitem)){
            return redirect()->route(getRolePrefix().'review.index')->with('error', "Review doesn't exist.");
        }
      
        $catitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Review', 'Review Delete', 'Delete', $catitem);
        //=====logs=====
        return redirect()->route(getRolePrefix().'review.index')->with('success','Review deleted successfully.');
    }


}
