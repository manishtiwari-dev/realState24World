<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Rules\ReCaptcha;
use App\Models\Banners;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use App\Models\ReturnPolicy;
use App\Models\Testimonial;
use App\Models\Blogs;
use App\Models\Faq;
use App\Models\BlogTag;
use App\Models\About;
use App\Models\State;
use App\Models\Properties;
use App\Models\User;
use App\Models\Dealer;
use App\Models\Project;
use App\Models\PgProperty;
use App\Models\UserRecord;
use App\Models\Category;
use App\Models\Enquiry;
use App\Helpers\Log;
use App\Models\Auction;
use App\Models\Review;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class FrontController extends Controller
{
    public function index()
    {
        $data['bannerow'] = Banners::where('status', 1)->where('banner_type', 1)->orderBy('display_order', 'ASC')->get();
        $data['testimonial'] = Testimonial::where('status', 1)->orderBy('display_order', 'ASC')->get();
        $data['blogData'] = Blogs::where('status', 1)->latest()->take(3)->get();
        $data['propertiesresult'] = Properties::with('dealer')->where('show_home', 1)->where('status', 1)->limit(9)->get();
        $data['dealerresult'] = Dealer::with('property')->get();
        $data['premiumpropertiesresult'] = Properties::with('dealer')->where('status', 1)->where('premium', 1)->get();
        $data['propertiesonrent'] = Properties::with('dealer')->where('state_id', 68)->where('status', 1)->where('property_type', 2)->get();
        $data['propertiesonsale'] = Properties::with('dealer')->where('state_id', 68)->where('status', 1)->where('property_type', 1)->get();
        return view('front.index', $data);
    }

    public function about()
    {
        $data['aboutData'] = About::where('id', 1)->first();
        return view('front.about', $data);
    }


    public function contact()
    {
        return view('front.contact');
    }


    public function contactAdd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'g-recaptcha-response' => ['required', new ReCaptcha]
        ]);
        if ($validator->passes()) {
            $enquiry = new Enquiry;
            $btn_type = $request->btnsubmit;
            $enquiry->name = $request->name;
            $enquiry->enquiry_type = 3;
            //$enquiry->phone = $request->phone;
            $enquiry->email = $request->email;
            $enquiry->message = $request->message;
            $enquiry->save();
            // try {
            //     $sendtoname = '';
            //     $sendtodevice = '';
            //     $api_key = env('EMAIL_API_KEY');
            //     $api_link = env('EMAIL_API_LINK');
            //     $api_sender_email = env('EMAIL_SENDER_EMAIL');
            //     $api_sender_name = env('EMAIL_SENDER_NAME');
            //     $message_subject = 'Enquiry  from Property.';
            //     // Blade view to HTML
            //     $message_template = '';
            //     $data = [
            //         "sender" => [
            //             "email" => $api_sender_email,
            //             "name" =>  $api_sender_name
            //         ],
            //         "to" => [
            //             [
            //                 "name" => $sendtoname,
            //                 "email" => $sendtodevice
            //             ]
            //         ],
            //         "Cc" => [
            //             [
            //                 "name" => 'Real state',
            //                 "email" => 'support@realState24world.com'
            //             ]
            //         ],
            //         "subject" => $message_subject,
            //         "htmlContent" => $message_template
            //     ];
            //     $ch = curl_init();
            //     curl_setopt($ch, CURLOPT_URL, $api_link);
            //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            //     curl_setopt($ch, CURLOPT_POST, 1);
            //     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            //     $headers = array();
            //     $headers[] = 'Accept: application/json';
            //     $headers[] = 'Api-Key: ' . $api_key;
            //     $headers[] = 'Content-Type: application/json';
            //     curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            //     $result = curl_exec($ch);
            //     curl_close($ch);
            // } catch (\Exception $e) {
            // }
            return redirect()->route('contact-us')->with('success', 'Your request has been sent successfully!');
        } else {
            return redirect()->route('contact-us')->withErrors($validator);
        }
    }

    //login functions
    public function login()
    {
        return view('front.login');
    }

    public function register()
    {
        $data['stateList'] = State::where('country_id', 101)->get();
        return view('front.register', $data);
    }

    public function payment_suceess()
    {
        return view('front.payment-success');
    }


    public function register_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'country' => 'required',
        ]);
        if ($validator->passes()) {
            if ($request->is_role == 0) {
                $userRecord = new UserRecord;
                $btn_type = $request->btnsubmit;
                $userRecord->unique_code = $request->agentcode;
                $userRecord->agent_code = $request->agent;
                $userRecord->first_name = $request->first_name;
                $userRecord->name = $request->first_name;
                $userRecord->company_name = $request->company_name;
                $userRecord->phone = $request->phone;
                $userRecord->altphone = $request->altphone;
                $userRecord->email = $request->email;
                $userRecord->address = $request->address;
                $userRecord->city = $request->city;
                $userRecord->state = $request->state;
                $userRecord->zip = $request->zip;
                $userRecord->country = $request->country;
                $userRecord->property_type = $request->property_type;
                $userRecord->reranumber = $request->reranumber;
                $userRecord->is_status = 1;
                $userRecord->save();
            } else {
                $dealer = new Dealer;
                $btn_type = $request->btnsubmit;
                $dealer->unique_code = $request->agentcode;
                $dealer->first_name = $request->first_name;
                $dealer->name = $request->first_name;
                $dealer->company_name = $request->company_name;
                $dealer->phone = $request->phone;
                $dealer->altphone = $request->altphone;
                $dealer->email = $request->email;
                $dealer->address = $request->address;
                $dealer->city = $request->city;
                $dealer->state = $request->state;
                $dealer->zip = $request->zip;
                $dealer->country = $request->country;
                $dealer->property_type = $request->property_type;
                $dealer->reranumber = $request->reranumber;
                $dealer->is_status = 1;
                $dealer->is_verified = '0';
                $dealer->save();
            }
            $nuser = new User;
            $nuser->is_role = $request->is_role;
            $nuser->name = $request->first_name;
            $nuser->email = $request->email;
            $nuser->phone = $request->phone;
            $nuser->address = $request->address;

            $nuser->password_backup = base64_encode($request->password);
            $nuser->password = Hash::make($request->password);
            $nuser->save();
            //=====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Dealer', 'New  User Created', 'Create', $request->all());
            //=====logs=====
            if ($btn_type == 'saveandnew') {
                return redirect()->route('login')->with('success', 'Account has been created successfully.');
            } else {
                return redirect()->route('login')->withInput()->with('success', 'Account has been created successfully.');
            }
        } else {
            return redirect()->route('register')->withInput()->withErrors($validator);
        }
    }



    public function loginuser(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        //  dd($request->all());
        $user = User::where('email', $validated['email'])->first();

        if (!$user) {

            return back()->with('error', 'Invalid credentials.');
        }

        if ((int)$request->is_role !== (int)$user->is_role) {

            return back()->with('error', 'Invalid credentials.');
        }


        if ((int)$request->is_role == 3) {
            $dealer = Dealer::where('email', $validated['email'])->first();

            if ($dealer->is_status != 1) {
                return back()->with('error', 'Account not verified, please contact the administrator.');
            }
        }


        if ($user->is_status != 1) {
            return back()->with('error', 'Account deactivated, please contact the administrator.');
        }



        $role = $user->is_role;
        $guard = match ($role) {
            1 => 'web',
            2 => 'web',
            3 => 'web',
            0 => 'web'
        };


        if (!$guard) {
            return back()->with('error', 'Invalid user role.');
        }

        if (!Hash::check($validated['password'], $user->password)) {
            return back()->with('error', 'Incorrect password.');
        }
        // Attempt login with the correct guard
        if (Auth::guard($guard)->attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ])) {

            //  dd($guard);

            $request->session()->regenerate();
            session(['guard' => $guard]);

            // =====logs=====
            $logInstance = new Log();
            $logInstance->addToLog('Login', 'User Logged In', 'Login', $request->all());
            ///=====logs=====

            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Invalid login credentials. Please try again.');
    }


    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token

        return redirect('/login'); // Redirect after logout
    }


    //end login function

    //user Dashboard 
    public function dashboard()
    {
        $user = Auth::user();
        $userData = User::find($user->id);

        $data['total_active_property'] = Properties::where('user_id', $userData->id)->where('status', 1)->count();
        $data['total_property'] = Properties::where('user_id', $userData->id)->count();
        $data['total_review'] = Review::where('review_type', 1)->count();
        $data['total_booking'] = Enquiry::where('enquiry_type', 1)->count();
        $data['latest_property'] = Properties::where('user_id', $userData->id)->latest()->take(5)->get();

        return view('front.dashboard', $data);
    }



    public function dashboardmyprofile()
    {
        $userData = Auth::user();

        if ($userData->is_role == 0) {
            $editData  = UserRecord::where('email', $userData->email)->first();
        } else {
            $editData = Dealer::where('email', $userData->email)->first();
        }

        return view('front.dashboard-myprofile', compact('editData', 'userData'));
    }



    public function upload_cover(Request $request)
    {
        $user = Auth::user();
        if ($request->hasFile('company_logo')) {
            $request->validate([
                'company_logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
            ]);
            $coverBanner = $request->file('company_logo');
            $coverImg = 'company_logo_' . time() . '.' . $coverBanner->extension();
            $destinationPath = public_path('uploads/dealer');
            $moveSuccess = $coverBanner->move($destinationPath, $coverImg);
            if ($moveSuccess) {
                $updateSuccess = Dealer::whereId($request->id)
                    ->update(['company_logo' => $coverImg]);
                if ($updateSuccess) {
                    return response()->json(['success' => true, 'message' => 'Cover image was uploaded successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to update user cover image']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to move file']);
            }
        }
        return response()->json(['success' => false, 'message' => 'No file uploaded']);
    }
    //Upload Profile Photo
    public function upload_profile(Request $request)
    {
        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
            ]);

            $profilePicture = $request->file('profile_photo');
            $profileImg = 'profile_photo_' . time() . '.' . $profilePicture->extension();
            $destinationPath = public_path('uploads/user');

            // Move the uploaded file once
            if ($profilePicture->move($destinationPath, $profileImg)) {

                // Update User profile image
                $updateUser = User::whereId($user->id)->update(['profile_photo' => $profileImg]);

                $updateDealer = true;

                // If dealer, copy image to dealer folder and update
                if ($user->is_role == 3) {
                    $dealerPath = public_path('uploads/dealer');
                    if (!File::exists($dealerPath)) {
                        File::makeDirectory($dealerPath, 0755, true);
                    }

                    // Copy image to dealer folder
                    $copied = File::copy(
                        public_path("uploads/user/{$profileImg}"),
                        public_path("uploads/dealer/{$profileImg}")
                    );

                    if ($copied) {
                        $updateDealer = Dealer::whereId($request->id)->update(['profile_photo' => $profileImg]);
                    } else {
                        $updateDealer = false;
                    }
                }

                if ($updateUser && $updateDealer) {
                    return response()->json(['success' => true, 'message' => 'Profile Picture was uploaded successfully']);
                } else {
                    return response()->json(['success' => false, 'message' => 'Failed to update profile']);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to move file']);
            }
        }

        return response()->json(['success' => false, 'message' => 'No file uploaded']);
    }



    public function update_profile(Request $request)
    {
        $user = Auth::user();
        if ($user->is_role == 0) {
            $record = UserRecord::where('id', $request->id)->first();
        } else {
            $record = Dealer::where('id', $request->id)->first();
        }
        if (!$record) {
            return back()->with('error', 'Profile not found.');
        }
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'company_name' => 'required',
            'phone' => 'required',
            'about' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required',
        ]);



        if ($user->is_role == 3) {
            if ($request->hasFile('profile_photo')) {
                $request->validate([
                    'profile_photo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $thumbImage = 'profile_photo_' . time() . '.' . $request->thumbnail->extension();
                $request->thumbnail->move(public_path('uploads/dealer'), $thumbImage);
                $record->profile_photo = $thumbImage;
            }

            if ($request->hasFile('company_logo')) {
                $request->validate([
                    'company_logo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
                ]);
                $company_logoImage = 'company_logo_' . time() . '.' . $request->company_logo->extension();
                $request->company_logo->move(public_path('uploads/dealer'), $company_logoImage);
                $record->company_logo = $company_logoImage;
            }
        }


        //user data images
        $userData = User::find($user->id);
        if ($request->hasFile('profile_photo')) {
            $request->validate([
                'profile_photo' => 'required|image|mimes:jpg,png,jpeg,webp|max:1024',
            ]);
            $thumbImage = 'profile_photo_' . time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->move(public_path('uploads/user'), $thumbImage);
            $userData->profile_photo = $thumbImage;
            $userData->save();
        }


        $record->first_name = $request->first_name;
        $record->last_name = $request->last_name;
        $record->name = $request->first_name . ' ' . $request->last_name;
        $record->company_name = $request->company_name;
        $record->phone = $request->phone;
        $record->altphone = $request->altphone;
        $record->email = $request->email;
        $record->about = $request->about;
        $record->address = $request->address;
        // $record->website = $request->website;
        // $record->facebook_link = $request->facebook_link;
        // $record->linkedin_link = $request->linkedin_link;
        // $record->city = $request->city;
        // $record->state = $request->state;
        // $record->zip = $request->zip;
        // $record->country = $request->country;
        // $record->license_number = $request->license_number;
        // $record->is_verified = $request->is_verified;
        // $record->is_status = $request->is_status;
        $record->save();
        return back()->with('success', 'Profile updated successfully.');
    }


    public function update_social_profile(Request $request)
    {
        $user = Auth::user();

        if ($user->is_role == 0) {
            $record = UserRecord::where('id', $request->id)->first();
        } else {
            $record = Dealer::where('id', $request->id)->first();
        }
        if (!$record) {
            return back()->with('error', 'Profile not found.');
        }
        $record->facebook_link = $request->facebook_link;
        $record->twitter_link = $request->twitter_link;
        $record->instagram_link = $request->instagram_link;
        $record->save();
        return back()->with('success', 'Profile updated successfully.');
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }
        $user->password = Hash::make($request->new_password);
        $user->password_backup = base64_encode($request->new_password);
        $user->save();
        return back()->with('success', 'Password updated successfully.');
    }



    public function dashboardlistingtable(Request $request)
    {
        $user = Auth::user();
        $query = Properties::withAvg('reviews', 'rating')->where('user_id', $user->id);
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }
        switch ($request->sort_by) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'a-z':
                $query->orderBy('name', 'asc');
                break;
            case 'z-a':
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }
        $properties = $query->paginate(6)->withQueryString();
        foreach ($properties as $property) {
            $property->average_rating = round($property->reviews->avg('rating'), 1);
        }
        return view('front.dashboard-listing-table', compact('properties'));
    }

    public function dashboardaddlisting(Request $request)
    {


        if ($request->method() == 'GET') {
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            return view('front.dashboard-add-listing', $data);
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
                //'dealer' => 'required|integer',
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
                if ($request->hasFile('banners')) {
                    $request->validate([
                        'banners.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);

                    $uploadedImages = [];

                    foreach ($request->file('banners') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/properties'), $imageName);
                        $uploadedImages[] = $imageName;
                    }

                    // Save as JSON or comma-separated string if you're storing in a single DB column
                    $property->multiple_images = json_encode($uploadedImages);
                }

                $user = Auth::user();
                $dealerData = Dealer::where('email', $user->email)->first();

                /* for image*/
                $randomslug   = Str::lower(Str::random(10));
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->user_id = $user->id;
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
                $property->elevator = $request->has('elevator') ? 1 : 0;
                $property->railwaystation = $request->has('railwaystation') ? 1 : 0;
                $property->dealer_id = $user->is_role  == 3  ? $dealerData->id : '';
                $property->property_type = $request->property_type;
                $property->metatitle = $request->metatitle;
                $property->metakeyword = $request->metakeyword;
                $property->metadescription = $request->metadescription;
                $property->status = '1';
                $property->is_verified = '0';
                $property->save();
                //=====logs=====
                $logInstance = new Log();
                $logInstance->addToLog('Property', 'New Property Created', 'Create', $property);
                //=====logs=====
                if ($btn_type == 'saveandnew') {
                    return redirect()->route('front.dashboardaddlisting')->with('success', 'Listing has been created  successfully.');
                } else {
                    return redirect()->route('front.dashboardlistingtable')->with('success', 'Listing has been created successfully.');
                }
            } else {
                // dd($validator);
                return redirect()->route('front.dashboardaddlisting')->withInput()->withErrors($validator);
            }
        }
    }

    public function dashboardeditlisting(Request $request, $propID)
    {


        if ($request->method() == 'GET') {
            $newprop = decode_string($propID);

            $data['propertyrow'] = Properties::find($newprop);

            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::all();
            $data['state'] = State::all();
            return view('front.dashboard-edit-listing', $data);
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
                //'dealer' => 'required|integer',
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


                if ($request->hasFile('banners')) {
                    $request->validate([
                        'banners.*' => 'image|mimes:jpg,png,jpeg,webp|max:1024',
                    ]);

                    $uploadedImages = [];

                    foreach ($request->file('banners') as $file) {
                        $imageName = 'banner_' . time() . '_' . uniqid() . '.' . $file->extension();
                        $file->move(public_path('uploads/properties'), $imageName);
                        $uploadedImages[] = $imageName;
                    }

                    $existingImages = json_decode($property->multiple_images, true) ?? [];
                    $allImages = array_merge($existingImages, $uploadedImages);

                    $property->multiple_images = json_encode($allImages);
                }


                $user = Auth::user();
                $dealerData = Dealer::where('email', $user->email)->first();

                /* for image*/
                $btn_type = $request->btnsubmit;
                $property->category_id = $request->category;
                $property->name = $request->name;
                $property->user_id = $user->id;
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
                $property->dealer_id = $user->is_role  == 3  ? $dealerData->id : $request->dealer;
                $property->property_type = $request->property_type;
                $property->elevator = $request->has('elevator') ? 1 : 0;
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
                    return redirect()->route('front.dashboardeditlisting', $propID)->with('success', 'Listing has been update successfully.');
                } else {
                    return redirect()->route('front.dashboardlistingtable')->with('success', 'Listing has been update successfully.');
                }
            } else {
                // dd($validator);
                return redirect()->route('front.dashboardeditlisting', $propID)->withInput()->withErrors($validator);
            }
        }
    }

    public function listing_delete($property)
    {

        $propertyitem = Properties::find($property);
        if (empty($propertyitem)) {
            return redirect()->route('front.dashboardlistingtable')->with('error', "Listing doesn't exist.");
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
        return redirect()->route('front.dashboardlistingtable')->with('success', 'Listing deleted successfully.');
    }

    public function listing_pg_delete($property)
    {
        $propertyitem = PgProperty::find($property);
        if (empty($propertyitem)) {
            return redirect()->route('front.dashboardpglist')->with('error', "PG Listing doesn't exist.");
        }
        if (!empty($propertyitem->thumbnail)) {
            if (file_exists(public_path('uploads/payinguest/' . $propertyitem->thumbnail))) {
                unlink(public_path('uploads/payinguest/' . $propertyitem->thumbnail));
            }
        }
        \App\Models\Properties::where('pg_property_id', $propertyitem->id)->delete();
        $propertyitem->delete();
        return redirect()->route('front.dashboardpglist')->with('success', 'PG Listing deleted successfully.');
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

    public function toggleStatus($id)
    {
        $property = Properties::findOrFail($id);
        $property->status = $property->status == 1 ? 0 : 1;
        $property->save();

        return redirect()->back()->with('success', 'Listing status updated successfully!');
    }


    public function dashboardagents()
    {
        return view('front.dashboard-agents');
    }

    public function dashboardbookings(Request $request)
    {
        $query = Enquiry::with('property');

        // Sort logic
        switch ($request->sort_by) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $data['propertyenquiry'] = $query->where('enquiry_type', 1)->paginate(4)->withQueryString();

        return view('front.dashboard-bookings', $data);
    }

    public function booking_delete($property)
    {

        $propertyitem = Enquiry::find($property);
        if (empty($propertyitem)) {
            return redirect()->route('front.dashboardbookings')->with('error', "Booking doesn't exist.");
        }

        $propertyitem->delete();
        //=====logs=====
        $logInstance = new Log();
        $logInstance->addToLog('Booking', 'Booking Delete', 'Delete', $propertyitem);
        //=====logs=====
        return redirect()->route('front.dashboardbookings')->with('success', 'Booking deleted successfully.');
    }

    public function dashboardreview(Request $request)
    {
        $query = Review::with('property');

        // Sort logic
        switch ($request->sort_by) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $data['propertyreview'] = $query->where('review_type', 1)->paginate(4)->withQueryString();

        return view('front.dashboard-review', $data);
    }


    //end dashboard




    public function agent(Request $request)
    {
        $query = Dealer::with(['property', 'reviews'])
            ->withCount('reviews')
            ->addSelect([
                'average_rating' => function ($sub) {
                    $sub->select(DB::raw('AVG(rating)'))
                        ->from('reviews')
                        ->whereColumn('reviews.dealer_id', 'dealers.id');
                }
            ]);

        // Search by name or address
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Sort logic
        switch ($request->sort_by) {
            case 'rating':
                $query->orderByDesc('average_rating');
                break;
            case 'popularity':
                $query->orderByDesc('reviews_count');
                break;
            case 'a-z':
                $query->orderBy('name', 'asc');
                break;
            case 'z-a':
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $agents = $query->paginate(6)->withQueryString();

        return view('front.agent', compact('agents'));
    }





    public function agentDetail($id)
    {
        $agentid = decode_string($id);

        $agent = Dealer::with('property', 'reviews')->findOrFail($agentid);
        $agent->increment('views');

        $userdata = User::where('email', $agent->email)->first();
        $properties = Properties::with('dealer')->where('dealer_id', $agent->id)
            ->latest()
            ->paginate(3)->withQueryString();
        $reviewCount = $agent->reviews->count();
        $averageRating = round($agent->reviews->avg('rating'), 1);

        return view('front.agent-detail', compact('agent', 'properties', 'reviewCount', 'averageRating'));
    }


    public function project(Request $request)
    {
        $query = Project::with(['property', 'reviews'])
            ->withCount('reviews')
            ->addSelect([
                'average_rating' => function ($sub) {
                    $sub->select(DB::raw('AVG(rating)'))
                        ->from('reviews')
                        ->whereColumn('reviews.property_id', 'projects.id');
                }
            ]);

        // Search by name or address
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Sort logic
        switch ($request->sort_by) {
            case 'rating':
                $query->orderByDesc('average_rating');
                break;
            case 'popularity':
                $query->orderByDesc('reviews_count');
                break;
            case 'a-z':
                $query->orderBy('name', 'asc');
                break;
            case 'z-a':
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $agents = $query->paginate(6)->withQueryString();

        return view('front.project', compact('agents'));
    }


    public function projectDetail($id)
    {
        $agentid = decode_string($id);

        $agent = Project::with('property', 'reviews')->findOrFail($agentid);
        $agent->increment('views');

        $userdata = User::where('email', $agent->email)->first();
        $properties = Properties::with('project')->where('project_id', $agent->id)
            ->latest()
            ->paginate(3)->withQueryString();
        $reviewCount = $agent->reviews->count();
        $averageRating = round($agent->reviews->avg('rating'), 1);

        return view('front.project-detail', compact('agent', 'properties', 'reviewCount', 'averageRating'));
    }


    public function pg(Request $request)
    {
        $query = PgProperty::with(['property', 'reviews'])
            ->withCount('reviews')
            ->addSelect([
                'average_rating' => function ($sub) {
                    $sub->select(DB::raw('AVG(rating)'))
                        ->from('reviews')
                        ->whereColumn('reviews.pg_property_id', 'pg_property.id');
                }
            ]);

        // Search by name or address
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        // Sort logic
        switch ($request->sort_by) {
            case 'rating':
                $query->orderByDesc('average_rating');
                break;
            case 'popularity':
                $query->orderByDesc('reviews_count');
                break;
            case 'a-z':
                $query->orderBy('name', 'asc');
                break;
            case 'z-a':
                $query->orderBy('name', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
        }

        $agents = $query->paginate(6)->withQueryString();

        return view('front.pg', compact('agents'));
    }


    public function pgDetail($id)
    {
        $agentid = decode_string($id);
        $featuredata = PgProperty::take('15')->get();
        $agent = PgProperty::with('property', 'reviews')->findOrFail($agentid);
        $agent->increment('views');
        $userdata = User::where('email', $agent->email)->first();
        $properties = Properties::with('PgProperty')->where('pg_property_id', $agent->id)
            ->latest()
            ->paginate(200)->withQueryString();
        $reviewCount = $agent->reviews->count();
        $averageRating = round($agent->reviews->avg('rating'), 1);
        $minPrice = Properties::where('pg_property_id', $agent->id)->min('amount');
        $singleproperties = Properties::where('pg_property_id', $agent->id)->first();
        return view('front.pg-detail', compact('agent', 'properties', 'reviewCount', 'averageRating', 'minPrice', 'singleproperties','featuredata'));
    }

    public function blog(Request $request)
    {
        $query = Blogs::where('status', 1);

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $data['blogData'] = $query->latest()->paginate(4)->withQueryString();
        $data['popularBlog'] = Blogs::where('is_popular', 1)->latest()->take(6)->get();
        $data['blogs_tag'] = BlogTag::where('status', 1)->get();
        $data['blogs'] = $query->latest()->get();

        return view('front.blog', $data);
    }


    public function blogDetail($slug)
    {
        //dd($slug);
        $blog = Blogs::where('slug', $slug)->where('status', 1)->first();
        //  dd($blog);
        if ($blog) {
            // Previous blog (newer date or higher ID)
            $prevBlog = Blogs::where('id', '>', $blog->id)->where('status', 1)->orderBy('id', 'asc')->first();

            // Next blog (older date or lower ID)
            $nextBlog = Blogs::where('id', '<', $blog->id)->where('status', 1)->orderBy('id', 'desc')->first();

            return view('front.blog-detail', [
                'blog_detail' => $blog,
                'tagData' => $blog->tags,
                'blogData' => Blogs::where('status', 1)->latest()->get(),
                'popularBlog' => Blogs::where('is_popular', 1)->latest()->take(6)->get(),
                'prevBlog' => $prevBlog,
                'nextBlog' => $nextBlog,
                'blogs_tag' => BlogTag::where('status', 1)->get(),

            ]);
        } else {
            return redirect()->route('front.error');
        }
    }



    public function privacyPolicy()
    {
        $data['list'] = PrivacyPolicy::where('id', 1)->first();
        return view('front.policy.privacy', $data);
    }


    public function returnPolicy()
    {
        $data['list'] = ReturnPolicy::where('id', 1)->first();
        return view('front.policy.refund', $data);
    }

    public function term_condition()
    {
        $data['list'] = TermCondition::where('id', 1)->first();
        return view('front.policy.term-condition', $data);
    }

    public function faq()
    {
        $data['faq'] = Faq::where('status', 1)->get();
        return view('front.faq', $data);
    }

    public function auctionProperties()
    {
        $data['auctionproperties'] = Auction::where('status', 1)->latest()->paginate(12);
        return view('front.auction-properties', $data);
    }

    public function auctionPropertiesDetail($slug)
    {
        $data['propertiesrow'] = Auction::where('slug', $slug)->where('status', 1)->first();
        if (!$data['propertiesrow']) {
            return redirect()->route('front.error');
        }
        $data['similar_property'] = Auction::where('status', 1)->latest()->take(5)->get();
        return view('front.auction-property-detail', $data);
    }

    public function dashboardcreatepg(Request $request){
        if ($request->method() == 'GET') {
            $currentuser = Auth::user();
            $data['categories'] = Category::all();
            $data['dealers'] = Dealer::where('email', $currentuser->email)->first();
            $data['state'] = State::all();
            return view('front.dashboard-create-pg', $data);
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
                //end paying guest entry
                return redirect()->route('front.dashboardpg')->with('success', 'PG Properties Listing has been created successfully.');
            } else {
                return redirect()->route('front.dashboardpg')->withInput()->withErrors($validator);
            }
        }
    }

    public function dashboardlistpg()
    {
        $currentuser = Auth::user();
        $data['properties'] = PgProperty::where('dealer_id', function ($query) use ($currentuser) {
            $query->select('id')
                ->from('dealers')
                ->where('email', $currentuser->email)
                ->limit(1);
        })->paginate(10);
        return view('front.dashboard-pg-listing', $data);
    }
}
