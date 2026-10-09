<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Settings;
use App\Helpers\Log;

class AgentSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     $this->middleware('permission:setting-dashboard|setting-profile|setting-settings|setting-social-media|setting-change-password', ['only' => ['index','show']]);
    //     $this->middleware('permission:setting-profile', ['only' => ['profile']]);
    //     $this->middleware('permission:setting-settings', ['only' => ['global_setting','website_script']]);
    //     $this->middleware('permission:setting-social-media', ['only' => ['social_media']]);
    //     $this->middleware('permission:setting-change-password', ['only' => ['password']]);
    // }

    //INDEX
    public function index(){
        $settingrow = Settings::where('id', '1')->first();
        return view('agent.settings.index', compact('settingrow'));
    }

    //ACTIVITIES LOGS
    public function activities_logs(Request $request)
    {
        if ($request->isMethod('GET')) {
            if(current_auth_user()->hasRole('Superadmin')){
                $logactivities = Log::select('user_logs.*', 'users.name as UserName')->leftJoin('users', 'users.id', '=', 'user_logs.user_id')->latest('user_logs.id')->get();
            } else {
                $logactivities = Log::select('user_logs.*', 'users.name as UserName')->leftJoin('users', 'users.id', '=', 'user_logs.user_id')->where('users.id', '!=', 1)->latest('user_logs.id')->get();
            }
        }
        if ($request->isMethod('POST')) {
            $startDate = trim($request->input('start'));
            $endDate = trim($request->input('end'));
            $startDate = \Carbon\Carbon::parse($startDate)->startOfDay();
            $endDate = \Carbon\Carbon::parse($endDate)->endOfDay();
            $query = Log::select('user_logs.*', 'users.name as UserName')->leftJoin('users', 'users.id', '=', 'user_logs.user_id');
            $query->whereBetween('user_logs.created_at', [$startDate, $endDate]);
            if(!current_auth_user()->hasRole('Superadmin')) {
                $query->where('users.id', '!=', 1);
            }
            $logactivities = $query->latest('user_logs.id')->get();
        }
        return view('admin.settings.activities', compact('logactivities'));
    }

    //PROFILE
    public function profile(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('agent.settings.profile');
        }
        if ($request->isMethod('POST')) {
            $input[] = '';
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required',
            ]);
            if ($validator->passes())
            {
                $input['name'] = $request->name;
                $input['email'] = $request->email;
                $input['phone'] = $request->phone;
                $input['is_theme'] = $request->is_theme;
                current_auth_user()->update($input);
                return redirect()->route(getRolePrefix().'settings.profile')->with('success','profile has been updated successfully.');
            } else {
                return redirect()->route(getRolePrefix().'settings.profile')->withErrors($validator);
            }
        }
    }

    //GLOBAL SETTING
    public function global_setting(Request $request)
    {
        if ($request->isMethod('GET')) {
            $setting = Settings::where('id', '1')->first();
            return view('admin.settings.settings', compact('setting'));
        }
        if ($request->isMethod('POST')) { 
            $validator = Validator::make($request->all(),[
                'companyname' => 'required|max:255',
                'phone' => 'required',
                'email' => 'required|email',
                'address' => 'required',
            ]);
            if ($validator->passes()){
                // Check if the page exists in the database
                $setting = Settings::where('id', '1')->first();
                if ($setting) {
                    if($request->hasFile('logo')){
                        $request->validate([
                        'logo' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:1024',
                        ]);
                        $logofile = 'logo.'.$request->logo->extension();  
                        $request->logo->move(public_path('uploads'), $logofile);
                        $setting->logo = $logofile;
                    }
                    if($request->hasFile('footerlogo')){
                        $request->validate([
                        'footerlogo' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:1024',
                        ]);
                        $footerlogofile = 'footer-logo.'.$request->footerlogo->extension();  
                        $request->footerlogo->move(public_path('uploads'), $footerlogofile);
                        $setting->footerlogo = $footerlogofile;
                    }
                    if($request->hasFile('favicon')){
                        $request->validate([
                        'favicon' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:1024',
                        ]);
                        $faviconfile = 'favicon.'.$request->favicon->extension();  
                        $request->favicon->move(public_path('uploads'), $faviconfile);
                        $setting->favicon = $faviconfile;
                    }
                    $setting->company_name = $request->companyname;
                    $setting->phone = $request->phone;
                    $setting->alt_phone = $request->altphone;
                    $setting->email = $request->email;
                    $setting->alt_email = $request->altemail;
                    $setting->address = $request->address;
                    $setting->alt_address = $request->altaddress;
                    $setting->google_map = $request->googlemap;
                    $setting->custom_text = $request->customtext;
                    $setting->save();
                    return redirect()->route(getRolePrefix().'settings.setting')->with('settingsuccess','Global Setting Updated successfully.');
                } else {
                    $setting = new Settings;
                    if($request->hasFile('logo')){
                        $request->validate([
                        'logo' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:1024',
                        ]);
                        $logofile = 'logo.'.$request->logo->extension();  
                        $request->logo->move(public_path('uploads'), $logofile);
                        $setting->logo = $logofile;
                    }
                    if($request->hasFile('footerlogo')){
                        $request->validate([
                        'footerlogo' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:1024',
                        ]);
                        $footerlogofile = 'footer-logo.'.$request->footerlogo->extension();  
                        $request->footerlogo->move(public_path('uploads'), $footerlogofile);
                        $setting->footerlogo = $footerlogofile;
                    }
                    if($request->hasFile('favicon')){
                        $request->validate([
                        'favicon' => 'required|image|mimes:jpg,png,jpeg,webp,svg|max:1024',
                        ]);
                        $faviconfile = 'favicon.'.$request->favicon->extension();  
                        $request->favicon->move(public_path('uploads'), $faviconfile);
                        $setting->favicon = $faviconfile;
                    }
                    $setting->company_name = $request->companyname;
                    $setting->phone = $request->phone;
                    $setting->alt_phone = $request->altphone;
                    $setting->email = $request->email;
                    $setting->alt_email = $request->altemail;
                    $setting->address = $request->address;
                    $setting->alt_address = $request->altaddress;
                    $setting->google_map = $request->googlemap;
                    $setting->custom_text = $request->customtext;
                    $setting->id = '1';
                    $setting->save();
                    return redirect()->route(getRolePrefix().'settings.setting')->with('settingsuccess','Global Setting has been added successfully.');
                }
            } else {
                return redirect()->route(getRolePrefix().'settings.setting')->withInput()->withErrors($validator);
            }
        }
    }

    //CUSTOM SCRIPT
    public function website_script(Request $request){
        $validator = Validator::make($request->all(),[
            'headerscript' => 'required',
            'bodyscript' => 'required',
            'footerscript' => 'required',
        ]);
        if ($validator->passes()){
            $setting = Settings::where('id', '1')->first();
                if ($setting) {
                    $setting->header_script = $request->headerscript;
                    $setting->body_script = $request->bodyscript;
                    $setting->footer_script = $request->footerscript;
                    $setting->save();
                    return redirect()->route(getRolePrefix().'settings.setting')->with('success','Global Setting Updated successfully.');
                } else {
                    $setting = new Settings;
                    $setting->header_script = $request->headerscript;
                    $setting->body_script = $request->bodyscript;
                    $setting->footer_script = $request->footerscript;
                    $setting->id = '1';
                    $setting->save();
                    return redirect()->route(getRolePrefix().'settings.setting')->with('success','Global Setting added successfully.');
                }
        } else {
            return redirect()->route(getRolePrefix().'settings.setting')->withInput()->withErrors($validator);
        }
    }

    //SOCIAL MEDIA
    public function social_media(Request $request)
    {
        if ($request->isMethod('GET')) {
            $setting = Settings::where('id', '1')->first();
            return view('admin.settings.social-media', compact('setting'));
        }
        if($request->isMethod('POST')) {
            $validator = Validator::make($request->all(),[
                'facebook' => 'required',
                'instagram' => 'required',
                'linkedin' => 'required',
            ]);
            if ($validator->passes()){
                $setting = Settings::where('id', '1')->first();
                    if ($setting) {
                        $setting->facebook = $request->facebook;
                        $setting->instagram = $request->instagram;
                        $setting->linkedin = $request->linkedin;
                        $setting->twitter = $request->twitter;
                        $setting->youtube = $request->youtube;
                        $setting->pinterest = $request->pinterest;
                        $setting->whatsapp = $request->whatsapp;
                        $setting->telegram = $request->telegram;
                        $setting->save();
                        return redirect()->route(getRolePrefix().'settings.social-media')->with('success','Social Media has been Updated successfully.');
                    } else {
                        $setting = new Settings;
                        $setting->facebook = $request->facebook;
                        $setting->instagram = $request->instagram;
                        $setting->linkedin = $request->linkedin;
                        $setting->twitter = $request->twitter;
                        $setting->youtube = $request->youtube;
                        $setting->pinterest = $request->pinterest;
                        $setting->whatsapp = $request->whatsapp;
                        $setting->telegram = $request->telegram;
                        $setting->id = '1';
                        $setting->save();
                        return redirect()->route(getRolePrefix().'settings.social-media')->with('success','Social Media has been added successfully.');
                    }
            } else {
                return redirect()->route(getRolePrefix().'settings.social-media')->withInput()->withInput()->withErrors($validator);
            }
        }
    }

    //CHANGE PASSWORD 
    public function password(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('agent.settings.change-password');
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
            ]);
            #Match The Old Password
            if(!Hash::check($request->old_password, current_auth_user()->password)){
                return redirect()->route(getRolePrefix().'settings.password')->withInput()->with("error", "Old Password Doesn't match!");
            }
            #Update the new Password
            User::whereId(current_auth_user()->id)->update([
                'password' => Hash::make($request->new_password),
                'password_backup' => base64_encode($request->new_password)
            ]); 
            return redirect()->route(getRolePrefix().'settings.password')->with("success", 'Password updated successfully');
        }
    }


}
