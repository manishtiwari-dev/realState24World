<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Agents;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use App\Models\ReturnPolicy;
use App\Models\Testimonial;
use App\Models\Properties;
use App\Models\Review;
use App\Models\User;
use App\Models\Blogs;
use App\Models\Dealer;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['total_property'] = Properties::where('status', 1)->count();
        $data['total_dealer'] = Dealer::count();
        $data['total_agent'] = Agents::count();
        $data['total_enquiry'] = Enquiry::count();
        $data['total_review'] = Review::where('review_type',1)->count();
        $data['total_user'] = User::where('is_role','0')->count();
        $data['total_blog'] = Blogs::where('status', 1)->count();
        $data['total_enquiry_result'] = Enquiry::latest()->take(10)->get();
        $data['total_property_result'] = Properties::where('is_verified','0')->latest()->take(10)->get();
        return view('admin.home',$data);
    }

    public function privacy_policy()
    {
        $data['list'] = PrivacyPolicy::where('id', 1)->first();
        return view('admin.privacyPolicy.index', $data);
    }



    public function privacy_policy_update(Request $request)
    {
        // Find the existing Home record by ID
        $privacyPolicy = PrivacyPolicy::where('id', 1)->first();
        if ($privacyPolicy) {
            $request->validate([
                'description' => 'required',
            ]);
            //UPDATE
            $privacyPolicy->title = $request->title;
            $privacyPolicy->description = $request->description;
            $privacyPolicy->save();
            return redirect()->route(getRolePrefix().'privacy_policy')->with('success', 'Data Updated successfully!');
        } else {
            //create
            $request->validate([
                'description' => 'required',
            ]);

            $res  = new PrivacyPolicy();
            $res->title = $request->title;
            $res->description = $request->description;
            $res->save();
            return redirect()->route(getRolePrefix().'privacy_policy')->with('success', 'Data Created successfully!');
        }
    }



    public function term_condition()
    {
        $data['list'] = TermCondition::where('id', 1)->first();
        return view('admin.termConditions.index', $data);
    }


    public function term_condition_update(Request $request)
    {
        // Find the existing Home record by ID
        $TermCondition = TermCondition::where('id', 1)->first();
        if ($TermCondition) {
            $request->validate([
                'description' => 'required',
            ]);
            //UPDATE
            $TermCondition->title = $request->title;
            $TermCondition->description = $request->description;
            $TermCondition->save();

            return redirect()->route(getRolePrefix().'term_condition')->with('success', 'Data Updated successfully!');
        } else {
            //create
            $request->validate([
                'description' => 'required',
            ]);

            $res  = new TermCondition();
            $res->title = $request->title;
            $res->description = $request->description;
            $res->save();

            return redirect()->route(getRolePrefix().'term_condition')->with('success', 'Data Created successfully!');
        }
    }






    public function returnPolicy()
    {
        $data['list'] = ReturnPolicy::where('id', 1)->first();
        return view('admin.returnPolicy.index', $data);
    }



    public function returnPolicy_update(Request $request)
    {
        // Find the existing Home record by ID
        $privacyPolicy = ReturnPolicy::where('id', 1)->first();
        if ($privacyPolicy) {
            $request->validate([
                'description' => 'required',
            ]);
            //UPDATE
            $privacyPolicy->title = $request->title;
            $privacyPolicy->description = $request->description;
            $privacyPolicy->save();

            return redirect()->route(getRolePrefix().'returnPolicy')->with('success', 'Data Updated successfully!');
        } else {
            //create
            $request->validate([
                'description' => 'required',
            ]);

            $res  = new ReturnPolicy();
            $res->title = $request->title;
            $res->description = $request->description;
            $res->save();

            return redirect()->route(getRolePrefix().'returnPolicy')->with('success', 'Data Created successfully!');
        }
    }


      public function testimonial_list()
    {
        $data['testimonial'] = Testimonial::all();
        return view('admin.testimonial.index', $data);
    }

    public function testimonial_create(Request $request)
    {

        if ($request->method() == 'GET') {
            return view('admin.testimonial.create');
        }
        if ($request->method() == 'POST') {
            //   dd($request->all());
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                   // 'designation' => 'required',
                    'subtitle' => 'required'
                ]
            );
            if ($validator->passes()) {
                $res  = new Testimonial();
                $bannerImage = 'testimonial' . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/testimonial'), $bannerImage);
                $res->image = $bannerImage;
                $btn = $request->btnsubmit;
                $res->name = $request->name;
              //  $res->designation = $request->designation;
                $res->subtitle = $request->subtitle;
                $res->alt = $request->alt;
                $res->status = $request->status;
                $res->display_order = $request->display_order;
                $res->save();

                if ($btn == 'saveandnew') {
                    return redirect()->route(getRolePrefix().'testimonial.create')->with('success', 'Testimonial Created successfully!');
                } else {
                    // Redirect to the home index route with a success message
                    return redirect()->route(getRolePrefix().'testimonial.index')->with('success', 'Testimonial Created successfully!');
                }
            } else {
                return redirect()->route(getRolePrefix().'testimonial.create')->withErrors($validator)->withInput();
            }
        }
    }

    public function testimonial_update(Request $request, $id)
    {
        if ($request->method() == 'GET') {
            $data['testimonial'] = Testimonial::find($id);
            return view('admin.testimonial.edit', $data);
        }
        if ($request->method() == 'POST') {
            //   dd($request->all());
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                   // 'designation' => 'required',
                    'subtitle' => 'required'
                ]
            );
            if ($validator->passes()) {
                $testimonial = Testimonial::find($id);
                if (empty($testimonial)) {
                    return redirect()->route(getRolePrefix().'testimonial.index')->with('error', "Testimonial doesn't exist.");
                } else {
                    if ($request->hasFile('image')) {
                        $bannerImage = 'testimonial' . time() . '.' . $request->image->extension();
                        $request->image->move(public_path('uploads/testimonial'), $bannerImage);
                        $testimonial->image = $bannerImage;
                    }

                    $btn = $request->btnsubmit;
                    $testimonial->name = $request->name;
                  //  $testimonial->designation = $request->designation;
                    $testimonial->subtitle = $request->subtitle;
                    $testimonial->alt = $request->alt;
                    $testimonial->status = $request->status;
                    $testimonial->display_order = $request->display_order;
                    $testimonial->save();

                    if ($btn == 'saveandnew') {
                        return redirect()->route(getRolePrefix().'testimonial.update', $testimonial->id)->with('success', 'Testimonial has been updated successfully!');
                    } else {
                        return redirect()->route(getRolePrefix().'testimonial.index')->with('success', 'Testimonial has been updated successfully.');
                    }
                }
            } else {
                return redirect()->route(getRolePrefix().'testimonial.update', $id)->withErrors($validator)->withInput();
            }
        }
    }

    public function testimonial_delete($id)
    {

        $testimonial = Testimonial::find($id);

        //  dd($catitem);
        if (empty($testimonial)) {
            return redirect()->route(getRolePrefix().'testimonial.index')->with('error', "Testimonial doesn't exist.");
        }
        $testimonial->delete();
        return redirect()->route(getRolePrefix().'testimonial.index')->with('success', 'Testimonial deleted successfully.');
    }


    public function testimonial_status(Request $request)
    {
        $feature = Testimonial::findOrFail($request->testimonial_id);
        $feature->status = $request->status;
        $feature->save();
        return response()->json(['message' => 'Testimonial status updated successfully.']);
    }

    public function bookingEnquiry()
    {
        $data['enquiryresult'] = Enquiry::latest()->get();
        return view('admin.booking', $data);
    }

}
