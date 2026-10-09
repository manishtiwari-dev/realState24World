<?php

namespace App\Http\Controllers\Agent;

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

class AgentPropertiesController extends Controller
{
    public function index()
    {
        $user_auth = current_auth_user()->id;

        $data['properties'] = Properties::orderBy('created_at', 'desc')->where('user_id', $user_auth)->get();
        return view('agent.properties.index', $data);
    }

    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $user_auth = current_auth_user()->id;
            $data['dealers'] = Dealer::latest()
                ->where('is_verified', 1)
                ->where('user_id', $user_auth)
                ->get();
            $data['state'] = State::all();
            return view('agent.properties.create', $data);
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
                'bedrooms' => 'nullable|integer',
                'accomodation' => 'nullable|integer',
                'bathrooms' => 'nullable|integer',
                'yard_size' => 'nullable|integer',
                'garage' => 'nullable|integer',
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

               $user_auth = current_auth_user()->id;

                /* for image*/
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->user_id = $user_auth;
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
                $property->yard_size = $request->yard_size;
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
                $property->dealer_id = $request->dealer;
                $property->status = $request->status;
                $property->property_type = $request->property_type;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->status = '1';
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
            $user_auth = current_auth_user()->id;
            $data['dealers'] = Dealer::latest()
                ->where('is_verified', 1)
                ->where('user_id', $user_auth)
                ->get();
            $data['state'] = State::all();
            if (empty($data['propertyrow'])) {
                return redirect()->route(getRolePrefix() . 'properties.index')->with('error', "Property doesn't exist.");
            }
            return view('agent.properties.edit', $data);
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
                'bedrooms' => 'nullable|integer',
                'accomodation' => 'nullable|integer',
                'bathrooms' => 'nullable|integer',
                'yard_size' => 'nullable|integer',
                'garage' => 'nullable|integer',
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

                $user_auth = current_auth_user()->id;

                /* for image*/
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->user_id =  $user_auth;
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
                $property->yard_size = $request->yard_size;
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
                $property->dealer_id = $request->dealer;
                $property->status = $request->status;
                $property->property_type = $request->property_type;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
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
