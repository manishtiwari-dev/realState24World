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
use App\Helpers\Log;
use Illuminate\Support\Facades\File;

class PropertiesController extends Controller
{
    public function index(){
        $data['properties'] = Properties::orderBy('created_at', 'desc')->get();
        return view('admin.properties.index', $data);
    }

    public function prop_verification(){
        $data['properties'] = Properties::where('is_verified','0')->orderBy('created_at', 'desc')->get();
        return view('admin.properties.verification', $data);
    }


    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            return view('admin.properties.create', $data);
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
                $randomslug   = Str::lower(Str::random(10));
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->slug = Str::slug($request->slug).'-'.$randomslug;
                $property->description = $request->description;
                $property->type = $request->type;
                $property->amount = $request->amount;
                $property->amount_type = $request->price_type;
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
                $property->last_date = $request->last_date;
                $property->property_type = $request->property_type;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->status = '1';
                $property->show_home = '1';
                $property->premium_status = $request->premium_status;
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'New Property Created', 'Create', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'properties.create')->with('success', 'Property has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'properties.index')->with('success', 'Property has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'properties.create')->withInput()->withErrors($validator);
            }
        }
    }

    public function update(Request $request, $propID)
    {
        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);
            $data['propertyrow'] = Properties::find($newprop);
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            if (empty($data['propertyrow'])) {
                return redirect()->route(getRolePrefix() . 'properties.index')->with('error', "Property doesn't exist.");
            }
            return view('admin.properties.edit', $data);
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
                $property->amount_type = $request->price_type;
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
                $property->last_date = $request->last_date;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->premium_status = $request->premium_status;
                $property->status = '1';
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'Property Update', 'Update', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'properties.edit', $propID)->with('success', 'Property has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'properties.index')->with('success', 'Property has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'properties.edit', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function prop_verification_update(Request $request,  $propID)
    {
        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);
            $data['propertyrow'] = Properties::find($newprop);
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            if (empty($data['propertyrow'])) {
                return redirect()->route(getRolePrefix() . 'properties.verification')->with('error', "Property doesn't exist.");
            }
            return view('admin.properties.verificationedit', $data);
        }
        if ($request->method() == 'POST') {
            $newproperty = decode_string($propID);
            $property = Properties::find($newproperty);
            if (empty($property)) {
                return redirect()->route(getRolePrefix() . 'properties.verification')->with('error', "Property doesn't exist.");
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
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->slug = Str::slug($request->slug);
                $property->description = $request->description;
                $property->type = $request->type;
                $property->amount = $request->amount;
                $property->amount_type = $request->price_type;
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
                $property->last_date = $request->last_date;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->premium_status = $request->premium_status;
                $property->is_verified = '1';
                $property->status = '1';
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'Property Verification Status Update', 'Update', $property);
                //=====logs=====
                return redirect()->route(getRolePrefix() . 'properties.index')->with('success', 'Property Verification has been updated successfully.');
            } else {
                return redirect()->route(getRolePrefix() . 'properties.verificationedit', $propID)->withInput()->withErrors($validator);
            }
        }
    }


    //status
    public function status(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'status' => 'required|boolean',
        ]);
        $property = Properties::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Property doesn't exist."], 404);
        }
        $property->status = $request->status;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Property', 'Property Status Updated', 'Update', $property);
        //=====logs=====
        return response()->json(['message' => 'Property status updated successfully.'], 200);
    }

    //status
    public function showHome(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'home_status' => 'required|boolean',
        ]);
        $property = Properties::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Property doesn't exist."], 404);
        }
        $property->show_home = $request->home_status;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Property', 'Property on Home Status Updated', 'Update', $property);
        //=====logs=====
        return response()->json(['message' => 'Property on Home status updated successfully.'], 200);
    }


     public function is_verified(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'is_verified' => 'required|boolean',
        ]);
        $property = Properties::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Property doesn't exist."], 404);
        }
        $property->is_verified = $request->is_verified;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Property', 'Property on  verified', 'Verified', $property);
        //=====logs=====
        return response()->json(['message' => 'Property verified successfully.'], 200);
    }

      public function premium(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'premium' => 'required|boolean',
        ]);
        $property = Properties::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Property doesn't exist."], 404);
        }
        $property->premium = $request->premium;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Property', 'Property on  premium', 'Verified', $property);
        //=====logs=====
        return response()->json(['message' => 'Property premium successfully.'], 200);
    }

    
    
    //delete
    public function destroy($property)
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
        return redirect()->route(getRolePrefix() . 'properties.index')->with('success', 'Properties deleted successfully.');
    }

    public function prop_verification_delete($property)
    {
        $propertyrow = decode_string($property);
        $propertyitem = Properties::find($propertyrow);
        if (empty($propertyitem)) {
            return redirect()->route(getRolePrefix() . 'properties.verification')->with('error', "Properties Verification doesn't exist.");
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
        return redirect()->route(getRolePrefix() . 'properties.verification')->with('success', 'Properties for verification deleted successfully.');
    }

    public function deleteImage(Request $request)
    {
        $property = Properties::findOrFail($request->id);

        $imageToDelete = $request->input('image');
        $imagePath = public_path('uploads/properties/' . $imageToDelete);

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
