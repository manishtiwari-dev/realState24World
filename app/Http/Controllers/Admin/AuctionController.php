<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Auction;
use Illuminate\Support\Str;
use App\Models\Properties;
use App\Models\Category;
use App\Models\Dealer;
use App\Models\State;
use App\Helpers\Log;

class AuctionController extends Controller
{
    public function index(){
        $data['auctions'] = Auction::orderBy('created_at', 'desc')->get();
        return view('admin.auctions.index', $data);
    }

    public function create(Request $request)
    {
        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            return view('admin.auctions.create', $data);
        }
        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:auctions,slug',
                'type' => 'required',
                'amount' => 'required|numeric',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|integer',
                'landmark' => 'required|string',
                'dealer' => 'required|integer',
            ]);
            if ($validator->passes()) {
                $property = new Auction;
                /* for image*/
                if ($request->hasFile('thumbnail')) {
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/auction'), $thumbImage);
                    $property->thumbnail = $thumbImage;
                }
                if ($request->hasFile('noticefile')) {
                    $noticeImage = 'notice_' . time() . '.' . $request->noticefile->extension();
                    $request->noticefile->move(public_path('uploads/auction'), $noticeImage);
                    $property->notice = $noticeImage;
                }
                if ($request->hasFile('banner')) {
                    $request->validate([
                        'banner.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $uploadedImages = [];
                    foreach ($request->file('banner') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/auction'), $imageName);
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
                $property->last_date = $request->last_date;
                $property->amount = $request->amount;
                $property->address = $request->address;
                $property->city = $request->city;
                $property->state_id = $request->state;
                $property->landmark = $request->landmark;
                $property->dealer_id = $request->dealer;
                $property->status = $request->status;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->status = '1';
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Auction', 'New Auction Property Created', 'Create', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'auctions.create')->with('success', 'Auction Property has been created successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'auctions.index')->with('success', 'Auction Property has been created successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'auctions.create')->withInput()->withErrors($validator);
            }
        }
    }

    public function update(Request $request, $propID)
    {
        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);
            $data['propertyrow'] = Auction::find($newprop);
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            if (empty($data['propertyrow'])) {
                return redirect()->route(getRolePrefix() . 'auctions.index')->with('error', "Auction Property doesn't exist.");
            }
            return view('admin.auctions.edit', $data);
        }
        if ($request->method() == 'POST') {
            $newproperty = decode_string($propID);
            $property = Auction::find($newproperty);
            if (empty($property)) {
                return redirect()->route(getRolePrefix() . 'auctions.index')->with('error', "Auction Property doesn't exist.");
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|unique:auctions,slug,' . $property->id . ',id',
                'type' => 'required',
                'amount' => 'required|numeric',
                'address' => 'required|string',
                'city' => 'required|string',
                'state' => 'required|integer',
                'landmark' => 'required|string',
                'dealer' => 'required|integer',
            ]);
            if ($validator->passes()) {
                /* for image*/
                if ($request->hasFile('thumbnail')) {
                    $request->validate([
                        'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                    $request->thumbnail->move(public_path('uploads/auction'), $thumbImage);
                    $property->thumbnail = $thumbImage;
                }
                if ($request->hasFile('noticefile')) {
                    $noticeImage = 'notice_' . time() . '.' . $request->noticefile->extension();
                    $request->noticefile->move(public_path('uploads/auction'), $noticeImage);
                    $property->notice = $noticeImage;
                }
                if ($request->hasFile('banner')) {
                    $request->validate([
                        'banner.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);
                    $uploadedImages = [];
                    foreach ($request->file('banner') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/auction'), $imageName);
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
                $property->last_date = $request->last_date;
                $property->amount = $request->amount;
                $property->address = $request->address;
                $property->city = $request->city;
                $property->state_id = $request->state;
                $property->landmark = $request->landmark;
                $property->dealer_id = $request->dealer;
                $property->status = $request->status;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->status = '1';
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Auction', 'Auction Property Update', 'Update', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route(getRolePrefix() . 'auctions.edit', $propID)->with('success', 'Auction Property has been updated successfully.');
                } else {
                    return redirect()->route(getRolePrefix() . 'auctions.index')->with('success', 'Auction Property has been updated successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix() . 'auctions.edit', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function status(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:auctions,id',
            'status' => 'required|boolean',
        ]);
        $property = Auction::find($request->property_id);
        if (empty($property)) {
            return response()->json(['message' => "Auction Property doesn't exist."], 404);
        }
        $property->status = $request->status;
        $property->save();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Auction', 'Auction Property Status Updated', 'Update', $property);
        //=====logs=====
        return response()->json(['message' => 'Auction Property status updated successfully.'], 200);
    }

    public function destroy($property)
    {
        $propertyitem = Auction::find($property);
        if (empty($propertyitem)) {
            return redirect()->route(getRolePrefix() . 'auctions.index')->with('error', "Auction Properties doesn't exist.");
        }
        if (!empty($propertyitem->thumbnail)) {
            if (file_exists(public_path('uploads/auction/' . $propertyitem->thumbnail))) {
                unlink(public_path('uploads/auction/' . $propertyitem->thumbnail));
            }
        }
        if (!empty($propertyitem->banner)) {
            if (file_exists(public_path('uploads/auction/' . $propertyitem->banner))) {
                unlink(public_path('uploads/auction/' . $propertyitem->banner));
            }
        }
        $propertyitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Auctions', 'Auction Property Delete', 'Delete', $propertyitem);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'auctions.index')->with('success', 'Auction Property deleted successfully.');
    }

    public function deleteImage(Request $request)
    {
        $property = Auction::findOrFail($request->id);
        $imageToDelete = $request->input('image');
        $imagePath = public_path('uploads/auction/' . $imageToDelete);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $images = json_decode($property->multiple_images, true);
        if (($key = array_search($imageToDelete, $images)) !== false) {
            unset($images[$key]);
            $property->multiple_images = json_encode(array_values($images));
            $property->save();
        }
        return response()->json(['success' => true, 'message' => 'Auction Image deleted successfully.']);
    }
}
