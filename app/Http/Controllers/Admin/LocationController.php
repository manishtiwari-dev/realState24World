<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Location;
use App\Models\State;
use App\Helpers\Log;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::orderby('name', 'asc')->get();
        return view('admin.location.index', compact('locations'))->with('i');
    }

    public function create(Request $request)
    {
        if($request->method()=='GET')
        {
            $state = State::orderby('name', 'asc')->get();
            return view('admin.location.create', compact('state'));
        }
        if($request->method()=='POST'){
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'slug' => 'required|unique:locations',
                'status' => 'required',
            ]);
            if ($validator->passes()){
                $location = new Location;
                /* for image*/
                if($request->hasFile('thumbnail')){
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_'.time().'.'.$request->thumbnail->extension();  
                    $request->thumbnail->move(public_path('uploads/location'), $thumbImage);
                    $location->thumbnail = $thumbImage;
                }
                if($request->hasFile('banner')){
                    $request->validate([
                        'banner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $bannerImage = 'banner_'.time().'.'.$request->banner->extension();  
                    $request->banner->move(public_path('uploads/location'), $bannerImage);
                    $location->banner = $bannerImage;
                }
                if($request->hasFile('mobilebanner')){
                    $request->validate([
                        'mobilebanner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $mobbannerImage = 'mobbanner_'.time().'.'.$request->mobilebanner->extension();  
                    $request->mobilebanner->move(public_path('uploads/location'), $mobbannerImage);
                    $location->mobile_banner = $mobbannerImage;
                }
                 /* for image*/
                $btn_type = $request->btnsubmit;
                $location->state_id = $request->category;
                $location->name = $request->name;
                $location->slug = Str::slug($request->slug);
                $location->description = $request->description;
                $location->display_order = $request->display_order;
                $location->status = $request->status;
                $location->metatitle = $request->metatitle;
                $location->metakeyword = $request->metakeyword;
                $location->metadescription = $request->metadescription;
                $location->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Location', 'New Location Created', 'Create', $location);
                //=====logs=====
                if($btn_type=='saveandnew'){
                    return redirect()->route(getRolePrefix().'location.create')->with('success','Location has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix().'location.index')->with('success','Location has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix().'location.create')->withErrors($validator);
            }
        }
    }

    //update 
    public function update(Request $request, $locationID)
    {
        if($request->method()=='GET')
        {
            $location = decode_string($locationID);
            $states = State::orderby('name', 'asc')->get();
            $locationrow = Location::find($location);
            if(empty($locationrow)){
                return redirect()->route(getRolePrefix().'location.index')->with('error', "Location doesn't exist.");
            }
            return view('admin.location.edit',compact('locationrow','states'));
        }
        if($request->method()=='POST'){
            $newlocation = decode_string($locationID);
            $location = Location::find($newlocation);
            if(empty($location)){
                return redirect()->route(getRolePrefix().'location')->with('error', "Location doesn't exist.");
            }
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'slug' => 'required|unique:locations,slug,'.$location->id.',id',
                'status' => 'required',
            ]);
            if ($validator->passes()){
                /* for image*/
                if($request->hasFile('thumbnail')){
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_'.time().'.'.$request->thumbnail->extension();  
                    $request->thumbnail->move(public_path('uploads/location'), $thumbImage);
                    $location->thumbnail = $thumbImage;
                }
                if($request->hasFile('banner')){
                    $request->validate([
                        'banner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $bannerImage = 'banner_'.time().'.'.$request->banner->extension();  
                    $request->banner->move(public_path('uploads/location'), $bannerImage);
                    $location->banner = $bannerImage;
                }
                if($request->hasFile('mobilebanner')){
                    $request->validate([
                        'mobilebanner' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $mobbannerImage = 'mobbanner_'.time().'.'.$request->mobilebanner->extension();  
                    $request->mobilebanner->move(public_path('uploads/location'), $mobbannerImage);
                    $location->mobile_banner = $mobbannerImage;
                }
                /* for image*/
                $btn_type = $request->btnsubmit;
                $location->state_id = $request->category;
                $location->name = $request->name;
                $location->slug = Str::slug($request->slug);
                $location->description = $request->description;
                $location->display_order = $request->display_order;
                $location->status = $request->status;
                $location->metatitle = $request->metatitle;
                $location->metakeyword = $request->metakeyword;
                $location->metadescription = $request->metadescription;
                $location->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Location', 'Location Update', 'Update', $location);
                //=====logs=====
                if($btn_type=='saveandnew'){
                    return redirect()->route(getRolePrefix().'location.edit',$locationID)->with('success','Location has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix().'location.index')->with('success','Location has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix().'location.edit',$locationID)->withErrors($validator);
            }
        }
    }

    //status
    public function status(Request $request) {
        $request->validate([
            'state_id' => 'required|exists:locations,id',
            'status' => 'required|boolean',
        ]);
        $location = Location::find($request->state_id);
        if (empty($location)) {
            return response()->json(['message' => "Location doesn't exist."], 404);
        }
        $location->status = $request->status;
        $location->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Location', 'Location Status Updated', 'Update', $location);
        //=====logs=====
        return response()->json(['message' => 'Location status updated successfully.'], 200);
    }

    //delete
    public function delete($location){
        $location = decode_string($location);
        $locitem = Location::find($location);
        if(empty($locitem)){
            return redirect()->route(getRolePrefix().'location.index')->with('error', "Location doesn't exist.");
        }
        if(!empty($locitem->thumbnail)){
            if (file_exists(public_path('uploads/location/' . $locitem->thumbnail))) {
                unlink(public_path('uploads/location/' . $locitem->thumbnail));
            }
        }
        if(!empty($locitem->banner)){
            if (file_exists(public_path('uploads/location/' . $locitem->banner))) {
                unlink(public_path('uploads/location/' . $locitem->banner));
            }
        }
        if(!empty($locitem->mobile_banner)){
            if (file_exists(public_path('uploads/location/' . $locitem->mobile_banner))) {
                unlink(public_path('uploads/location/' . $locitem->mobile_banner));
            }
        }
        $locitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Location', 'Location Delete', 'Delete', $locitem);
        //=====logs=====
        return redirect()->route(getRolePrefix().'location.index')->with('success','Location deleted successfully.');
    }
}
