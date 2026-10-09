<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Log;
use App\Models\Review;

class AgentReviewController extends Controller
{
   
    
    public function review()
    {
        $reviews = Review::with('dealer')->orderby('name', 'asc')->where('review_type',2)->get();
        return view('admin.dealer.review', compact('reviews'))->with('i');
    }

    
    public function delete($category){
        $category = decode_string($category);
        $catitem = Review::find($category);
        if(empty($catitem)){
            return redirect()->route(getRolePrefix().'agent_review.index')->with('error', "Review doesn't exist.");
        }
      
        $catitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Review', 'Review Delete', 'Delete', $catitem);
        //=====logs=====
        return redirect()->route(getRolePrefix().'agent_review.index')->with('success','Review deleted successfully.');
    }



}
