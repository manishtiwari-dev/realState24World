<?php

namespace App\Http\Controllers\Admin;

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
use App\Models\Agents;
use App\Helpers\Log;
use App\Models\State;


class AgentsController extends Controller
{
    public function index(Request $request): View
    {
        $data = Agents::latest()->get();
        return view('admin.agent.index', compact('data'))->with('i');
    }

    public function create(): View
    {
        $data['state'] = State::all();

        return view('admin.agent.create', $data);
    }

    /*** Store a newly created resource in storage*/
    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'phone' => 'required',
            'about' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'is_verified' => 'required',
            'is_status' => 'required',
            'company_name' => 'required',

        ]);
        if ($validator->passes()) {
            $agent = new Agents;
            //Generate a unique agent code
            $agentCode = 'H24' . date('dmy') . strtoupper(substr(uniqid(), -5));
            /* for image*/
            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('uploads/agents'), $thumbImage);
                $agent->profile_photo = $thumbImage;
            }

            if ($request->hasFile('company_logo')) {
                $request->validate([
                    'company_logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $company_logoImage = 'company_logo_' . time() . '.' . $request->company_logo->extension();
                $request->company_logo->move(public_path('uploads/agents'), $company_logoImage);
                $agent->company_logo = $company_logoImage;
            }


            if ($request->hasFile('documents')) {
                $request->validate([
                    'documents' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $documentsImage = 'documents_' . time() . '.' . $request->documents->extension();
                $request->documents->move(public_path('uploads/document'), $documentsImage);
                $agent->documents = $documentsImage;
            }
            $btn_type = $request->btnsubmit;
            $agent->agent_code = $agentCode;
            $agent->first_name = $request->first_name;
            $agent->last_name = $request->last_name;
            $agent->name = $request->first_name . ' ' . $request->last_name;
            $agent->phone = $request->phone;
            $agent->email = $request->email;
            $agent->about = $request->about;
            $agent->company_name = $request->company_name;
            $agent->website = $request->website;
            $agent->facebook_link = $request->facebook_link;
            $agent->linkedin_link = $request->linkedin_link;
            $agent->instagram_link = $request->instagram_link;
            $agent->twitter_link = $request->twitter_link;
            $agent->address = $request->address;
            $agent->city = $request->city;
            $agent->state = $request->state;
            $agent->zip = $request->zip;
            $agent->country = $request->country;
            $agent->license_number = $request->license_number;
            $agent->is_verified = $request->is_verified;
            $agent->is_status = $request->is_status;
            $agent->save();

            $user = new User;
            $user->is_role = '2'; //agent
            $user->name = $request->first_name . ' ' . $request->last_name;
            $user->email = $request->email;
            $user->password_backup = base64_encode($request->password);
            $user->password = Hash::make($request->password);
            $user->save();




            //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Agent', 'New Agent Created', 'Create', $agent);
            //=====logs=====
            if ($btn_type == 'saveandnew') {
                return redirect()->route(getRolePrefix() . 'agent.create')->with('success', 'Agent has been created successfully.');
            } else {
                return redirect()->route(getRolePrefix() . 'agent.index')->withInput()->with('success', 'Agent has been created successfully.');
            }
        } else {
            return redirect()->route(getRolePrefix() . 'agent.create')->withErrors($validator);
        }
    }



    public function edit($id): View
    {
        $agent = Agents::find($id);
        $state = State::all();

        return view('admin.agent.edit', compact('agent', 'state'));
    }

    public function update(Request $request, $id): RedirectResponse
    {

        $existingUser = User::where('email', $request->email)->first();
        $existingUserId = $existingUser ? $existingUser->id : null;

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'phone' => 'required',
            'about' => 'required',
            'email' => 'required|email|unique:users,email,' . $existingUserId,
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
            'is_verified' => 'required',
            'is_status' => 'required',
            'company_name' => 'required',

        ]);
        if ($validator->passes()) {
            $agent = Agents::find($id);
            /* for image*/
            if ($request->hasFile('thumbnail')) {
                $request->validate([
                    'thumbnail' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $thumbImage = 'thumbnail_' . time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('uploads/agents'), $thumbImage);
                $agent->profile_photo = $thumbImage;
            }

            if ($request->hasFile('company_logo')) {
                $request->validate([
                    'company_logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $company_logoImage = 'company_logo_' . time() . '.' . $request->company_logo->extension();
                $request->company_logo->move(public_path('uploads/agents'), $company_logoImage);
                $agent->company_logo = $company_logoImage;
            }

            if ($request->hasFile('documents')) {
                $request->validate([
                    'documents' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $documentsImage = 'documents_' . time() . '.' . $request->documents->extension();
                $request->documents->move(public_path('uploads/document'), $documentsImage);
                $agent->documents = $documentsImage;
            }
            $agent->first_name = $request->first_name;
            $agent->last_name = $request->last_name;
            $agent->name = $request->first_name . ' ' . $request->last_name;
            $agent->phone = $request->phone;
            $agent->email = $request->email;
            $agent->about = $request->about;
            $agent->company_name = $request->company_name;
            $agent->website = $request->website;
            $agent->facebook_link = $request->facebook_link;
            $agent->linkedin_link = $request->linkedin_link;
            $agent->instagram_link = $request->instagram_link;
            $agent->twitter_link = $request->twitter_link;
            $agent->address = $request->address;
            $agent->city = $request->city;
            $agent->state = $request->state;
            $agent->zip = $request->zip;
            $agent->country = $request->country;
            $agent->license_number = $request->license_number;
            $agent->is_verified = $request->is_verified;
            $agent->is_status = $request->is_status;
            $agent->update();


            if (!empty($existingUser)) {
                $user = User::find($existingUser->id);
                $user->is_role = '2';
                $user->email = $request->email;
                $user->password_backup = base64_encode($request->password);
                $user->password = Hash::make($request->password);
                $user->update();
            } else {
                $user = new User;
                $user->is_role = '2';
                $user->name = $request->first_name . ' ' . $request->last_name;
                $user->email = $request->email;
                $user->password_backup = base64_encode($request->password);
                $user->password = Hash::make($request->password);
                $user->save();
            }


            //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Agent', 'Agent Updated', 'Update', $agent);
            //=====logs=====
            return redirect()->route(getRolePrefix() . 'agent.index')->withInput()->with('success', 'Agent has been updated successfully.');
        } else {
            return redirect()->route(getRolePrefix() . 'agent.edit', $id)->withErrors($validator);
        }
    }


    public function show($id)
    {
        $agent = Agents::with('user', 'user.property')->find($id);

        return view('admin.agent.show', compact('agent'));
    }

    public function destroy($id): RedirectResponse
    {
        $agent = Agents::find($id);
        Agents::find($id)->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Agent', 'Agent Account Deleted', 'Delete', $agent);
        //=====logs=====
        return redirect()->route(getRolePrefix() . 'agent.index')->with('success', 'Agent deleted successfully');
    }

  

    

}
