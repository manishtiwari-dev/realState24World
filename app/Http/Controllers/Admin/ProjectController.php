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
use App\Models\Project;


use App\Helpers\Log;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    public function index()
    {
        $data['project'] = Project::orderBy('created_at', 'desc')->get();
        return view('admin.project.index', $data);
    }




    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            return view('admin.project.create', $data);
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:projects,slug',
                'state' => 'required|integer',
            ]);
            if ($validator->passes()) {
                $project = new Project;


                if ($request->hasFile('thumbnail')) {
                    $request->validate([
                        'thumbnail' => 'required|image',
                    ]);
                    $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/project'), $thumbImage);
                    $project->thumbnail = $thumbImage;
                }

                if ($request->hasFile('company_logo')) {
                    $request->validate([
                        'company_logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $company_logoImage = 'company_logo_' . time() . '.' . $request->company_logo->extension();
                    $request->company_logo->move(public_path('uploads/project'), $company_logoImage);
                    $project->company_logo = $company_logoImage;
                }


                /* for image*/
                $randomslug   = Str::lower(Str::random(10));
                $btn_type = $request->btnsubmit;
                // $property->category_id = $request->category;
                $project->name = $request->name;
                $project->slug = Str::slug($request->slug).'-'.$randomslug;
                $project->address = $request->address;
                $project->city = $request->city;
                $project->state_id = $request->state;
                $project->status = '1';
                // $project->premium_status = $request->premium_status;
                $project->about = $request->about;
                $project->website = $request->website;
                $project->facebook_link = $request->facebook_link;
                $project->linkedin_link = $request->linkedin_link;
                $project->instagram_link = $request->instagram_link;
                $project->twitter_link = $request->twitter_link;
                $project->zip = $request->zip;
                $project->country = $request->country;
                $project->company_name = $request->company_name;
                $project->save();

                //dealer create

                $dealer = new Dealer;
                $dealerCode = 'H24D' . date('dmy') . strtoupper(substr(uniqid(), -5));
                // if ($request->hasFile('thumbnail')) {
                //     $request->validate([
                //         'thumbnail' => 'required',
                //     ]);
                //     $thumbImagedealer = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                //     $request->thumbnail->move(public_path('uploads/dealer'), $thumbImagedealer);
                //     $dealer->profile_photo = $thumbImagedealer;
                // }

                // if ($request->hasFile('company_logo')) {
                //     $request->validate([
                //         'company_logo' => 'required',
                //     ]);
                //     $company_logoImagedealer = 'company_logo_' . time() . '.' . $request->company_logo->extension();
                //     $request->company_logo->move(public_path('uploads/dealer'), $company_logoImagedealer);
                //     $dealer->company_logo = $company_logoImagedealer;
                // }

                $dealer->unique_code = $dealerCode;
                $dealer->first_name = $request->name;
                $dealer->last_name = '';
                $dealer->name = $request->name . ' ' . $request->last_name;
                // Generate unique email
                $baseEmailName = strtolower(preg_replace('/\s+/', '.', trim($request->name))); // john.doe
                $domain = 'gmail.com';
                $email = $baseEmailName . '@' . $domain;
                $counter = 1;

                // Check uniqueness in DB
                while (Dealer::where('email', $email)->exists()) {
                    $email = $baseEmailName . $counter . '@' . $domain;
                    $counter++;
                }
                $dealer->company_name = $request->company_name;
                $dealer->email = $email;
                $dealer->address = $request->address;
                $dealer->city = $request->city;
                $dealer->state = $request->state;
                $dealer->about = $request->about;
                $dealer->website = $request->website;
                $dealer->facebook_link = $request->facebook_link;
                $dealer->linkedin_link = $request->linkedin_link;
                $dealer->instagram_link = $request->instagram_link;
                $dealer->twitter_link = $request->twitter_link;
                $dealer->zip = $request->zip;
                $dealer->country = $request->country;
                $dealer->save();


                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Project', 'New Project Created', 'Create', $project);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'project.create')->with('success', 'Project has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'project.index')->with('success', 'Project has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'project.create')->withInput()->withErrors($validator);
            }
        }
    }

    public function update(Request $request, $propID)
    {

        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);

            $data['projectrow'] = Project::find($newprop);
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            if (empty($data['projectrow'])) {
                return redirect()->route(getRolePrefix() . 'project.index')->with('error', "Project doesn't exist.");
            }
            return view('admin.project.edit', $data);
        }
        if ($request->method() == 'POST') {
            $newproperty = decode_string($propID);
            $project = Project::find($newproperty);
            if (empty($project)) {
                return redirect()->route(getRolePrefix() . 'project.index')->with('error', "Project doesn't exist.");
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:projects,slug,' . $project->id . ',id',
                'state' => 'required|integer',

            ]);
            if ($validator->passes()) {
                /* for image*/
                if ($request->hasFile('thumbnail')) {
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/project'), $thumbImage);
                    $project->thumbnail = $thumbImage;
                }

                if ($request->hasFile('company_logo')) {
                    $request->validate([
                        'company_logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $company_logoImage = 'company_logo_' . time() . '.' . $request->company_logo->extension();
                    $request->company_logo->move(public_path('uploads/project'), $company_logoImage);
                    $project->company_logo = $company_logoImage;
                }
                /* for image*/
                $btn_type = $request->btnsubmit;
                // $property->category_id = $request->category;
                $project->name = $request->name;
                $project->slug = Str::slug($request->slug);
                $project->address = $request->address;
                $project->city = $request->city;
                $project->state_id = $request->state;
                $project->status = '1';
                // $project->premium_status = $request->premium_status;
                $project->about = $request->about;
                $project->website = $request->website;
                $project->facebook_link = $request->facebook_link;
                $project->linkedin_link = $request->linkedin_link;
                $project->instagram_link = $request->instagram_link;
                $project->twitter_link = $request->twitter_link;
                $project->zip = $request->zip;
                $project->country = $request->country;
                $project->company_name = $request->company_name;
                $project->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Project', 'Project Update', 'Update', $project);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'project.edit', $propID)->with('success', 'Project has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'project.index')->with('success', 'Project has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'project.edit', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function show($propID)
    {

        $data['project'] = Project::find($propID);
        $data['properties'] = Properties::where('project_id', $propID)->orderBy('created_at', 'desc')->get();
        return view('admin.project.property', $data);
    }


    public function property_create(Request $request, $propID)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            $data['project'] = Project::find($propID);

            return view('admin.project.project_property_create', $data);
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
                $property->project_id = $propID;


                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'New Property Created', 'Create', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'project.property_create', $propID)->with('success', 'Property has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'project.show', $propID)->with('success', 'Property has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'project.property_create', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function property_update(Request $request, $propID)
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
            return view('admin.project.project_property_edit', $data);
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
                $property->project_id =  $request->project_id;

                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'Property Update', 'Update', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'properties.property_update', $propID)->with('success', 'Property has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'project.show',$request->project_id)->with('success', 'Property has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'properties.property_update', $propID)->withInput()->withErrors($validator);
            }
        }
    }



    //status
    public function status(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:projects,id',
            'status' => 'required|boolean',
        ]);
        $property = Project::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Property doesn't exist."], 404);
        }
        $property->status = $request->status;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Project', 'Project Status Updated', 'Update', $property);
        //=====logs=====
        return response()->json(['message' => 'Project status updated successfully.'], 200);
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
            return response()->json(['message' => "Project doesn't exist."], 404);
        }
        $property->show_home = $request->home_status;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Project', 'Project on Home Status Updated', 'Update', $property);
        //=====logs=====
        return response()->json(['message' => 'Project on Home status updated successfully.'], 200);
    }


    public function is_verified(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'is_verified' => 'required|boolean',
        ]);
        $property = Properties::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Project doesn't exist."], 404);
        }
        $property->is_verified = $request->is_verified;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Property', 'Project on  verified', 'Verified', $property);
        //=====logs=====
        return response()->json(['message' => 'Project verified successfully.'], 200);
    }




    //delete
    public function destroy($property)
    {
        $propertyitem = Project::find($property);
        if (empty($propertyitem)) {
            return redirect()->route(getRolePrefix() . 'project.index')->with('error', "Project doesn't exist.");
        }
        if (!empty($propertyitem->thumbnail)) {
            if (file_exists(public_path('uploads/project/' . $propertyitem->thumbnail))) {
                unlink(public_path('uploads/project/' . $propertyitem->thumbnail));
            }
        }
        if (!empty($propertyitem->banner)) {
            if (file_exists(public_path('uploads/project/' . $propertyitem->banner))) {
                unlink(public_path('uploads/project/' . $propertyitem->banner));
            }
        }
        $propertyitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Project', 'Project Delete', 'Delete', $propertyitem);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'project.index')->with('success', 'Project deleted successfully.');
    }


     public function property_destroy($property)
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
        return redirect()->route(getRolePrefix() . 'project.show',$propertyitem->project_id)->with('success', 'Properties deleted successfully.');
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
