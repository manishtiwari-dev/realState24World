<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Dealer;
use App\Helpers\Log;
use App\Models\State;

class AgentDealerController extends Controller
{


    public function index(Request $request): View
    {
        $user_auth = current_auth_user()->id;
        // is_verified
        $data = Dealer::latest()
            ->where('is_verified', 1)
            ->where('user_id', $user_auth)
            ->get();
            
        return view('agent.dealer.index', compact('data'))->with('i');
    }

    public function create(): View
    {
        $data['state'] = State::all();

        return view('agent.dealer.create',$data);
    }

    /*** Store a newly created resource in storage*/
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'about' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            //  'is_verified' => 'required',
            // 'is_status' => 'required',
        ]);
        if ($validator->passes()) {
            $dealer = new Dealer;
            //Generate a unique agent code
            $dealerCode = 'H24D' . date('dmy') . strtoupper(substr(uniqid(), -5));
            /* for image*/
            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('uploads/dealer'), $thumbImage);
                $dealer->profile_photo = $thumbImage;
            }
            if ($request->hasFile('documents')) {
                $request->validate([
                    'documents' => 'required',
                ]);
                $documentsImage = 'documents_' . time() . '.' . $request->documents->extension();
                $request->documents->move(public_path('uploads/document'), $documentsImage);
                $dealer->documents = $documentsImage;
            }

            $user_auth = current_auth_user()->id;
            $btn_type = $request->btnsubmit;
            $dealer->unique_code = $dealerCode;
            $dealer->user_id = $user_auth;
            $dealer->first_name = $request->first_name;
            $dealer->last_name = $request->last_name;
            $dealer->name = $request->first_name . ' ' . $request->last_name;
            $dealer->company_name = $request->company_name;
            $dealer->phone = $request->phone;
            $dealer->email = $request->email;
            $dealer->about = $request->about;
            $dealer->website = $request->website;
            $dealer->facebook_link = $request->facebook_link;
            $dealer->linkedin_link = $request->linkedin_link;
            $dealer->address = $request->address;
            $dealer->city = $request->city;
            $dealer->state = $request->state;
            $dealer->zip = $request->zip;
            $dealer->country = $request->country;
            $dealer->license_number = $request->license_number;
            $dealer->is_verified = '0';
            $dealer->is_status = '1';
            $dealer->save();

            $user = new User;
            $user->is_role = '3'; //dealer
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->password_backup = base64_encode($request->password);
            $user->password = Hash::make($request->password);
            $user->save();

            //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Dealer', 'New Dealer Created', 'Create', $dealer);
            //=====logs=====
            if ($btn_type == 'saveandnew') {
                return redirect()->route(getRolePrefix() . 'dealer.create')->with('success', 'Dealer has been created successfully.');
            } else {
                return redirect()->route(getRolePrefix() . 'dealer.index')->withInput()->with('success', 'Dealer has been created successfully.');
            }
        } else {
            return redirect()->route(getRolePrefix() . 'dealer.create')->withErrors($validator);
        }
    }

    public function edit($id): View
    {
        $dealer = Dealer::find($id);
        $state = State::all();

        return view('agent.dealer.edit', compact('dealer','state'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $existingUser = User::where('email', $request->email)->first();
        $existingUserId = $existingUser ? $existingUser->id : null;

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'about' => 'required',
            'email' => 'required|email|unique:users,email,' . $existingUserId,
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            // 'is_verified' => 'required',
            // 'is_status' => 'required',
        ]);
        if ($validator->passes()) {
            $dealer = Dealer::find($id);
            /* for image*/
            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('uploads/dealer'), $thumbImage);
                $dealer->profile_photo = $thumbImage;
            }
            
            if ($request->hasFile('documents')) {
                $request->validate([
                    'documents' => 'required',
                ]);
                $documentsImage = 'documents_' . time() . '.' . $request->documents->extension();
                $request->documents->move(public_path('uploads/document'), $documentsImage);
                $dealer->documents = $documentsImage;
            }

            $user_auth = current_auth_user()->id;
            $dealer->user_id = $user_auth;
            $dealer->first_name = $request->first_name;
            $dealer->last_name = $request->last_name;
            $dealer->name = $request->first_name . ' ' . $request->last_name;
            $dealer->company_name = $request->company_name;
            $dealer->phone = $request->phone;
            $dealer->email = $request->email;
            $dealer->about = $request->about;
            $dealer->website = $request->website;
            $dealer->facebook_link = $request->facebook_link;
            $dealer->linkedin_link = $request->linkedin_link;
            $dealer->address = $request->address;
            $dealer->city = $request->city;
            $dealer->state = $request->state;
            $dealer->zip = $request->zip;
            $dealer->country = $request->country;
            $dealer->license_number = $request->license_number;
            $dealer->update();

            if (!empty($existingUser)) {
                $user = User::find($existingUser->id);
                $user->is_role = '3';
                $user->email = $request->email;
                $user->password_backup = base64_encode($request->password);
                $user->password = Hash::make($request->password);
                $user->update();
            } else {
                $user = new User;
                $user->is_role = '3';
                $user->name = $request->first_name . ' ' . $request->last_name;
                $user->email = $request->email;
                $user->password_backup = base64_encode($request->password);
                $user->password = Hash::make($request->password);
                $user->save();
            }

            //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Dealer', 'Dealer Updated', 'Update', $dealer);
            //=====logs=====
            return redirect()->route(getRolePrefix() . 'dealer.index')->withInput()->with('success', 'Dealer has been updated successfully.');
        } else {
            return redirect()->route(getRolePrefix() . 'dealer.edit', $id)->withErrors($validator);
        }
    }


    public function show($id): View
    {
        $dealer = Dealer::with('property')->find($id);
        return view('agent.dealer.show', compact('dealer'));
    }

    public function destroy($id): RedirectResponse
    {
        $dealer = Dealer::find($id);
        Dealer::find($id)->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Dealer', 'Dealer Account Deleted', 'Delete', $dealer);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'dealer.index')->with('success', 'Dealer deleted successfully');
    }
}
