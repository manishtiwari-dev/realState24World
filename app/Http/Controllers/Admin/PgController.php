<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\State;
use App\Models\PgProperty;


use App\Helpers\Log;
use Illuminate\Support\Facades\File;

class PgController extends Controller
{
    public function index()
    {
        $data['project'] = PgProperty::orderBy('created_at', 'desc')->get();
        return view('admin.pgproperty.index', $data);
    }




    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            return view('admin.pgproperty.create', $data);
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'pgname' => 'required|string|max:255',
                'pgbed' => 'required|integer',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|integer',
                'roomtype.*' => 'required|string',
                'amount.*' => 'required|numeric',
                'securityamount.*' => 'required|numeric',
                'thumbnail.*' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            ]);
            if ($validator->passes()) {
                $btn_type = $request->btnsubmit;
                $pgdata = new PgProperty;
                if($request->hasFile('coverimage')){
                    $request->validate([
                        'coverimage' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $coverName = 'pg_'.time().'.'.$request->coverimage->extension();  
                    $request->coverimage->move(public_path('uploads/payinguest'), $coverName);
                    $pgdata->thumbnail = $coverName;
                }
                $randomslug   = Str::lower(Str::random(10));
                $pgdata->name = $request->pgname;
                $pgdata->agent_name = $request->name;
                $pgdata->slug = Str::slug($request->slug).'-'.$randomslug;
                $pgdata->about = $request->description;
                $pgdata->keyword = $request->keyword;
                $pgdata->total_beds = $request->pgbed;
                $pgdata->meals = $request->meal;
                $pgdata->type = $request->type;
                $pgdata->address = $request->address;
                $pgdata->city = $request->city;
                $pgdata->state_id = $request->state;
                //address
                $pgdata->website = $request->website;
                $pgdata->facebook_link = $request->facebook_link;
                $pgdata->linkedin_link = $request->linkedin_link;
                $pgdata->instagram_link = $request->instagram_link;
                $pgdata->twitter_link = $request->twitter_link;
                $pgdata->metatitle = $request->metatitle;
                $pgdata->metakeyword = $request->metakeyword;
                $pgdata->metadescription = $request->metadescription;
                $pgdata->dealer_id = $request->dealer;
                $pgdata->status = '0';
                $pgdata->save();
                //paying guest entry
                foreach($request->roomtype as $key => $value){
                    $pgroom = new Properties;
                    if($request->hasFile("thumbnail.$key")){
                        $thumbFile = $request->file("thumbnail.$key");
                        $thumbName = 'roomthumb_'.time().'_'.$key.'.'.$thumbFile->extension();
                        $thumbFile->move(public_path('uploads/properties'), $thumbName);
                        $pgroom->thumbnail = $thumbName;
                    }
                    $imagesArray = [];
                    if ($request->hasFile("banners.$key")) {
                        foreach ($request->file("banners.$key") as $index => $bannerImage) {
                            $imgName = 'roomimg_' . time() . '_' . $key . '_' . $index . '.' . $bannerImage->extension();
                            $bannerImage->move(public_path('uploads/properties'), $imgName);
                            $imagesArray[] = $imgName;
                        }
                    }
                    $pgroom->multiple_images = !empty($imagesArray) ? json_encode($imagesArray) : null;
                    $randomslugnew   = Str::lower(Str::random(10));
                    $pgroom->category_id = $request->category;
                    $pgroom->name = $request->pgname;
                    $pgroom->slug = Str::slug($request->slug).'-'.$randomslugnew;
                    $pgroom->description = $request->description;
                    $pgroom->type = $request->type;
                    $pgroom->amount_type = 'Month';
                    $pgroom->keyword = $request->keyword;
                    $pgroom->address = $request->address;
                    $pgroom->city = $request->city;
                    $pgroom->state_id = $request->state;
                    $pgroom->landmark = $request->landmark;
                    $pgroom->livingroom = $request->has('livingroom') ? 1 : 0;
                    $pgroom->kitchen = $request->has('kitchen') ? 1 : 0;
                    $pgroom->dininghall = $request->has('dininghall') ? 1 : 0;
                    $pgroom->studyroom = $request->has('library') ? 1 : 0;
                    //features
                    $pgroom->wifi = $request->has('wifi') ? 1 : 0;
                    $pgroom->pool = $request->has('pool') ? 1 : 0;
                    $pgroom->security = $request->has('security') ? 1 : 0;
                    $pgroom->laundry = $request->has('laundry') ? 1 : 0;
                    $pgroom->equipped_kitchen = $request->has('equipped_kitchen') ? 1 : 0;
                    $pgroom->air_conditioning = $request->has('air_conditioning') ? 1 : 0;
                    $pgroom->gym = $request->has('gym') ? 1 : 0;
                    $pgroom->parking = $request->has('parking') ? 1 : 0;
                    $pgroom->airport = $request->has('airport') ? 1 : 0;
                    $pgroom->park = $request->has('park') ? 1 : 0;
                    $pgroom->busstand = $request->has('busstand') ? 1 : 0;
                    $pgroom->mandir = $request->has('mandir') ? 1 : 0;
                    $pgroom->hospital = $request->has('hospital') ? 1 : 0;
                    $pgroom->school = $request->has('school') ? 1 : 0;
                    $pgroom->elevator = $request->has('elevator') ? 1 : 0;
                    $pgroom->railwaystation = $request->has('railwaystation') ? 1 : 0;
                    $pgroom->room_type = $request->roomtype[$key];
                    $pgroom->amount = $request->amount[$key];
                    $pgroom->security_amount = $request->securityamount[$key];
                    $pgroom->metatitle = $request->pgname.'-'.$request->metatitle;
                    $pgroom->metakeyword = $request->metakeyword;
                    $pgroom->metadescription = $request->metadescription;
                    $pgroom->pg_property_id = $pgdata->id;
                    $pgroom->dealer_id = $request->dealer;
                    $pgroom->user_id = $request->dealer;
                    $pgroom->property_type = '1';
                    $pgroom->premium = '2';
                    $pgroom->premium_status = '3';
                    $pgroom->show_home = '0';
                    $pgroom->status = '0'; 
                    $pgroom->is_verified = '0'; 
                    $pgroom->save();
                }
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Paying Guest', 'PG Created', 'Create', $pgdata);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'pgproperty.create')->with('success', 'PG has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'pgproperty.index')->with('success', 'PG has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'pgproperty.create')->withInput()->withErrors($validator);
            }
        }
    }

    public function update(Request $request, $propID)
    {
        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);
            $data['projectrow'] = PgProperty::find($newprop);
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            $data['oneprop'] = Properties::where('pg_property_id', $newprop)->first();
            $data['rooms'] = Properties::where('pg_property_id', $newprop)->get();
            if (empty($data['projectrow'])) {
                return redirect()->route(getRolePrefix() . 'pgproperty.index')->with('error', "PG doesn't exist.");
            }
            return view('admin.pgproperty.edit', $data);
        }
        if ($request->method() == 'POST') {
            $newproperty = decode_string($propID);
            $pgdata = PgProperty::find($newproperty);
            if (empty($pgdata)) {
                return redirect()->route(getRolePrefix() . 'pgproperty.index')->with('error', "PG doesn't exist.");
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'pgname' => 'required|string|max:255',
                'pgbed' => 'required|integer',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|integer',
                'roomtype.*' => 'required|string',
                'amount.*' => 'required|numeric',
                'securityamount.*' => 'required|numeric',
                'thumbnail.*' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            ]);
            if ($validator->passes()) {
                if($request->hasFile('coverimage')){
                    $request->validate([
                        'coverimage' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $coverName = 'pg_'.time().'.'.$request->coverimage->extension();  
                    $request->coverimage->move(public_path('uploads/payinguest'), $coverName);
                    $pgdata->thumbnail = $coverName;
                }
                $pgdata->name = $request->pgname;
                $pgdata->agent_name = $request->name;
                $pgdata->slug = Str::slug($request->slug);
                $pgdata->about = $request->description;
                $pgdata->keyword = $request->keyword;
                $pgdata->total_beds = $request->pgbed;
                $pgdata->meals = $request->meal;
                $pgdata->type = $request->type;
                $pgdata->address = $request->address;
                $pgdata->city = $request->city;
                $pgdata->state_id = $request->state;
                //address
                $pgdata->website = $request->website;
                $pgdata->facebook_link = $request->facebook_link;
                $pgdata->linkedin_link = $request->linkedin_link;
                $pgdata->instagram_link = $request->instagram_link;
                $pgdata->twitter_link = $request->twitter_link;
                $pgdata->metatitle = $request->metatitle;
                $pgdata->metakeyword = $request->metakeyword;
                $pgdata->metadescription = $request->metadescription;
                $pgdata->dealer_id = $request->dealer;
                $pgdata->status = '0';
                $pgdata->save();
                //paying guest entry
                foreach($request->roomtype as $key => $value){
                    //$pgroom = new Properties;
                    $propertyId = $request->property_id[$key] ?? null;
                    $pgroom = Properties::find($propertyId) ?? new Properties;
                    if($request->hasFile("thumbnail.$key")){
                        $thumbFile = $request->file("thumbnail.$key");
                        $thumbName = 'roomthumb_'.time().'_'.$key.'.'.$thumbFile->extension();
                        $thumbFile->move(public_path('uploads/properties'), $thumbName);
                        $pgroom->thumbnail = $thumbName;
                    }
                    $imagesArray = [];
                    if ($request->hasFile("banners.$key")) {
                        foreach ($request->file("banners.$key") as $index => $bannerImage) {
                            $imgName = 'roomimg_' . time() . '_' . $key . '_' . $index . '.' . $bannerImage->extension();
                            $bannerImage->move(public_path('uploads/properties'), $imgName);
                            $imagesArray[] = $imgName;
                        }
                    }
                    $pgroom->multiple_images = !empty($imagesArray) ? json_encode($imagesArray) : null;
                    $randomslugnew   = Str::lower(Str::random(10));
                    $pgroom->category_id = $request->category;
                    $pgroom->name = $request->pgname;
                    $pgroom->slug = Str::slug($request->slug).'-'.$randomslugnew;
                    $pgroom->description = $request->description;
                    $pgroom->type = $request->type;
                    $pgroom->amount_type = 'Month';
                    $pgroom->keyword = $request->keyword;
                    $pgroom->address = $request->address;
                    $pgroom->city = $request->city;
                    $pgroom->state_id = $request->state;
                    $pgroom->landmark = $request->landmark;
                    $pgroom->livingroom = $request->has('livingroom') ? 1 : 0;
                    $pgroom->kitchen = $request->has('kitchen') ? 1 : 0;
                    $pgroom->dininghall = $request->has('dininghall') ? 1 : 0;
                    $pgroom->studyroom = $request->has('library') ? 1 : 0;
                    //features
                    $pgroom->wifi = $request->has('wifi') ? 1 : 0;
                    $pgroom->pool = $request->has('pool') ? 1 : 0;
                    $pgroom->security = $request->has('security') ? 1 : 0;
                    $pgroom->laundry = $request->has('laundry') ? 1 : 0;
                    $pgroom->equipped_kitchen = $request->has('equipped_kitchen') ? 1 : 0;
                    $pgroom->air_conditioning = $request->has('air_conditioning') ? 1 : 0;
                    $pgroom->gym = $request->has('gym') ? 1 : 0;
                    $pgroom->parking = $request->has('parking') ? 1 : 0;
                    $pgroom->airport = $request->has('airport') ? 1 : 0;
                    $pgroom->park = $request->has('park') ? 1 : 0;
                    $pgroom->busstand = $request->has('busstand') ? 1 : 0;
                    $pgroom->mandir = $request->has('mandir') ? 1 : 0;
                    $pgroom->hospital = $request->has('hospital') ? 1 : 0;
                    $pgroom->school = $request->has('school') ? 1 : 0;
                    $pgroom->elevator = $request->has('elevator') ? 1 : 0;
                    $pgroom->railwaystation = $request->has('railwaystation') ? 1 : 0;
                    $pgroom->room_type = $request->roomtype[$key];
                    $pgroom->amount = $request->amount[$key];
                    $pgroom->security_amount = $request->securityamount[$key];
                    $pgroom->metatitle = $request->pgname.'-'.$request->metatitle;
                    $pgroom->metakeyword = $request->metakeyword;
                    $pgroom->metadescription = $request->metadescription;
                    $pgroom->pg_property_id = $pgdata->id;
                    $pgroom->dealer_id = $request->dealer;
                    $pgroom->user_id = $request->dealer;
                    $pgroom->property_type = '1';
                    $pgroom->premium = '2';
                    $pgroom->premium_status = '3';
                    $pgroom->show_home = '0';
                    $pgroom->status = '0'; 
                    $pgroom->is_verified = '0'; 
                    $pgroom->save();
                }
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Paying Guest', 'Paying Guest Update', 'Update', $pgdata);
                //=====logs=====
                return redirect()->route(getRolePrefix() . 'pgproperty.index')->with('success', 'PG has been updated successfully.');
            } else {
                return redirect()->route(getRolePrefix() . 'pgproperty.edit', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function show($propID)
    {
        $data['project'] = PgProperty::find($propID);
        $data['properties'] = Properties::where('pg_property_id', $propID)->orderBy('created_at', 'desc')->get();
        return view('admin.pgproperty.property', $data);
    }


    public function pg_property_create(Request $request, $propID)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            $data['project'] = PgProperty::find($propID);
            return view('admin.pgproperty.project_property_create', $data);
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:properties,slug',
                'type' => 'required',
                'amount' => 'required|numeric',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|integer',
                'landmark' => 'required|string',
                'area' => 'required|string',
                'dealer' => 'required|integer',
                'property_type' => 'required|integer',
            ]);
            if ($validator->passes()) {
                $property = new Properties;
                /* for image*/
                if ($request->hasFile('thumbnail')) {
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/properties'), $thumbImage);
                    $property->thumbnail = $thumbImage;
                }

                if ($request->hasFile('banner')) {
                    $request->validate([
                        'banner.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $uploadedImages = [];
                    foreach ($request->file('banner') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/properties'), $imageName);
                        $uploadedImages[] = $imageName;
                    }
                    $property->multiple_images = json_encode($uploadedImages);
                }
                /* for image*/
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->slug = Str::slug($request->slug);
                $property->description = $request->description;
                $property->type = $request->type;
                $property->amount = $request->amount;
                $property->keyword = $request->keyword;
                $property->address = $request->address;
                $property->city = $request->city;
                $property->state_id = $request->state;
                $property->landmark = $request->landmark;
                $property->area = $request->area;
                $property->bedrooms = $request->bedrooms;
                $property->accomodation = $request->accomodation;
                $property->bathrooms = $request->bathrooms;
                $property->balcony = $request->balcony;
                $property->furnishing = $request->furnishing;
                $property->floor_number = $request->floor_number;
                $property->garage = $request->garage;
                $property->wifi = $request->has('wifi') ? 1 : 0;
                $property->pool = $request->has('pool') ? 1 : 0;
                $property->security = $request->has('security') ? 1 : 0;
                $property->laundry = $request->has('laundry') ? 1 : 0;
                $property->equipped_kitchen = $request->has('equipped_kitchen') ? 1 : 0;
                $property->air_conditioning = $request->has('air_conditioning') ? 1 : 0;
                $property->gym = $request->has('gym') ? 1 : 0;
                $property->parking = $request->has('parking') ? 1 : 0;
                $property->airport = $request->has('airport') ? 1 : 0;
                $property->park = $request->has('park') ? 1 : 0;
                $property->busstand = $request->has('busstand') ? 1 : 0;
                $property->mandir = $request->has('mandir') ? 1 : 0;
                $property->hospital = $request->has('hospital') ? 1 : 0;
                $property->school = $request->has('school') ? 1 : 0;
                $property->railwaystation = $request->has('railwaystation') ? 1 : 0;
                $property->elevator = $request->has('elevator') ? 1 : 0;
                $property->dealer_id = $request->dealer;
                $property->status = $request->status;
                $property->property_type = $request->property_type;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->status = '1';
                $property->show_home = '1';
                $property->premium_status = $request->premium_status;
                $property->pg_property_id = $propID;
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'New Property Created', 'Create', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'pgproperty.property_create', $propID)->with('success', 'Property has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'pgproperty.show', $propID)->with('success', 'Property has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'pgproperty.property_create', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function pg_property_update(Request $request, $propID)
    {
        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);
            $data['propertyrow'] = Properties::find($newprop);
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            if (empty($data['propertyrow'])) {
                return redirect()->route(getRolePrefix() . 'project.show', $data['propertyrow']->project_id)->with('error', "Property doesn't exist.");
            }
            return view('admin.pgproperty.project_property_edit', $data);
        }
        if ($request->method() == 'POST') {
            $newproperty = decode_string($propID);
            $property = Properties::find($newproperty);
            if (empty($property)) {
                return redirect()->route(getRolePrefix() . 'properties.index')->with('error', "Property doesn't exist.");
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:properties,slug,' . $property->id . ',id',
                'type' => 'required',
                'amount' => 'required|numeric',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|integer',
                'landmark' => 'required|string',
                'area' => 'required|string',
                'dealer' => 'required|integer',
                'property_type' => 'required|integer',
            ]);
            if ($validator->passes()) {
                /* for image*/
                if ($request->hasFile('thumbnail')) {
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/properties'), $thumbImage);
                    $property->thumbnail = $thumbImage;
                }
                if ($request->hasFile('banner')) {
                    $request->validate([
                        'banner.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $uploadedImages = [];
                    foreach ($request->file('banner') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/properties'), $imageName);
                        $uploadedImages[] = $imageName;
                    }
                    $existingImages = json_decode($property->multiple_images, true) ?? [];
                    $allImages = array_merge($existingImages, $uploadedImages);
                    $property->multiple_images = json_encode($allImages);
                }
                /* for image*/
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->slug = Str::slug($request->slug);
                $property->description = $request->description;
                $property->type = $request->type;
                $property->amount = $request->amount;
                $property->keyword = $request->keyword;
                $property->address = $request->address;
                $property->city = $request->city;
                $property->state_id = $request->state;
                $property->landmark = $request->landmark;
                $property->area = $request->area;
                $property->bedrooms = $request->bedrooms;
                $property->accomodation = $request->accomodation;
                $property->bathrooms = $request->bathrooms;
                $property->balcony = $request->balcony;
                $property->furnishing = $request->furnishing;
                $property->floor_number = $request->floor_number;
                $property->garage = $request->garage;
                $property->wifi = $request->has('wifi') ? 1 : 0;
                $property->pool = $request->has('pool') ? 1 : 0;
                $property->security = $request->has('security') ? 1 : 0;
                $property->laundry = $request->has('laundry') ? 1 : 0;
                $property->equipped_kitchen = $request->has('equipped_kitchen') ? 1 : 0;
                $property->air_conditioning = $request->has('air_conditioning') ? 1 : 0;
                $property->gym = $request->has('gym') ? 1 : 0;
                $property->parking = $request->has('parking') ? 1 : 0;
                $property->airport = $request->has('airport') ? 1 : 0;
                $property->park = $request->has('park') ? 1 : 0;
                $property->busstand = $request->has('busstand') ? 1 : 0;
                $property->mandir = $request->has('mandir') ? 1 : 0;
                $property->hospital = $request->has('hospital') ? 1 : 0;
                $property->school = $request->has('school') ? 1 : 0;
                $property->railwaystation = $request->has('railwaystation') ? 1 : 0;
                $property->elevator = $request->has('elevator') ? 1 : 0;
                $property->garden = $request->has('garden') ? 1 : 0;
                $property->market = $request->has('market') ? 1 : 0;
                $property->dealer_id = $request->dealer;
                $property->status = $request->status;
                $property->property_type = $request->property_type;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->premium_status = $request->premium_status;
                $property->status = '1';
                $property->pg_property_id =  $request->project_id;
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'Property Update', 'Update', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'pgproperty.property_update', $propID)->with('success', 'Property has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'pgproperty.show',$request->project_id)->with('success', 'Property has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'pgproperty.property_update', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    //status
    public function status(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:pg_property,id',
            'status' => 'required|boolean',
        ]);
        $property = PgProperty::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Property doesn't exist."], 404);
        }
        $property->status = $request->status;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Project', 'PG Status Updated', 'Update', $property);
        //=====logs=====
        return response()->json(['message' => 'PG status updated successfully.'], 200);
    }

    //delete
    public function destroy($property)
    {
        $propertyitem = PgProperty::find($property);
        if (empty($propertyitem)) {
            return redirect()->route(getRolePrefix() . 'pgproperty.index')->with('error', "PG doesn't exist.");
        }
        if (!empty($propertyitem->thumbnail)) {
            if (file_exists(public_path('uploads/payinguest/' . $propertyitem->thumbnail))) {
                unlink(public_path('uploads/payinguest/' . $propertyitem->thumbnail));
            }
        }
        $propertyitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Project', 'PG Delete', 'Delete', $propertyitem);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'pgproperty.index')->with('success', 'PG deleted successfully.');
    }


     public function pg_property_destroy($property)
    {
        $propertyitem = Properties::find($property);
        if (empty($propertyitem)) {
            return redirect()->route(getRolePrefix() . 'properties.index')->with('error', "Properties doesn't exist.");
        }
        if (!empty($propertyitem->thumbnail)) {
            if (file_exists(public_path('uploads/properties/' . $propertyitem->thumbnail))) {
                unlink(public_path('uploads/properties/' . $propertyitem->thumbnail));
            }
        }
        if (!empty($propertyitem->banner)) {
            if (file_exists(public_path('uploads/properties/' . $propertyitem->banner))) {
                unlink(public_path('uploads/properties/' . $propertyitem->banner));
            }
        }
        $propertyitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Properties', 'Properties Delete', 'Delete', $propertyitem);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'pgproperty.show',$propertyitem->project_id)->with('success', 'Properties deleted successfully.');
    }



    public function deleteImage(Request $request)
    {
        $property = Properties::findOrFail($request->id);

        $imageToDelete = $request->input('image');
        $imagePath = public_path('uploads/project/' . $imageToDelete);

        // Remove image from disk if it exists
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        // Remove image from JSON array
        $images = json_decode($property->multiple_images, true);

        if (($key = array_search($imageToDelete, $images)) !== false) {
            unset($images[$key]);
            $property->multiple_images = json_encode(array_values($images));
            $property->save();
        }

        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }

}
